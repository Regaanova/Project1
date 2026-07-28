<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface AuthRepositoryInterface
{
    public function findByEmployeId(string $employeeId): ?User;

    public function createToken(User $user): string;

    public function deleteCurrentToken(User $user): void;
}
