<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAuthor" aria-expanded="true" aria-controls="collapseAuthor">
        <i class="fas fa-user-edit"></i>
        <span>Authors</span>
    </a>
    <div id="collapseAuthor" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Authors</h6>
            @if (auth()->user()->userHasRole('Admin'))
                <a class="collapse-item" href="{{ route('author.create') }}">Create an Author </a>
            @elseif (auth()->user()->userHasRole('Manager'))
                <a class="collapse-item" href="{{ route('author.create') }}">Create an Author </a>
            @endif
            <a class="collapse-item" href="{{ route('author.index') }}">View All Authors</a>
        </div>
    </div>
</li>