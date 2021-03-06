<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{


    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');  //??????

        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request)
    {
        $imageName = auth()->user()->username .
                    '-post-' .
                     auth()->user()->id .
                     time() .
                     '.' . $request->image->extension();
        $imagePath = $request->image->storeAs('uploads', $imageName, 'public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();
        auth()->User()->posts()->create([
            'caption' => $request->caption,
            'image' => $imagePath,
        ]);
        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(Post $post)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($post->user->id) : false;
        $likes=$post->likeUsers->count();
        return view('posts.show', compact('post', 'follows','likes'));
    }
}
