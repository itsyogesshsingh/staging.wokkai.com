<?php
namespace Core\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class BaseController extends Controller
{
    public function searchModule(Request $request){
        $search = $request->search;
        $data = Module::query()
            ->where('status', 'active')
            ->when($search, function ($query, $search) {
                $query->where('module_name', 'LIKE', "%{$search}%");
            })
            ->orderBy('module_name')
            ->select('module_id', 'module_name')
            ->get()
            ->map(function ($module) {
                return [
                    'id' => $module->module_id,
                    'text' => $module->module_name,
                ];
            });
        return response()->json($data);
    }

    public function searchRole(Request $request)
    {
        $search = $request->get('search');
        $roles = Role::where('status', 'active')
            ->where('name', 'LIKE', '%' . $search . '%')
            ->orderBy('name')
            ->get()
            ->map(function ($role) {
                return [
                    'id'   => $role->id,
                    'text' => $role->name,
                ];
            });
        return response()->json($roles);
    }
}
