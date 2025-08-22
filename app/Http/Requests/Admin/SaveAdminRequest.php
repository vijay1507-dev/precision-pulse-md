<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Admin\Admin;

class SaveAdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $adminId = $this->route('id');
        $userId = $this->user()->id;

        return [
            'name'       => 'required|string|max:255',
            'email'      => "required|email|unique:users,email,{$userId}",
            'password'   => $userId ? 'nullable|string|min:6' : 'required|string|min:6',
            'phone'      => 'required|string|max:15',
            'avatar'     => 'nullable|file|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'position'   => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'bio'        => 'nullable|string',
        ];
    }
}
