<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory" aria-expanded="true" aria-controls="collapseCategory">
        <i class="far fa-address-book"></i>
        <span>Category</span>
    </a>
    <div id="collapseCategory" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Categories</h6>
            @if (auth()->user()->userHasRole('Admin'))
                <a class="collapse-item" href="{{ route('category.create') }}">Create Category </a>
            @elseif (auth()->user()->userHasRole('Manager'))
                <a class="collapse-item" href="{{ route('category.create') }}">Create Category </a>
            @endif
            <a class="collapse-item" href="{{ route('category.index') }}">View All Categories</a>
        </div>
    </div>
</li>