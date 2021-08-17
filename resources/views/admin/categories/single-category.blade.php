@extends('blog.layouts.admin')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">View Category</h1>

    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">The Category</div>
                    <div class="card-body">
                            <div class="form-group">
                                <label for="owner">Owner</label>
                                <p class="card-text">{{ $category->user->name }}</p>
                            </div>
                            <div class="form-group">
                                <label for="title">Category</label>
                                <p class="card-text">{{ $category->category }}</p>
                            </div>
                            <div class="form-group">
                                <label for="created_at">Created at</label>
                                <p class="card-text">{{ $category->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="form-group">
                                <label for="updated_at">Updated at</label>
                                <p class="card-text">{{ $category->updated_at->diffForHumans() }}</p>
                            </div>
                            <div class="form-group">
                                <label for="file">Image Category</label>
                                <div><img  width="1200px" src="{{ url('storage/images/category/'. $category->post_category) }}" alt=""></div>
                            </div>
                            <div class="form-group">
                                <label>About Category</label>
                                <p class="card-text">{{ $category->about_category }}</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection