<?php

namespace Modules\Permission\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

// class PermissionController extends Controller  implements HasMiddleware
class PermissionController extends Controller
{
    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware('permission:view permission', only: ['index']),
    //         new Middleware('permission:edit permission', only: ['edit']),
    //         new Middleware('permission:create permission', only: ['create']),
    //         new Middleware('permission:delete permission', only: ['destroy']),
    //     ];
    // }

    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $data = Permission::withTrashed()
            ->when($keyword, function ($query, $keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('permission::index', compact('data', 'keyword'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'permission_name' => 'required|max:255|unique:permissions,name',
            'module_id'       => 'required|exists:saas_modules,module_id',
            'status'          => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Validation failed.', 'errors'  => $validator->errors(),], 422);
        }

        try {
            $permission = new Permission();
            $permission->name = ucwords($request->input('permission_name'));
            $permission->module_id = $request->input('module_id');
            $permission->status = $request->input('status');
            $permission->created_by = $request->session()->get('user.uid', null);
            $permission->save();

            return response()->json(['success' => true, 'message' => 'Permission created successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred.', 'error' => $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        $permission = Permission::with('module')->findOrFail($id);
        return response()->json($permission);
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $validated = $request->validate([
            'permission_name' => 'required|max:255|unique:permissions,name,' . $permission->id,
            'module_id'       => 'required|exists:saas_modules,module_id',
            'status'          => 'required|in:active,inactive',
        ]);

        $permission = Permission::findOrFail($id);

        try {
            $permission->name =  ucwords($validated['permission_name']);
            $permission->module_id = $validated['module_id'];
            $permission->status = $validated['status'];
            $permission->created_by = $request->session()->get('user.uid', null);
            $permission->save();

            return response()->json(['success' => true, 'message' => 'Permission updated successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred.', 'error' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        try {
            $data = Permission::findOrFail($id);
            $data->delete();

            return response()->json(['success' => true, 'message' => 'Permission Deleted successfully.',], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Role not found or could not be deleted.', 'error' => $e->getMessage()], 404);
        }
    }

    public function restore($id)
    {
        try {
            $data = Permission::onlyTrashed()->findOrFail($id);
            $data->restore();

            return response()->json(['success' => true, 'message' => 'Permission restored successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting.'], 500);
        }
    }

    public function forceDelete($id)
    {
        try {
            $data = Permission::withTrashed()->findOrFail($id);
            $data->restore();

            return response()->json(['success' => true, 'message' => 'Permission permanently successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting.'], 500);
        }
    }
}
