<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class SignUpRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],

            'email' => ['required', Rule::unique(User::class, 'email')],

            'password' => ['required'],
        ];
    }
}
