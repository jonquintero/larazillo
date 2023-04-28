<?php

namespace App\Http\Controllers;

use App\Actions\UpsertUserAccountAction;
use App\DataTransferObjects\UserAccountData;
use App\Http\Requests\UpsertUserAccountRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserAccountController extends Controller
{
    public function __construct(private readonly UpsertUserAccountAction $upsertUserAccountAction)
    {
    }

    public function create()
    {
        return Inertia::render('UserAccount/Create');
    }

    public function store(UpsertUserAccountRequest $request)
    {

        $this->upsert($request, new User());

        return redirect()->route('listings.index')
            ->with('success', 'Account created!');
    }

    public function upsert(UpsertUserAccountRequest $request, User $user)
    {
        $userAccountData = new UserAccountData(...$request->validated());

        $this->upsertUserAccountAction->execute($user, $userAccountData);
    }

}
