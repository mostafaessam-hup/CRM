<?php

namespace App\Http\Controllers;

use Crm\User\Requests\UserRequest;
use Crm\User\services\UserService;

class UserController extends Controller
{
    private UserService $userService;
    const TOKEN_NAME='personal';
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create(UserRequest $request)
    {
        $user = $this->userService->create($request);
        return response()->json(
            [
                    'user'=>$user,
                    'token'=>$user->createToken(self::TOKEN_NAME)->plainTextToken
            ]
        );  
    }
}
