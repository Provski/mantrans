<!-- Heading -->
<div class="sidebar-heading">
    Admin Configuration
</div>

<!-- Nav Item - Pages Collapse Menu -->
    @include('admin.partials.sidebar-profileandrole')


{{-- @if (auth()->user()->userHasRole('Admin')) --}}
<!-- Nav Item - Pages Collapse Menu -->
    @include('admin.partials.sidebar-role')

<!-- Nav Item - Pages Collapse Menu -->
    @include('admin.partials.sidebar-permission')
{{-- @endif --}}

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">
