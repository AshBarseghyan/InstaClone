@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">
        <div>
            <h1>Your notifications</h1>
            <ul>
                @if($notifications)
                    @foreach($notifications as $notification)
                        <li id={{$notification->id}} class="notification-item">
                            <span> {{$notification->data['user']['name']}}  starts to follow you!</span>
                        </li>
                        <br>
                    @endforeach
                @else
                    <li>There's no any notification!</li>
                @endif
            </ul>
        </div>
    </div>
@endsection
