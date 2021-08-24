<!-- Heading -->
<div class="sidebar-heading">
    Admin Configuration
</div>

<!-- Nav Item - Pages Collapse Menu -->
@if (auth()->user()->userHasRole('Admin'))
    @include('admin.partials.sidebar-profileandrole')
@elseif(auth()->user()->userHasRole('Manager'))
    @include('admin.partials.sidebar-profileandrole')
@endif


<!-- Nav Item - Pages Collapse Menu -->
@if (auth()->user()->userHasRole('Admin'))
    @include('admin.partials.sidebar-role')
@endif


<!-- Nav Item - Pages Collapse Menu -->
@if (auth()->user()->userHasRole('Admin'))
    @include('admin.partials.sidebar-permission')
@endif

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">
