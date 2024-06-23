<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\SignUpRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function store(SignUpRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = User::query()->create($request->validated());
        auth()->login($user);

        return redirect()->route('product.index');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $success = auth()->attempt($request->validated());

        return $success
            ? redirect()->back()
            : redirect()->route('product.index');
    }
}
