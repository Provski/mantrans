@extends('blog.layouts.admin')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">User Profile & Roles: <strong>{{$user->name}}</strong></h1>

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
                    <div class="card-header">Profile Avatar</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('user.profile_role.update', $user) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <div class="card img-fluid" alt="Responsive image" style="width: 25rem;">
                                        <img src="{{ $user->avatar ? url('storage/images/avatar/'. $user->avatar) : url('storage/images/avatar/avatar.jpg')}}" class="card-img img-fluid" alt="Responsive image" alt="" height="200px">
                                        <div class="card-body">
                                        </div>
                                    </div>
                                    <label for="file">Avatar</label>
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
                                    <p class="m-0 font-weight-bold text-danger">Be Careful Changes Others Account Identity</p>
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
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary"><strong>View Role</strong> (Only Admin able to Change others and Himself)</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th class="text-center">Select Role</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Slug</th>
                  <th class="text-center">Attach | Detach </th>
                  <th class="text-center">Last Modified</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($roles as $role )
                  <tr>
                      <td><input type="checkbox"
                      @foreach($user->roles as $user_role)
                              @if($user_role->slug == $role->slug)
                                  checked
                              @endif
                      @endforeach></td>
                      <td class="text-center">{{ $role->name }}</td>
                      <td class="text-center">{{ $role->slug }}</td>
                      <td class="text-center">
                        <div class="tombolrole">
                          <form method="post" action="{{route('user.role.attach', $user)}}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="role" value="{{$role->id}}">
                            <button type="submit" class="btn btn-success btn-sm"
                            @if($user->roles->contains($role))
                              disabled
                            @endif>
                              <i class="fas fa-toggle-on"></i>
                            </button>
                          </form>
                        </div>
                        <div class="tombolrole">
                          <form method="post" action="{{route('user.role.detach', $user->id)}}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="role" value="{{$role->id}}">
                            <button class="btn btn-danger btn-sm"
                            @if(!$user->roles->contains($role))
                              disabled
                            @endif>
                            <i class="fas fa-toggle-off"></i>
                            </button>
                          </form>
                        </div>
                      </td>
                      <td class="text-center">{{ $role->updated_at }}</td>
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
        {{-- <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script> --}}
@endsection