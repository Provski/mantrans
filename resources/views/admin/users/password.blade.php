@extends('blog.layouts.admin')

@section('content')
    {{-- @foreach($user as $user) --}}
    <h1 class="h3 mb-4 text-gray-800">Change Password Profile : <strong>{{$user->name}}</strong></h1>
    {{-- @endforeach --}}
    @if (Session::has('message'))
    <div class="alert alert-danger">{{ Session::get('message') }}</div>
    @elseif (Session::has('message-updated'))
    <div class="alert alert-success">{{ Session::get('message-updated') }}</div>
    @endif

    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Change Your Password Below</div>
     
                    <div class="card-body">
                    
                        <form method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="old_password">Old Password</label>
                                <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" name="old_password">
                                @error('old_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-sm">Update Password</button>
                            </div>
     
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection