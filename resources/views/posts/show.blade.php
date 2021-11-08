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

                    <a href="/profile/{{$post->user_id}}" class="mr-2">
                        <div class="mr-4 d-flex">
                        <img class="rounded-circle mr-3" src="{{$post->user->profile->profileImage()}}" alt="" style="height: 50px; width: 50px">
                        <h3 class="mr-2 d-block">{{$post->user->username}}</h3>

                    </div>
                    </a>
                    @cannot('update', $post->user->profile)   <follow-button user-id="{{$post->user_id}}" follows="{{$follows}}"> </follow-button >
                    @endcannot
                </div>
                <hr>
                <p>{{$post->caption}}</p>
            </div>



        </div>
    </div>
@endsection
