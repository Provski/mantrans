
@extends('blog.layouts.admin')

@section('content')

    @if (Session::has('message'))
      <div id="flash" data-flash="{{ Session::get('message') }}"></div>
    @elseif (Session::has('message-created'))
      <div id="flash" data-flash="{{ Session::get('message-created') }}"></div>
    @elseif (Session::has('message-updated'))
      <div id="flash" data-flash="{{ Session::get('message-updated') }}"></div>
    @endif

    @if (count($comments) > 0)
    <h1 class="h3 mb-4 text-gray-800">All Comments</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">View Comments</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">name</th>
                  <th class="text-center">Avatar</th>
                  <th class="text-center">Comment</th>
                  <th class="text-center">Approve | Unapprove </th>
                  <th class="text-center" width="120px">Action</th>
                </tr>
              </thead>
              <tbody>
                  <?php $i = 0 ?>
                  @foreach ($comments as $comment )
                  <?php $i++ ?>
                  <tr>
                      <td class="text-center">{{ $i }}</td>
                      <td class="text-center">{{ $comment->user->name }}</td>
                      <td class="text-center">
                          <img height="40px" width="40px" src="{{ $comment->avatar ? url('storage/images/avatar/'. $comment->avatar) : url('storage/images/avatar/avatar.jpg') }}" alt="">
                      </td>
                      <td class="text-center"><a href="{{ route('blog.post', [$comment->post->id, $comment->post->slug]) }}" class="">{{ Str::limit($comment->comment, 20, '...') }}</a></td>
                      <td class="text-center">
                        @include('admin.comments.single-column-comment')
                      </td>
                      <td class="text-center">
                        <div class="tombolcomment">
                          <a href="{{ route('comment.view', $comment->id) }}" class="btn btn-secondary btn-sm">
                            <i class="far fa-eye"></i>
                          </a>
                        </div>
                        <div class="tombolcomment">
                          <form method="POST" action="{{ route('comment.destroy', $comment->id) }}"  >
                              @method('delete')
                              @csrf
                              @if (auth()->user()->userHasRole('Admin'))
                                  <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                              @elseif (auth()->user()->userHasRole('Manager'))
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
    
      @else
      <h1 class="h3 mb-4 text-gray-800">No Comments</h1>


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

      