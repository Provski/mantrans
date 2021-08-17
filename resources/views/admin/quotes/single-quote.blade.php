@extends('blog.layouts.admin')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">View Quote</h1>

    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">The Quote</div>
                    <div class="card-body">
                            <div class="form-group">
                                <label for="owner">Owner</label>
                                <p class="card-text">{{ $quote->user->name }}</p>
                            </div>
                            <div class="form-group">
                                <label for="created_at">Created at</label>
                                <p class="card-text">{{ $quote->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="form-group">
                                <label for="updated_at">Updated at</label>
                                <p class="card-text">{{ $quote->updated_at->diffForHumans() }}</p>
                            </div>
                            <div class="form-group">
                                <label for="title">Title Quote</label>
                                <p class="card-text">{{ $quote->title }}</p>
                            </div>
                            <div class="form-group">
                                <label for="content">Quote Content</label>
                                <p class="card-text">{{ $quote->content }}</p>
                            </div>
                            <div class="form-group">
                                <label for="name">Quote Author</label>
                                <p class="card-text">{{ $quote->name }}</p>
                            </div>
                            <div class="form-group">
                                <p class="card-text">{{ $quote->about_category }}</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection