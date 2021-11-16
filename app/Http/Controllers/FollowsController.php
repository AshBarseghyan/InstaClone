<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(User $user)
    {
        auth()->user()->following()->toggle($user->profile);
        return auth()->user()->following()->contain($user->profile);
    }
}
