<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseQuotes" aria-expanded="true" aria-controls="collapseQuotes">
        <i class="fas fa-quote-left"></i>
        <span>Quotes</span>
    </a>
    <div id="collapseQuotes" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Quotes</h6>
            @if (auth()->user()->userHasRole('Admin'))
                <a class="collapse-item" href="{{ route('quote.create') }}">Create Quotes</a>
            @elseif (auth()->user()->userHasRole('Manager'))
                <a class="collapse-item" href="{{ route('quote.create') }}">Create Quotes</a>
            @endif
            <a class="collapse-item" href="{{ route('quote.index') }}">View All Quotes</a>
        </div>
    </div>
</li>