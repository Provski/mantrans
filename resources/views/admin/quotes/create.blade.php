@extends('blog.layouts.admin')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">Create Quote</h1>

    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">New Quote</div>
     
                    <div class="card-body">
                        <form method="POST" action="{{ route('quote.store') }}" enctype="multipart/form-data">
                            @csrf
     
                            <div class="form-group">
                                <label for="title">Quote Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="Enter Quote Title">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="content">Quote Content</label>
                                <textarea name="content" id="quotecontent" cols="30" rows="10"></textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Quote Author</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter Quote Author">
                                @error('name')
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