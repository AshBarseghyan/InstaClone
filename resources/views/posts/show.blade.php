@extends('layouts.app')


@section('content')
    <div class="container mt-5">
        <div class="row  ">
            <div class="col-8">
                <img src="/storage/{{$post->image}}" alt="" class="w-100">
            </div>
            <div class="col-4 ">
                <div class="d-flex">
                    <a href="{{route('profile.show',['user'=>$post->user_id])}}" class="mr-2">
                        <div class="mr-4 d-flex align-items-center">
                            <img class=" rounded-circle mr-3"
                                 src="{{$post->user->profile->profileImage()}}" alt=""
                                 style="height: 50px; width: 50px">
                            <h3 class="mr-2 d-block">{{$post->user->username}}</h3>
                        </div>
                    </a>
                    @cannot('update', $post->user->profile)
                        <div class="d-flex align-items-center">
                            <div class="mr-3 ">
                                <img id="heart"
                                     src=" @if(Auth::user()->likePost->contains($post->id))  /Svg/heart_likes.svg
                                            @else  /Svg/heart.svg
                                       @endif"
                                     alt="Heart" style="cursor: pointer">
                                <p id="likes_count" class="text-center mb-0" style="font-size: 9px">{{$likes}}</p>
                            </div>
                            <follow-button user-id="{{$post->user_id}}" follows="{{$follows}}"></follow-button>
                        </div>
                    @endcannot
                </div>
                <hr>
                <p>{{$post->caption}}</p>
            </div>
        </div>
    </div>
@endsection


<script>

    $(document).ready(function () {
        {{--let likes = {{$likes}};--}}
        $('#heart').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('like.store',['post'=>$post->id])}}",
                method: 'get',
                // data:{
                //     sign_in:true,
                //     email: email,
                //     password:password
                // },
                success: function (result) {
                    if (result['attached'][0]) {
                        document.getElementById("heart").src = "/Svg/heart_likes.svg";
                        // ++likes;
                    } else {
                        document.getElementById("heart").src = "/Svg/heart.svg";
                        //   --likes;
                    }
                    $("#likes_count").load(location.href + " #likes_count");
                    // document.getElementById("likes_count").innerHTML = likes;
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });
        });
    });
</script>
