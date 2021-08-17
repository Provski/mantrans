@extends('blog.layouts.admin')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">View Author</h1>

    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">The Author</div>
                    <div class="card-body">
                            <div class="form-group">
                                <label for="owner">Owner</label>
                                <p class="card-text">{{ $author->user->name }}</p>
                            </div>
                            <div class="form-group">
                                <label for="author">Author</label>
                                <p class="card-text">{{ $author->author }}</p>
                            </div>
                            <div class="form-group">
                                <label for="created_at">Created at</label>
                                <p class="card-text">{{ $author->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="form-group">
                                <label for="updated_at">Updated at</label>
                                <p class="card-text">{{ $author->updated_at->diffForHumans() }}</p>
                            </div>
                            <div class="form-group">
                                <label for="introduction">Introduction</label>
                                <p class="card-text">{{ $author->introduction }}</p>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <p class="card-text">{{ $author->email }}</p>
                            </div>
                            <div class="form-group">
                                <label for="nationality">Nationality</label>
                                <p class="card-text">{{ $author->nationality }}</p>
                            </div>
                            <div class="form-group">
                                <label for="motivation">Motivation</label>
                                <p class="card-text">{{ $author->motivation }}</p>
                            </div>
                            <div class="form-group">
                                <label for="file">Image Author</label>
                                <div><img  width="1200px" src="{{ url('storage/images/author/'. $author->post_author) }}" alt=""></div>
                            </div>
                            <div class="form-group">
                                <label for="body">About Author</label>
                                <p class="card-text">{{ $author->about_author }}</p>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection