@extends('blog.layouts.admin')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">All Posts</h1>

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
          <h6 class="m-0 font-weight-bold text-primary">View Posts</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">Owner</th>
                  <th class="text-center">Author</th>
                  <th class="text-center">Category</th>
                  <th class="text-center">Title</th>
                  <th class="text-center">Image</th>
                  <th class="text-center">Figure</th>
                  <th class="text-center">Caption</th>
                  <th class="text-center" width="170px">Action</th>
                </tr>
              </thead>
              <tbody>
                  <?php $i = 0 ?>
                  @foreach ($posts as $post )
                  <?php $i++ ?>
                  <tr>
                      <td>{{ $i }}</td>
                      <td>{{ $post->user->name }}</td>
                      <td>{{ $post->author->author }}</td>
                      <td>{{ $post->category->category }}</td>
                      <td>{{ $post->title }}</td>
                      <td>
                          <img height="50px" width="80px" src="{{ url('storage/images/post/'. $post->post_image) }}" alt="">
                      </td>
                      <td>
                        <img height="50px" width="80px" src="{{ url('storage/images/figure/'. $post->figure) }}" alt="">
                      </td>
                      <td>{{ Str::limit($post->figure_caption, 20, ' ...') }}</td>
                      <td class="text-center">
                        <div class="tombolpost">
                          <a href="{{ route('post.view', $post->slug) }}" class="btn btn-info btn-sm">
                            <i class="far fa-eye"></i>
                          </a>
                        </div>
                        <div class="tombolpost">
                          @if (auth()->user()->userHasRole('Admin'))
                            <a href="{{ route('post.edit', $post->slug) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                          @elseif (auth()->user()->userHasRole('Manager'))
                            <a href="{{ route('post.edit', $post->slug) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                          @elseif (auth()->user()->userHasRole('Author'))
                            <a href="{{ route('post.edit', $post->slug) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                          @endif
                        </div>
                        <div class="tombolpost">
                          <form method="POST" action="{{ route('post.destroy', $post->slug) }}"  >
                              @method('delete')
                              @csrf
                              @if (auth()->user()->userHasRole('Admin'))
                                  <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                              @elseif (auth()->user()->userHasRole('Manager'))
                                  <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                              @elseif (auth()->user()->userHasRole('Author'))
                                  <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                              @endif
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

