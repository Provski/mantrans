@forelse (auth()->user()->unreadNotifications as $notification )
    @if ($notification->data['type'] == "CommentPost")
        <a class="dropdown-item d-flex align-items-center" href="{{ route('comment.view', $notification->data['comment']['id']) }}">
        <div class="dropdown-list-image mr-3">
            <img class="rounded-circle" src="{{ $notification->data['user']['avatar'] ? url('storage/images/avatar/'. $notification->data['user']['avatar']) : url('storage/images/avatar/avatar.jpg') }}" alt="">
            <div class="status-indicator bg-success"></div>
        </div>
        <div class="font-weight-bold">
            <div class="text-truncate">{{ $notification->data['message']}}</div>
            <div class="small text-gray-500">{{ $notification->data['user']['name'] }} · {{ \Carbon\Carbon::parse($notification->data['comment']['created_at'])->diffForHumans() }}</div>
        </div>
    </a>
    @endif
    @empty
@endforelse

