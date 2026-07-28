<?php

namespace App\Handlers;

use App\Helpers\ResponseHelper;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthHandler
{
    public function __construct(
        protected AuthRepositoryInterface $authRepository
    ) {}

    public function login(array $data): array
    {
        $user = $this->authRepository->findByEmployeId(
            $data['employe_id']
        );

        if (!$user) {
            throw ValidationException::withMessages([
                'employe_id' => [
                    'Employe ID atau password salah.',
                ],
            ]);
        }

        if (!Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'employe_id' => [
                    'Employe ID atau password salah.',
                ],
            ]);
        }

        if (!$user->is_active) {
            throw ValidationException::withMessages([
                'employe_id' => [
                    'Akun Anda tidak aktif.',
                ],
            ]);
        }

        // Hapus token lama agar hanya satu perangkat yang aktif
        $user->tokens()->delete();

        $token = $this->authRepository->createToken($user);

        return [
            'token' => $token,
            'user' => $user,
        ];
    }

    public function logout($user): void
    {
        $this->authRepository->deleteCurrentToken($user);
    }
}
