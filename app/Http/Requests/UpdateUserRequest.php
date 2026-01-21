<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'prefixname' => ['sometimes', 'string'],
            'firstname' => ['sometimes', 'string'],
            'lastname' => ['sometimes', 'string'],
            'middlename' => ['sometimes', 'string'],
            'username' => ['sometimes', 'string', 'unique:users,username,' . $this->user->id],
            'email' => ['sometimes', 'email', 'unique:users,email,' . $this->user->id],
            'password' => ['sometimes', 'string', 'min:8'],
            'photo' => ['sometimes', 'string'],
            'type' => ['sometimes', 'in:admin,user'],
        ];
    }
}
