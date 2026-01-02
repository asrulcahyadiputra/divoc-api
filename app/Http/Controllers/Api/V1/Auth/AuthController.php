<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Services\V1\Auth\LoginService;

class AuthController extends BaseApiController
{
    public function __construct(
        protected LoginService $loginService
    ) {}

    public function login(LoginRequest $request)
    {
        $data = $this->loginService->login($request->validated());

        return $this->success('Login berhasil', $data);
    }
}
