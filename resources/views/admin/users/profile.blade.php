@extends('blog.layouts.admin')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">User Profile : <strong>{{$user->name}}</strong></h1>

    @if (Session::has('message'))
    <div class="alert alert-danger">{{ Session::get('message') }}</div>
    @elseif (Session::has('message-updated'))
    <div class="alert alert-success">{{ Session::get('message-updated') }}</div>
    @endif
    
    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">My Avatar</div>
     
                        <div class="card-body">
                        
                            <form method="POST" action="{{ route('user.profile.update', $user) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <div class="card img-fluid" alt="Responsive image" style="width: 25rem;">
                                        <img src="{{ $user->avatar ? url('storage/images/avatar/'. $user->avatar) : url('storage/images/avatar/avatar.jpg')}}" class="card-img img-fluid" alt="Responsive image" height="200px">
                                        <div class="card-body">
                                        </div>
                                    </div>
                                    <label for="file">Avatar max 300KB | dimension image ratio suggest 1:1</label>
                                    <input id="avatar" type="file" class="form-control-file @error('avatar') is-invalid @enderror" name="avatar" >
                                    @error('avatar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}">
                                    @error('email')
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
