<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePost" aria-expanded="true" aria-controls="collapsePost">
        <i class="fas fa-fw fa-cog"></i>
        <span>Posts</span>
    </a>
    <div id="collapsePost" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Posts</h6>
            @if (auth()->user()->userHasRole('Admin'))
                <a class="collapse-item" href="{{ route('post.create') }}">Create a Post</a>
            @elseif (auth()->user()->userHasRole('Manager'))
                <a class="collapse-item" href="{{ route('post.create') }}">Create a Post</a>
            @elseif (auth()->user()->userHasRole('Author'))
                <a class="collapse-item" href="{{ route('post.create') }}">Create a Post</a>
            @endif
            <a class="collapse-item" href="{{ route('post.index') }}">View All Posts</a>
        </div>
    </div>
</li>