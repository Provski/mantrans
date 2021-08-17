@extends('blog.layouts.admin')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">Edit Category</h1>

    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">View Category</div>
                    <div class="card-body">
                        @foreach($categories as $category)
                        <form method="POST" action="{{ route('category.update', $category->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="category">Category</label>
                                <input type="text" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ old('category', $category->category) }}" placeholder="Edit Category">
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div><img  width="600px" src="{{ url('storage/images/category/'. $category->post_category) }}" alt=""></div>
                                <label for="file">Image Category</label>
                                <input id="post_category" type="file" class="form-control-file @error('post_category') is-invalid @enderror" name="post_category" >
                                @error('post_category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>About Category</label>
                                <textarea name="about_category" id="aboutcategory" cols="30" rows="10">{{ old('about_category', $category->about_category) }}</textarea>
                                @error('about_category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info btn-sm">Update</button>
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection