<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $uid = $this->route('uid');

        return [
            'first_name' => ['required','string','max:255'],
            'last_name'  => ['required','string','max:255'],
            'email'      => [
                'required','email','max:255',
                Rule::unique('saas_users','email')->ignore($uid,'uid')
            ],
            'email_enabled' => ['required','boolean'],
            'username'   => [
                'required','string','max:255',
                Rule::unique('saas_users','username')->ignore($uid,'uid')
            ],
            'status'     => ['required', Rule::in(['active','inactive'])],
            'roles'      => ['nullable','array'],
            'roles.*'    => ['exists:roles,id'],
            'image'      => ['nullable','string'],
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
