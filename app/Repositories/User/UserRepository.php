<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(private User $user) {}

    public function create(array $data): User
    {
        return $this->user->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'] ?? 'user',
        ]);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->user->where('email', $email)->first();
    }

    public function countAllUsers(): int
    {
        return $this->user->count();
    }

    public function getAllWithFilters(array $filters, int $perPage = 5)
    {
        return $this->user->when($filters['name'] ?? null, fn($q, $name) => $q->where('name', 'like', "%$name%"))
            ->when($filters['email'] ?? null, fn($q, $email) => $q->where('email', 'like', "%$email%"))
            ->when($filters['role'] ?? null, fn($q, $role) => $q->where('role', $role))
            ->orderBy('id', 'DESC')
            ->paginate($perPage);
    }

    public function findByUuid(string $uuid)
    {
        return $this->user->where('id', $uuid)->firstOrFail();
    }

    public function update(string $uuid, array $data)
    {
        $user = $this->findByUuid($uuid);
        $user->update($data);
        return $user;
    }

    public function toggleActive(string $uuid)
    {
        $user = $this->findByUuid($uuid);
        $user->is_active = !$user->is_active;
        $user->save();
        return $user;
    }

    public function countByRole(string $role): int
    {
        return $this->user->where('role', $role)->count();
    }
}
