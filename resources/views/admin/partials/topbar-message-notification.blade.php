<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-envelope fa-fw"></i>
        <!-- Counter - Messages -->
        @foreach (auth()->user()->unreadNotifications as $notification)
            @if ($notification->data['type'] == "CommentPost")
                @if (count(auth()->user()->unreadNotifications) != 0)
                    <span class="badge badge-danger badge-counter">{{ count(auth()->user()->unreadNotifications) }}</span>
                @endif
            @endif
        @endforeach
    </a>
    <!-- Dropdown - Messages -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
        <h6 class="dropdown-header text-center">
        New Comment Alert
        </h6>
            @include('admin.notifications.comment-to-post')
        @if (count(auth()->user()->unreadNotifications) != 0)
            @if ($notification->data['type'] == "CommentPost")
                <a class="dropdown-item text-center small text-gray-500" href="{{route('markAsReadComment')}}"  onclick="markNotificationAsReadComment()">Mark all as read</a>
            @else
                <a class="dropdown-item text-center small text-gray-500" href="#">No unread Comments</a>
            @endif
        @else 
            <a class="dropdown-item text-center small text-gray-500" href="#">No unread Comments</a>
        @endif
    </div>
</li>


<script src="{{ asset('assets/js/markasreadcomment-notification.js') }}"></script>