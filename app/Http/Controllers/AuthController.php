<?php

namespace App\Http\Controllers;

use App\Handlers\AuthHandler;
use App\Helpers\ResponseHelper;
use App\Http\Requests\Auth\LoginRequest;
use App\Resources\LoginResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class AuthController extends Controller
{
    public function __construct(
        protected AuthHandler $authHandler
    ) {}

   public function login(LoginRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $result = $this->authHandler->login(
                $request->validated()
            );

            DB::commit();

            return ResponseHelper::success(
                'Login berhasil.',
                new LoginResource($result),
                200
            );
        } catch (Throwable $th) {
            DB::rollBack();

            throw $th;
        }
    }

    public function logout(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $this->authHandler->logout(
                $request->user()
            );

            DB::commit();

            return ResponseHelper::success(
                'Logout berhasil.',
                null,
                200
            );
        } catch (Throwable $th) {
            DB::rollBack();

            throw $th;
        }
    }
}
