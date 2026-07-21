<?php
namespace Modules\Role\Services;

use App\Models\Module;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleServices
{
    /**
     * Fetch all roles with global search filters and pagination contexts.
     */
    public function getAllRoles(int $perPage = 10, $keyword = null, $status = null)
    {
        return Role::query()
            ->leftJoin('saas_users', 'roles.created_by', '=', 'saas_users.uid')
            ->select('roles.*','saas_users.username as created_by_name')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('roles.username', 'like', '%' . trim($keyword) . '%');
            })
            ->when($status, function ($query) use ($status) {
                $query->where('roles.status', $status);
            })
            ->latest('roles.created_at')
            ->paginate($perPage)
            ->withQueryString();
    }
    /**
     * Create a new role record along with assigned modules and Spatie permissions.
     */
    public function createRole(array $data): array
    {
        return DB::transaction(function () use ($data) {
            if (Role::where('name', trim($data['name']))->exists()) {
                return ['status' => false, 'type' => 'exists', 'message' => 'Role already exists'];
            }

            $role = Role::create([
                'name'   => ucwords(trim($data['name'])),
                'created_by' => auth()->id(),
                'status' => $data['status']
            ]);

            if (!empty($data['module_id'])) {
                $this->syncModules($role->id, $data['module_id']);
            }

            if (!empty($data['permissions'])) {
                $permissionNames = Permission::whereIn('id', $data['permissions'])->pluck('name')->toArray();
                $role->syncPermissions($permissionNames);
            }

            return [
                'status'  => true,
                'message' => 'Role created successfully',
                'data'    => $role
            ];
        });
    }

    /**
     * Update an existing role record configuration datasets safely.
     */
    public function updateRole(int $id, array $data): array
    {
        return DB::transaction(function () use ($id, $data) {
            $role = Role::find($id);

            if (!$role) {
                return ['status' => false, 'type' => 'not_found', 'message' => 'Role not found'];
            }

            $exists = Role::where('name', trim($data['name']))
                ->where('id', '!=', $id)
                ->exists();

            if ($exists) {
                return ['status' => false, 'type' => 'exists', 'message' => 'Role name already exists'];
            }

            $role->update([
                'name'   => ucwords(trim($data['name'])),
                'created_by' => auth()->id(),
                'status' => $data['status'] ?? 'active',
            ]);

            $this->syncModules($role->id, $data['module_id'] ?? []);

            if (!empty($data['permissions'])) {
                $permissionNames = Permission::whereIn('id', $data['permissions'])->pluck('name')->toArray();
                $role->syncPermissions($permissionNames);
            } else {
                $role->syncPermissions([]);
            }

            return [
                'status'  => true,
                'message' => 'Role updated successfully',
                'data'    => $role
            ];
        });
    }

    /**
     * Fetch explicit specific Role contextual matrices via standardized parameters.
     */
    public function getRoleById(int $id): array
    {
        $role = Role::with('permissions')->findOrFail($id);
        $modules = DB::table('role_module')
            ->join('saas_modules', 'role_module.module_id', '=', 'saas_modules.module_id')
            ->where('role_module.role_id', $id)
            ->select('saas_modules.module_id as module_id', 'saas_modules.module_name as module_name')
            ->get();

        return [
            'data'   => $role,
            'module' => $modules
        ];
    }

    /**
     * Dynamic permissions group mapping logic for asynchronous split grid templates.
     */
    public function getPermissions(array $moduleIds)
    {
        return Permission::with('module')
            ->whereIn('module_id', $moduleIds)
            ->where('status', 'active')
            ->get()
            ->groupBy(function($perm) {
                return $perm->module->module_name ?? $perm->module_name ?? 'System Module';
            });
    }

    /**
     * Drop Target Entity Data Rows from Active Context Schema Records.
     */
    public function deleteRole(int $id): array
    {
        return DB::transaction(function () use ($id) {
            $role = Role::find($id);
            if (!$role) {
                return ['status' => false, 'message' => 'Role parameters not found'];
            }

            DB::table('role_module')->where('role_id', $id)->delete();
            $role->syncPermissions([]);
            $role->delete();

            return ['status' => true, 'message' => 'Role deleted successfully'];
        });
    }

    /**
     * Select2 dynamic live asynchronous server lookup endpoint stream.
     */
    public function searchModule(string $query)
    {
        return Module::query()->where('module_name', 'like', "%{$query}%")
            ->where('status', 'active')
            ->get()
            ->map(fn($item) => [
                'id'   => $item->module_id,
                'text' => $item->module_name
            ]);
    }

    /**
     * Internal routine to synchronize explicit cross junction matrix links.
     */
    private function syncModules(int $roleId, array $moduleIds): void
    {
        DB::table('role_module')->where('role_id', $roleId)->delete();

        if (!empty($moduleIds)) {
            $moduleData = [];
            foreach ($moduleIds as $moduleId) {
                $moduleData[] = [
                    'role_id'   => $roleId,
                    'module_id' => $moduleId,
                ];
            }
            DB::table('role_module')->insert($moduleData);
        }
    }
}
