<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $postsCount = Cache::remember('count.posts' . $user->id, now()->addSeconds(30), function () use ($user) {
            return $user->posts->count();
        });
        $followersCount = $user->profile->followers->count();
        $followingCount = $user->following->count();
        return view('profiles.index', compact('user', 'follows', 'postsCount', 'followersCount', 'followingCount'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function update(ProfileRequest $request, User $user)
    {
        $this->authorize('update', $user->profile);
        if ($request->image) {
            File::delete("storage/{$user->profile->image}");
            $imageName = $user->username . '-' . $user->id . time() . '.' . $request->image->extension();
            $imagePath = $request->image->storeAs('profile', $imageName, 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();
            auth()->user()->profile->update([
                'image' => $imagePath
            ]);
        }
        auth()->user()->profile->update([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
        ]);
        return redirect("/profile/{$user->id}");
    }
}
