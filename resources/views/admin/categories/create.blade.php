@extends('blog.layouts.admin')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">Create Category</h1>

    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">New Category</div>
     
                    <div class="card-body">
                        <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                            @csrf
     
                            <div class="form-group">
                                <label for="category">Category Name</label>
                                <input type="text" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ old('category') }}" placeholder="Enter Category Name">
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="file">Image Category</label>
                                <input id="post_category" type="file" class="form-control-file @error('post_category') is-invalid @enderror" name="post_category">
                                @error('post_category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="file">About Category</label>
                                <textarea name="about_category" id="aboutcategory" cols="30" rows="15"></textarea>
                                @error('about_category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-sm">Submit</button>
                            </div>
     
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection