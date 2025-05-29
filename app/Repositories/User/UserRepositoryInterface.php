<?php

namespace App\Repositories\User;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(array $data): User;

    public function findByEmail(string $email): ?User;

    public function countAllUsers(): int;

    public function getAllWithFilters(array $filters, int $perPage = 10);

    public function findByUuid(string $uuid);

    public function update(string $uuid, array $data);

    public function toggleActive(string $uuid);

    public function countByRole(string $role): int;
}
