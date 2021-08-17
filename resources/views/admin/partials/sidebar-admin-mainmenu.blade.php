<!-- Heading -->
<div class="sidebar-heading">
    Interface
</div>

    <!-- Nav Item - Users Collapse Menu -->
    @include('admin.partials.sidebar-user')

    <!-- Nav Item - Posts Collapse Menu -->
        @include('admin.partials.sidebar-commentsandreplies')

    <!-- Nav Item - Posts Collapse Menu -->
    @if(!auth()->user()->userHasRole('User'))
        @include('admin.partials.sidebar-post')
    @endif

    <!-- Nav Item - Authors Collapse Menu -->
    @if(!auth()->user()->userHasRole('User'))
        @include('admin.partials.sidebar-author')
    @endif

    <!-- Nav Item - Categories Collapse Menu -->
    @if(!auth()->user()->userHasRole('User'))
        @include('admin.partials.sidebar-category')
    @endif

    <!-- Nav Item - Quotes Collapse Menu -->
    @if(!auth()->user()->userHasRole('User'))
        @include('admin.partials.sidebar-quote')
    @endif

<!-- Divider -->
<hr class="sidebar-divider">