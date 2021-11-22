@if($notifications)
    @foreach($notifications as $notification)
        <li class="notification-item">
            <span> {{$notification->data['user']['name']}}  starts to follow you!</span>
            <a href="{{route('notifications.show',['id'=>$notification->id])}}">View/Mark as read </a>
        </li>
    @endforeach
@else
    <li>There's no any notification!</li>
@endif
