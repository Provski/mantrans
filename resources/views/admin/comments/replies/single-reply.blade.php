@extends('blog.layouts.admin')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">View Reply</h1>

    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">The Reply</div>
                    <div class="card-body">
                            <div class="form-group">
                                <label for="title">Name</label>
                                <p class="card-text">{{ $commentreply->user->name }}</p>
                            </div>
                            <div class="form-group">
                                <label for="created_at">Created at</label>
                                <p class="card-text">{{ $commentreply->created_at->format('D, d F Y') }}  -  {{ $commentreply->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="form-group">
                                <label for="updated_at">Comment Replied Article</label>
                                <p class="card-text">{{ $commentreply->reply }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Approve | Unapprove</label>
                                @if ($commentreply->is_active == 1)
                                    <form action="{{ route('commentreply.update', $commentreply->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="is_active" value="0">
                                        <button class="btn btn-warning btn-sm" type="submit">Unapprove</button>
                                    </form>
                                @else
                                    <form action="{{ route('commentreply.update', $commentreply->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="is_active" value="1">
                                        <button class="btn btn-info btn-sm" type="submit">Approve</button>
                                    </form>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection