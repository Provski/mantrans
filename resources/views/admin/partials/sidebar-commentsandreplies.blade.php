<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCommentReply" aria-expanded="true" aria-controls="collapseCommentReply">
        <i class="fas fa-comments"></i>
        <span>Comments & Replies</span>
    </a>
    <div id="collapseCommentReply" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Comments & Replies</h6>
            @if (auth()->user()->userHasRole('Admin'))
                <a class="collapse-item" href="{{ route('comment.index') }}">View Comments</a>
            @elseif (auth()->user()->userHasRole('Manager'))
                <a class="collapse-item" href="{{ route('comment.index') }}">View Comments</a>
            @elseif (auth()->user()->userHasRole('Author'))
                <a class="collapse-item" href="{{ route('comment.index') }}">View Comments</a>
            @elseif (auth()->user()->userHasRole('Subscriber'))
                <a class="collapse-item" href="{{ route('comment.index') }}">View Comments</a>
            @elseif (auth()->user()->userHasRole('User'))
                <a class="collapse-item" href="{{ route('comment.index') }}">View Comments</a>
            @endif
            @if (auth()->user()->userHasRole('Admin'))
                <a class="collapse-item" href="{{ route('reply.index') }}">View All Replies</a>
            @elseif (auth()->user()->userHasRole('Manager'))
                <a class="collapse-item" href="{{ route('reply.index') }}">View All Replies</a>
            @elseif (auth()->user()->userHasRole('Author'))
                <a class="collapse-item" href="{{ route('reply.index') }}">View All Replies</a>
            @elseif (auth()->user()->userHasRole('Subscriber'))
                <a class="collapse-item" href="{{ route('reply.index') }}">View All Replies</a>
            @elseif (auth()->user()->userHasRole('User'))
                <a class="collapse-item" href="{{ route('reply.index') }}">View All Replies</a>
            @endif
        </div>
    </div>
</li>