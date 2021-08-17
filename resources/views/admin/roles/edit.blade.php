@extends('blog.layouts.admin')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">Edit Roles: <strong>{{$role->name}}</strong></h1>

    @if (Session::has('message'))
      <div id="flash" data-flash="{{ Session::get('message') }}"></div>
    @elseif (Session::has('message-created'))
      <div id="flash" data-flash="{{ Session::get('message-created') }}"></div>
    @elseif (Session::has('message-updated'))
      <div id="flash" data-flash="{{ Session::get('message-updated') }}"></div>
    @endif

    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Role Name</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('role.update', $role->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('role', $role->name) }}">
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
    
    <!-- DataTales Example -->
    <div class="container">
    @if($permissions->isNotEmpty())
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">View Permissions</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th class="text-center">Selected</th>
                  <th class="text-center">id</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Slug</th>
                  <th class="text-center">Attach | Detach </th>
                  <th class="text-center">Last Modified</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($permissions as $permission )
                  <tr>
                      <td><input type="checkbox"
                      @foreach($role->permissions as $role_permission)
                              @if($role_permission->slug == $permission->slug)
                                  checked
                              @endif
                      @endforeach></td>
                      <td class="text-center">{{ $permission->id }}</td>
                      <td class="text-center">{{ $permission->name }}</td>
                      <td class="text-center">{{ $permission->slug }}</td>
                      <td class="text-center">
                        <div class="tombolpermission">
                          <form method="post" action="{{route('role.permission.attach', $role)}}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="permission" value="{{$permission->id}}">
                            <button type="submit" class="btn btn-success btn-sm"
                            @if($role->permissions->contains($permission))
                              disabled
                            @endif>
                              <i class="fas fa-toggle-on"></i>
                            </button>
                          </form>
                        </div>
                        <div class="tombolpermission">
                          <form method="post" action="{{route('role.permission.detach', $role)}}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="permission" value="{{$permission->id}}">
                            <button class="btn btn-danger btn-sm"
                            @if(!$role->permissions->contains($permission))
                              disabled
                            @endif>
                            <i class="fas fa-toggle-off"></i>
                            </button>
                          </form>
                        </div>
                      </td>
                      <td class="text-center">{{ $permission->updated_at }}</td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    @endif


@endsection

@section('scripts')
        <!-- Page level plugins -->
        <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>

        <!-- Colored-Toast Sweetalert -->
        <script src="{{ asset('assets/sweetalert/sweetalert2.min.js') }}"></script>
        <script>
          var flash = $('#flash').data('flash');
          if(flash){
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-right',
              iconColor: 'white',
              customClass: {
                popup: 'colored-toast'
              },
              showConfirmButton: false,
              timer: 6000,
              timerProgressBar: true
            })
            @if(Session::has('message'))
            Toast.fire({
              icon: 'error',
              title: '{{ Session::get('message') }}'
            })
            @elseif(Session::has('message-created'))
            Toast.fire({
              icon: 'success',
              title: '{{ Session::get('message-created') }}'
            })
            @elseif(Session::has('message-updated'))
            Toast.fire({
              icon: 'warning',
              title: '{{ Session::get('message-updated') }}'
            })
            @endif
          }
        </script>


@endsection