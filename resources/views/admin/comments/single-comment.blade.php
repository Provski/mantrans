@extends('blog.layouts.admin')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">View Comment</h1>

    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">The Comment</div>
                    <div class="card-body">
                            <div class="form-group">
                                <label for="title">Name</label>
                                <p class="card-text">{{ $comment->user->name }}</p>
                            </div>
                            <div class="form-group">
                                <label for="created_at">Created at</label>
                                <p class="card-text">{{ $comment->created_at->format('D, d F Y') }}  -  {{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="form-group">
                                <label for="updated_at">Comment Article</label>
                                <p class="card-text">{{ $comment->comment }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Approve | Unapprove</label>
                                @if ($comment->is_active == 1)
                                    <form action="{{ route('comment.update', $comment->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="is_active" value="0">
                                            <button class="btn btn-warning btn-sm" type="submit">Unapprove</button>
                                    </form>
                                @elseif ($comment->is_active == 0)
                                    <form action="{{ route('comment.update', $comment->id) }}" method="POST">
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