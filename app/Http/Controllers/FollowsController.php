<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class FollowsController extends Controller
{
    public function store(User $user)
    {
        // this handles the toggle on Follow and UnFollow
        // toggling the user's profile, its the user that is being passed and not the auth()->user
        return auth()->user()->following()->toggle($user->profile);
    }
}
