<?php

namespace Modules\Role\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Role\Http\Requests\RoleRequest;
use Modules\Role\Services\RoleServices;

class RoleController extends Controller implements HasMiddleware
{
    protected RoleServices $roleService;

    public function __construct(RoleServices $roleService)
    {
        $this->roleService = $roleService;
    }

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view_roles', only: ['index']),
            new Middleware('permission:create_roles', only: ['create', 'store']),
            new Middleware('permission:edit_roles', only: ['edit', 'update']),
            new Middleware('permission:delete_roles', only: ['destroy']),
        ];
    }

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $keyword = $request->get('keyword');
        $status  = $request->get('status');
        $data = $this->roleService->getAllRoles($perPage, $keyword, $status);
        return view('role::index', compact('data'));
    }

    public function store(RoleRequest $request)
    {
        try {
            $result = $this->roleService->createRole($request->validated());
            if (!$result['status']) {
                return response()->json($result, 422);
            }

            return response()->json(['status' => true, 'message' => $result['message'], 'data' => $result['data']], 201);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to create role', 'error' => $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        try {
            $result = $this->roleService->getRoleById($id);

            if (!$result) {
                return response()->json(['status' => false, 'message' => 'Role not found'], 404);
            }

            return response()->json(['success' => true, 'data' => $result], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to retrieve role', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(RoleRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $result = $this->roleService->updateRole($id, $data);

            if (!$result['status']) {
                return response()->json([
                    'status'  => false,
                    'type'    => $result['type'] ?? 'error',
                    'message' => $result['message']
                ], 409);
            }

            return response()->json(['status' => true, 'message' => $result['message'], 'data' => $result['data']], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to update role', 'error' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->roleService->deleteRole($id);

            if (!$result['status']) {
                return response()->json(['status' => false, 'message' => $result['message']], 404);
            }

            return response()->json(['status' => true, 'message' => $result['message']], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to delete role', 'error' => $e->getMessage()], 500);
        }
    }

    public function getPermissions(Request $request)
    {
        $moduleIds = $request->get('module_ids', []);
        $groupedPermissions = $this->roleService->getPermissions($moduleIds);
        return response()->json($groupedPermissions);
    }
}
