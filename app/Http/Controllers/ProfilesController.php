<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;

class ProfilesController extends Controller
{
    //
    public function index(User $user)
    {
        // if the authenticated user's followings, does that contain the user that got passed in?
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
    
        // caching for quicker loading
        // will only do it for this one so the other methods can be seen
        $postCount = Cache::remember('count.posts.' . $user->id, now()->addSeconds(30),
        function () use ($user) {
            return $user->posts->count();
        });

        $postCount = $user->posts->count();
        $followersCount = $user->profile->followers->count();
        return view('profiles.index', compact('user', 'follows', 'postCount', 'followersCount'));
    }

    public function edit(User $user)
    {
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        // this is what follows after the Policy user id == profile user_id matching
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => ''
        ]);


        // during registration, this checks if the user has uploaded a picture
        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        // not quite sure why just using update method works -- needs more investigating
        // adding auth() in the beginning of the $user makes sure that not
        // everyone can just go to the profiles page and edit
        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []     // this overrides the 'image' => '' above by using array_merge
        ));


        return redirect("/profile/{$user->id}");
    }
}
