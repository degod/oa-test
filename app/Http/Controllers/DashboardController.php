<?php

namespace App\Http\Controllers;

use App\Repositories\Project\ProjectRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private ProjectRepositoryInterface $projectRepository
    ) {}

    public function index(): View
    {
        $user = Auth::user();
        $totalUsers = $this->userRepository->countAllUsers();
        $totalAdmins = $this->userRepository->countByRole('admin');
        $totalRegularUsers = $this->userRepository->countByRole('user');
        $totalProjects = $this->projectRepository->countAllProjects();

        return view('welcome', compact(
            'user',
            'totalUsers',
            'totalAdmins',
            'totalRegularUsers',
            'totalProjects'
        ));
    }
}
