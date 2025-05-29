<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserManagementController extends Controller
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function index(Request $request): View
    {
        $filters = $request->only(['name', 'email', 'role']);
        $users = $this->userRepository->getAllWithFilters($filters)->appends($request->all());
        $user = Auth::user();
        return view('users', compact('users', 'filters', 'user'));
    }

    public function toggleStatus(string $uuid)
    {
        $this->userRepository->toggleActive($uuid);
        return redirect()->back()->with('success', 'User status updated.');
    }

    public function edit(string $uuid)
    {
        $user = $this->userRepository->findByUuid($uuid);
        return view('user-edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, string $uuid)
    {
        $this->userRepository->update($uuid, $request->validated());
        return redirect()->route('users.index')->with('success', 'User updated.');
    }
}
