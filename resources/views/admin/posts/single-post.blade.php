@extends('blog.layouts.admin')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">View Article</h1>

    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">The Article</div>
                    <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <p class="card-text">{{ $post->title }}</p>
                            </div>
                            <div class="form-group">
                                <label for="created_at">Created at</label>
                                <p class="card-text">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="form-group">
                                <label for="updated_at">Updated at</label>
                                <p class="card-text">{{ $post->updated_at->diffForHumans() }}</p>
                            </div>
                            <div class="form-group">
                                <label for="categorycontrolselect">Category</label>
                                <p class="card-text">{{ $post->category->category }}</p>
                            </div>
                            <div class="form-group">
                                <label for="authorcontrolselect">Author</label>
                                <p class="card-text">{{ $post->author->author }}</p>
                            </div>
                            <div class="form-group">
                                <label for="file">Image Article</label>
                                <div><img  width="1200px" src="{{ url('storage/images/post/'. $post->post_image) }}" alt=""></div>
                            </div>
                            <div class="form-group">
                                <label for="body">Article</label>
                                <p class="card-text">{!!$post->body!!}</p>
                            </div>
                            <div class="form-group">
                                <label for="file">Figure Image</label>
                                <div><img  width="1200px" src="{{ url('storage/images/figure/'. $post->figure) }}" alt=""></div>
                            </div>
                            <div class="form-group">
                                <label for="figurecaption">Figure Caption</label>
                                <p class="card-text">{{ $post->figure_caption }}</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection