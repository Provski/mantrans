<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProfileandRole" aria-expanded="true" aria-controls="collapseProfileandRole">
        <i class="fas fa-users-cog"></i>
        <span>Users & Roles</span>
    </a>
    <div id="collapseProfileandRole" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Profile & Role</h6>
            <a class="collapse-item" href="{{route('user.profile_role.update', auth()->user())}}">User Profile & Roles</a>
            <a class="collapse-item" href="{{route('user_list.index')}}">View All Users & Roles</a>
        </div>
    </div>
</li>