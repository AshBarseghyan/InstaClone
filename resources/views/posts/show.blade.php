@extends('layouts.app')

@section('content')
       <div class="container mt-5">
        <div class="row  " >
        <div class="col-8">

            <img src="/storage/{{$post->image}}" alt="" class="w-100">

        </div>
{{--            {{$user->profile->profileImage()}}--}}
            <div class="col-4 ">
                <div class="d-flex">
                    <div class="mr-4"> <img class="rounded-circle" src="{{$post->user->profile->profileImage()}}" alt="" style="height: 50px; width: 50px"></div>
                    <a href="/profile/{{$post->user_id}}"> <h3 class="mr-2">{{$post->user->username}}</h3> </a>
                    <a href="#">Follow</a>
                </div>
                <hr>
                <p>{{$post->caption}}</p>
            </div>



        </div>
    </div>
@endsection
