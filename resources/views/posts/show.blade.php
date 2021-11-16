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
                            <img class="rounded-circle mr-3"
                                 src="{{$post->user->profile->profileImage()}}" alt=""
                                 style="height: 50px; width: 50px">
                            <h3 class="mr-2 d-block">{{$post->user->username}}</h3>
                        </div>
                    </a>


                    @cannot('update', $post->user->profile)
                    <div class="d-flex align-items-center"> <div class="mr-3"><img
                                id="heart"
                                src=" @if(Auth::user()->likePost->contains($post->id))  /Svg/heart_likes.svg

                            @else  /Svg/heart.svg
                            @endif"



                     alt="Heart" style="cursor: pointer"></div>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>

    $(document).ready(function () {
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
                    } else {
                        document.getElementById("heart").src = "/Svg/heart.svg";
                    }
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });
        });
    });
</script>
