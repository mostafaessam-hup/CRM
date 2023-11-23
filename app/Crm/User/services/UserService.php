<?php

namespace Crm\User\services;

use Crm\User\Models\User;
use Crm\User\Requests\UserRequest;
use Crm\User\Events\UserCreation;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function create(UserRequest $request): ?User
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        event(new UserCreation ($user) );
        return $user;
    }
}
