<?php

namespace App\Repositories\Project;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function __construct(private Project $project) {}

    public function getAll()
    {
        $user = Auth::user();

        return Project::when($user->role !== 'admin', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->latest()->paginate(5);
    }

    public function findById(int $id)
    {
        return $this->project->with('user')->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->project->create($data);
    }

    public function update(int $id, array $data)
    {
        $project = $this->findById($id);
        $project->update($data);
        return $project;
    }

    public function delete(int $id)
    {
        return $this->project->destroy($id);
    }

    public function countAllProjects(): int
    {
        return $this->project->count();
    }
}
