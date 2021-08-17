@extends('blog.layouts.admin')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">Edit Author</h1>

    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">View Author</div>
                    <div class="card-body">
                        @foreach($authors as $author)
                        <form method="POST" action="{{ route('author.update', $author->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="author">Author</label>
                                <input type="text" class="form-control @error('author') is-invalid @enderror" name="author" value="{{ old('author', $author->author) }}" placeholder="Enter Author Name">
                                @error('author')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div><img  width="600px" src="{{ url('storage/images/author/'. $author->post_author) }}" alt=""></div>
                                <label for="file">Image Author</label>
                                <input id="post_author" type="file" class="form-control-file @error('post_author') is-invalid @enderror" name="post_author" >
                                @error('post_author')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>About Author</label>
                                <textarea name="about_author" id="aboutauthor" cols="10" rows="10">{{ old('about_author', $author->about_author) }}</textarea>
                                @error('about_author')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <textarea name="introduction" id="introduction" cols="30" rows="1">{{ old('introduction', $author->introduction) }}</textarea>
                                @error('introduction')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="author">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $author->email) }}" placeholder="Enter Author email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nationality">Nationality</label>
                                <input type="text" class="form-control @error('nationality') is-invalid @enderror" name="nationality" value="{{ old('nationality', $author->nationality) }}" placeholder="Enter Author Nationality">
                                @error('nationality')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="motivation">Motivation</label>
                                <textarea name="motivation" id="motivation" cols="30" rows="1">{{ old('motivation', $author->motivation) }}</textarea>
                                @error('motivation')
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