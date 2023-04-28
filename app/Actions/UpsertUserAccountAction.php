<?php

namespace App\Actions;

use App\DataTransferObjects\UserAccountData;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpsertUserAccountAction
{
    public function execute(User $user, UserAccountData $userAccountData): void
    {
        $user->name = $userAccountData->name;
        $user->email = $userAccountData->email;
        $user->password = Hash::make($userAccountData->password);
        $user->save();
        Auth::login($user);
    }
}
