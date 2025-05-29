<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Repositories\Project\ProjectRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function __construct(private ProjectRepositoryInterface $projectRepository) {}

    public function index(): View
    {
        $user = Auth::user();
        $projects = $this->projectRepository->getAll();
        return view('projects', compact('projects', 'user'));
    }

    public function create(): View
    {
        $user = Auth::user();
        return view('project-create', compact('user'));
    }

    public function store(CreateProjectRequest $request)
    {
        $this->projectRepository->create([
            ...$request->validated(),
            'user_id' => Auth::id()
        ]);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function edit($id): View
    {
        $user = Auth::user();
        $project = $this->projectRepository->findById($id);
        return view('project-edit', compact('project', 'user'));
    }

    public function update(UpdateProjectRequest $request, $id)
    {
        $this->projectRepository->update($id, $request->validated());
        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy($id)
    {
        $this->projectRepository->delete($id);
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
