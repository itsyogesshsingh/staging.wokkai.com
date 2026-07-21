<?php

namespace Modules\Role\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $roleId = $this->route('roles') ?? $this->id;
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name')->ignore($roleId),
            ],
            'module_id' => 'required|array|min:1',
            'module_id.*' => 'required|exists:saas_modules,module_id',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
            'status'      => 'required|in:active,inactive',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
