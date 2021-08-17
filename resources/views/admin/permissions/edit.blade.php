@extends('blog.layouts.admin')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">Edit Permissions: <strong>{{$permission->name}}</strong></h1>

    @if (Session::has('message'))
    <div class="alert alert-danger">{{ Session::get('message') }}</div>
        @elseif(Session::has('message-created'))
    <div class="alert alert-success">{{ Session::get('message-created') }}</div>
        @elseif (Session::has('message-updated'))
    <div class="alert alert-warning">{{ Session::get('message-updated') }}</div>
    @endif

    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Permission Name</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('permission.update', $permission->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('permission', $permission->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Update</button>
                                </div>
        
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    <br>
    
    


@endsection

@section('scripts')
    <!-- Page level plugins -->
        <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
        <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
@endsection