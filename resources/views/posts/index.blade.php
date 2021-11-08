@extends('layouts.app')
@section('content')
    <h1 class="text-center">FolloWs PoSts</h1>
    @foreach($posts as $post)
        <div class="container mt-5">
            <div class="row  justify-content-center">
                <div class="col-4">
                    <a href="/profile/{{$post->user->id}}">
                        <img src="/storage/{{$post->image}}" alt="" class="w-100">
                    </a>
                    <div class="mt-2"><p>{{$post->caption}}</p></div>
                </div>
            </div>
            @endforeach
            <div class="row justify-content-center">
                {{$posts->links()}}
            </div>
@endsection
