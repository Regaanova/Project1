<?php

namespace App\Repositories\Implementations;

use App\Models\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface
{
    public function findByEmployeId(string $employeeId): ?User
    {
        return User::with('roles')
            ->where('employe_id', $employeeId)
            ->first();
    }

    public function createToken(User $user): string
    {
        return $user
            ->createToken('auth_token')
            ->plainTextToken;
    }

    public function deleteCurrentToken(User $user): void
    {
        $user->currentAccessToken()?->delete();
    }
}
