<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function showForm()
    {
        return view('auth.register'); // Your Blade view for register form
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->userRepository->create($request->validated());

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Registration successful!');
    }
}
