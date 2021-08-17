
@extends('blog.layouts.admin')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">All Roles</h1>

    @if (Session::has('message'))
      <div id="flash" data-flash="{{ Session::get('message') }}"></div>
    @elseif (Session::has('message-created'))
      <div id="flash" data-flash="{{ Session::get('message-created') }}"></div>
    @elseif (Session::has('message-updated'))
      <div id="flash" data-flash="{{ Session::get('message-updated') }}"></div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">View Roles</h6>
        </div>
        <div class="row">
          <div class="col-sm-3 md-3 lg-3">
            <div class="card-body">
              <form method="post" action="{{route('role.store')}}">
                @csrf
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter New Role">
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
                      <th class="text-center">Edit Role</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($roles as $role )
                      <tr>
                          <td class="text-center">{{ $role->id }}</td>
                          <td class="text-center">{{ $role->name }}</td>
                          <td class="text-center">{{ $role->slug }}</td>
                          <td class="text-center">
                            <div class="tombolrole">
                              <a href="{{ route('role.edit', $role->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                              </a>
                            </div>
                            <div class="tombolrole">
                              <form method="POST" action="{{ route('role.destroy', $role->id) }}"  >
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

      