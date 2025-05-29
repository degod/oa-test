<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AccountSettingsController extends Controller
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function index(): View
    {
        $user = Auth::user();

        return view('account', compact('user'));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $this->userRepository->update(Auth::user()->id, $request->validated());
        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Old password is incorrect'])->withInput($request->all());
        }

        $this->userRepository->update($user->id, [
            'password' => bcrypt($request->new_password),
        ]);

        return redirect()->back()->with('success', 'Password updated successfully');
    }
}
