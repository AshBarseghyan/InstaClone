<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NotifyFollow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(User $user)
    {
        if (!auth()->user()->following()->find($user->profile)) {
            User::find($user->id)->notify(new NotifyFollow(Auth::user()));
        }
        return auth()->user()->following()->toggle($user->profile);
    }

}
