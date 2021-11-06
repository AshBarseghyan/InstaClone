@extends('layouts.app')

@section('content')
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Dashboard') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    {{ __('You are logged in!') }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


<div class="container mt-5">
    <div class="row  " style="margin-bottom: 100px">


           <div class="col-3"> <img class="rounded-circle" src="{{$user->profile->profileImage()}}" alt="" style="height: 170px; width: 170px"></div>

            <div class="col-9">
                <div class="d-flex np justify-content-between ">

                    <h3>{{$user->username}}</h3>
                    @cannot('update', $user->profile)   <follow-button onclick="reloadFollowers()" user-id="{{$user->id}}" follows="{{$follows}}"> </follow-button >
                    @endcannot


                    @can('update', $user->profile)  <a class="btn btn-primary" href="/p/create">Add New Post</a>
                    @endcan

                </div>

                <div class="d-flex " >

                    <div class="mr-3"><strong class="mr-1">{{$postsCount}}</strong>posts</div>
                    <div  class="mr-3"><strong id="followers"  class="mr-1">{{$followersCount}}</strong>followers</div>
                    <div class="mr-3"><strong class="mr-1">{{$followingCount}}</strong>following</div>



                </div>
                @can('update', $user->profile)  <a href="/profile/{{$user->id}}/edit">Edit Profile</a> @endcan

                <div class="mt-3">

                    <strong>{{$user->profile->title}}</strong>

                <p class="mb-0">{{$user->profile->description}}</p>
                    @if($user->profile->url)
                   <a href="{{$user->profile->url}}" target="_blank">MyChannel</a>
                    @endif
                </div>


            </div>


    </div>




    <div class="row">

        @foreach($user->posts as $post)

            <div class="col-4 pb-4 ">
                <a href="/p/{{$post->id}}">
                    <img src="/storage/{{$post->image}}" alt="" class="rounded  w-100">
                </a>
            </div>

        @endforeach

    </div>
</div>
@endsection
<script>
    function reloadFollowers() {
        
        $("#followers").load(location.href + " #followers");

    }
</script>
