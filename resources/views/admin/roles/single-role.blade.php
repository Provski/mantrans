@extends('blog.layouts.admin')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">View User Profile & Roles</h1>

    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">The Quote</div>
                    <div class="card-body">
                            <div class="form-group">
                                <label for="file">Avatar</label>
                                <div><img width="1200px" src="{{ $user->avatar ? url('storage/images/avatar/'. $user->avatar) : url('storage/images/avatar/avatar.jpg')}}" class="card-img" alt="" height="200px"></div>
                                <p class="card-text">{{ $user->name }}</p>
                            </div>
                            <div class="form-group">
                                <label for="created_at">Created at</label>
                                <p class="card-text">{{ $user->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="form-group">
                                <label for="updated_at">Updated at</label>
                                <p class="card-text">{{ $user->updated_at->diffForHumans() }}</p>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <p class="card-text">{{ $user->email }}</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection