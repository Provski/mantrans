@extends('blog.layouts.admin')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">Create Author</h1>

    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">New Author</div>
     
                    <div class="card-body">
                        <form method="POST" action="{{ route('author.store') }}" enctype="multipart/form-data">
                            @csrf
     
                            <div class="form-group">
                                <label for="author">Author Name</label>
                                <input type="text" class="form-control @error('author') is-invalid @enderror" name="author" value="{{ old('author') }}" placeholder="Enter Author Name">
                                @error('author')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="file">Author Image</label>
                                <input id="post_author" type="file" class="form-control-file @error('post_author') is-invalid @enderror" name="post_author" >
                                @error('post_author')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="file">About Author</label>
                                <textarea name="about_author" id="aboutauthor" cols="30" rows="15"></textarea>
                                @error('about_author')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="file">Author Introduction</label>
                                <textarea value="{{ old('introduction') }}" name="introduction" id="introduction" cols="30" rows="1" placeholder="Introduction max 200 characters"></textarea>
                                @error('introduction')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="author">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Author email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nationality">Nationality</label>
                                <input type="text" class="form-control @error('nationality') is-invalid @enderror" name="nationality" value="{{ old('nationality') }}" placeholder="Enter Author Nationality">
                                @error('nationality')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="motivation">Motivation</label>
                                <textarea value="{{ old('motivation') }}" name="motivation" id="motivation" cols="30" rows="1" placeholder="Motivation max 200 characters"></textarea>
                                @error('motivation')
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