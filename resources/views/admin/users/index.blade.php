
@extends('blog.layouts.admin')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">All Users</h1>

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
          <h6 class="m-0 font-weight-bold text-primary">View User</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">name</th>
                  {{-- <th class="text-center">Status</th> --}}
                  <th class="text-center">Avatar</th>
                  <th class="text-center">Created</th>
                  <th class="text-center">Updated</th>
                  <th class="text-center" width="170px">User Status</th>
                </tr>
              </thead>
              <tbody>
                  <?php $i = 0 ?>
                  @foreach ($users as $user )
                  <?php $i++ ?>
                  <tr>
                      <td class="text-center">{{ $i }}</td>
                      <td class="text-center">{{ $user->name }}</td>
                      {{-- <td>{{ $user->is_active }}</td> --}}
                      <td class="text-center">
                          <img height="40px" width="40px" src="{{ $user->avatar ? url('storage/images/avatar/'. $user->avatar) : url('storage/images/avatar/avatar.jpg') }}" alt="">
                      </td>
                      <td class="text-center">{{ $user->created_at->diffForHumans() }}</td>
                      <td class="text-center">{{ $user->updated_at->diffForHumans() }}</td>
                      <td class="text-center">
                        <input data-id="{{$user->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="On" data-off="Off" {{ $user->status==true ? 'checked' : '' }}
                        @if($user->userHasRole('Admin'))
                          disabled
                        @endif>
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

        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

        <script>
        $(function() {
          $('.toggle-class').change(function() {
              var status = $(this).prop('checked') == true ? 1 : 0; 
              var user_id   = $(this).data('id'); 
              
              $.ajax({
                  type: "GET",
                  dataType: "json",
                  url: '{{route("changeStatus")}}',
                  data: {'status': status, 'user_id': user_id},
                  success: function(data){
                    console.log(data.success)
                  }
              });
          })
        })
      </script>


@endsection

      