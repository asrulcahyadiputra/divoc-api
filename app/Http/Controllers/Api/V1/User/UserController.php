<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Resources\UserResource;
use App\Http\Resources\UsersResource;
use App\Services\V1\User\UserService;
use Illuminate\Http\Request;

class UserController extends BaseApiController
{
    public function __construct(
        protected UserService $userService
    ) {}
    public function index(Request $request)
    {
        $user = $request->user();

        $users = $this->userService->getAllUser(
            $user->kode_lokasi,
            $request->only(['role_id', 'status', 'search']),
            $request->integer('per_page', 15)
        );

        return $this->success('Success', UsersResource::collection($users),
            200,
            [
                'current_page' => $users->currentPage(),
                'per_page'     => $users->perPage(),
                'total'        => $users->total(),
            ]
        );
    }

    public function currentUser() {
        return $this->success('Success',
            UserResource::make(auth()->user())
        );
    }

    public function store()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
