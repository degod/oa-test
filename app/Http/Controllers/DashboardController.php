<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function index(): View
    {
        $user = Auth::user();
        $totalUsers = $this->userRepository->countAllUsers();

        return view('welcome', compact('user', 'totalUsers'));
    }
}
