<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRoles" aria-expanded="true" aria-controls="collapseRoles">
        <i class="fas fa-paint-roller"></i>
        <span>Roles</span>
    </a>
    <div id="collapseRoles" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Roles</h6>
            <a class="collapse-item" href="{{route('role.index', auth()->user())}}">Add or Remove Role</a>
        </div>
    </div>
</li>