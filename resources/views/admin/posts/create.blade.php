@extends('blog.layouts.admin')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">Create Article</h1>

    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">New Article</div>
     
                    <div class="card-body">
                        <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                            @csrf
     
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="Enter Title">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="categorycontrolselect">Category</label>
                                <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" required>
                                    <option value="">Select your Category</option>
                                    @foreach ($categories as $key)
                                        <option value="{{ $key->id }}" {{ old('category_id') == $key->id ? 'selected' : null }}>{{ $key->category }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="authorcontrolselect">Author</label>
                                <select class="form-control @error('author_id') is-invalid @enderror" name="author_id" required>
                                    <option value="">Select your Author</option>
                                    @foreach ($authors as $key)
                                        <option value="{{ $key->id }}" {{ old('author_id') == $key->id ? 'selected' : null }}>{{ $key->author }}</option>
                                    @endforeach
                                </select>
                                @error('author_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="file">Image Article</label>
                                <input id="post_image" type="file" class="form-control-file @error('post_image') is-invalid @enderror" name="post_image">
                                @error('post_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Article Content</label>
                                <textarea class="editor" name="body" id="editor" cols="30" rows="10" ></textarea>
                                @error('body')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="file">Figure Image</label>
                                <input id="figure" type="file" class="form-control-file @error('figure') is-invalid @enderror" name="figure">
                                @error('figure')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Caption Figure</label>
                                <textarea name="figure_caption" id="figurecaption" cols="30" rows="1" placeholder="Caption max 100 characters"></textarea>
                                @error('figure_caption')
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
