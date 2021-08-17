
@extends('blog.layouts.admin')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">All Permissions</h1>

    @if (Session::has('message'))
    <div class="alert alert-danger">{{ Session::get('message') }}</div>
        @elseif(Session::has('message-created'))
    <div class="alert alert-success">{{ Session::get('message-created') }}</div>
        @elseif (Session::has('message-updated'))
    <div class="alert alert-warning">{{ Session::get('message-updated') }}</div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">View Permissions</h6>
        </div>
        <div class="row">
          <div class="col-sm-3 md-3 lg-3">
            <div class="card-body">
              <form method="post" action="{{route('permission.store')}}">
                @csrf
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter New Permission">
                  @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                  </div>
                <button class="btn btn-primary btn-block" type="submit">Create</button>
              </form>
            </div>
          </div>  
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th class="text-center">Id</th>
                      <th class="text-center">name</th>
                      <th class="text-center">slug</th>
                      <th class="text-center">Edit Permission</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($permissions as $permission)
                      <tr>
                          <td class="text-center">{{ $permission->id }}</td>
                          <td class="text-center">{{ $permission->name }}</td>
                          <td class="text-center">{{ $permission->slug }}</td>
                          <td class="text-center">
                            <div class="tombolpermission">
                              <a href="{{ route('permission.edit', $permission->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                              </a>
                            </div>
                            <div class="tombolpermission">
                              <form method="POST" action="{{ route('permission.destroy', $permission->id) }}"  >
                                  @method('delete')
                                  @csrf
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                              </form>
                            </div>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div>
      </div>

@endsection

@section('scripts')
    <!-- Page level plugins -->
        <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
        <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>

@endsection

      