<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class ModuleController extends Controller implements HasMiddleware
// class ModuleController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view modules', only: ['index']),
            new Middleware('permission:edit modules', only: ['edit']),
            new Middleware('permission:create modules', only: ['create']),
            new Middleware('permission:delete modules', only: ['destroy']),
        ];
    }

    public function index(Request $request)
    {
        $data = Module::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.module.module', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'module_name' => 'required|max:255|unique:saas_modules,module_name',
            'status'      => 'required|in:active,inactive',
        ]);

        try {
            $module = new Module();
            $module->module_name = $validated['module_name'];
            $module->status = $validated['status'];
            $module->save();

            return response()->json(['success' => true, 'message' => 'Module created successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred.', 'error' => $e->getMessage()], 500);
        }
    }

    public function edit($module_id)
    {
        $module = Module::findOrFail($module_id);
        return response()->json($module);
    }

    public function update(Request $request, $module_id)
    {
        $validated = $request->validate([
            'module_name' => 'required|max:255|unique:saas_modules,module_name,' . $module_id . ',module_id',
            'status'      => 'required|in:active,inactive',
        ]);

        try {
            $module = Module::findOrFail($module_id);
            $module->module_name = $validated['module_name'];
            $module->status = $validated['status'];
            $module->save();

            return response()->json(['success' => true, 'message' => 'Module updated successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred.', 'error' => $e->getMessage()], 500);
        }
    }

    public function delete($module_id)
    {
        try {
            $module = Module::findOrFail($module_id);
            $module->delete();

            return response()->json(['success' => true, 'message' => 'Module deleted successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting.'], 500);
        }
    }

    public function restore($module_id)
    {
        try {
            $module = Module::withTrashed()->findOrFail($module_id);
            $module->restore();

            return response()->json(['success' => true, 'message' => 'Module restore successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting.'], 500);
        }
    }
}
