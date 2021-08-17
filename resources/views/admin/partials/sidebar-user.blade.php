<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
        <i class="fas fa-user-edit"></i>
        <span>Users</span>
    </a>
    <div id="collapseUser" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Users</h6>
            <a class="collapse-item" href="{{ route('user.profile.show', auth()->user()) }}">Show Profile </a>
            <a class="collapse-item" href="{{ route('user.password.edit', auth()->user()) }}">Change Password Profile </a>
            @if (auth()->user()->userHasRole('Admin'))
                <a class="collapse-item" href="{{ route('user.index') }}">View All Users</a>
            @elseif (auth()->user()->userHasRole('Manager'))
                <a class="collapse-item" href="{{ route('user.index') }}">View All Users</a>
            @endif
        </div>
    </div>
</li>