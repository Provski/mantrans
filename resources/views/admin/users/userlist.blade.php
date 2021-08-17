
@extends('blog.layouts.admin')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">All Users</h1>

    {{-- @if (Session::has('message'))
    <div class="alert alert-danger">{{ Session::get('message') }}</div>
        @elseif(Session::has('message-created'))
    <div class="alert alert-success">{{ Session::get('message-created') }}</div>
        @elseif (Session::has('message-updated'))
    <div class="alert alert-warning">{{ Session::get('message-updated') }}</div>
    @endif --}}

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
          <h6 class="m-0 font-weight-bold text-primary">View User</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th class="text-center">Id</th>
                  <th class="text-center">name</th>
                  <th class="text-center">Avatar</th>
                  <th class="text-center">Created</th>
                  <th class="text-center">Updated</th>
                  <th class="text-center" width="170px">User Status</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($users as $user )
                  <tr>
                      <td class="text-center">{{ $user->id }}</td>
                      <td class="text-center">{{ $user->name }}</td>
                      <td class="text-center">
                          <img height="30px" width="50px" src="{{ $user->avatar ? url('storage/images/avatar/'. $user->avatar) : url('storage/images/avatar/avatar.jpg') }}" alt="">
                      </td>
                      <td class="text-center">{{ $user->created_at->diffForHumans() }}</td>
                      <td class="text-center">{{ $user->updated_at->diffForHumans() }}</td>
                      <td class="text-center">
                        <div class="tomboluser">
                          <a href="{{ route('user.profile_role.update', $user->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                          </a>
                        </div>
                        <div class="tomboluser">
                          <form method="POST" action="{{ route('user.destroy', $user->id) }}"  >
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

      