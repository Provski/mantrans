<!doctype html>
<html class="no-js" lang="en">

    <!-- start head -->
    @include('partials.head')
    <!-- end head -->
    
    <body>
        <!-- start header -->
        @include('partials.header')
        <!-- end header -->


    <body>
        
        @if (Session::has('message-created'))
            <div id="flash" data-flash="{{ Session::get('message-created') }}"></div>
        @elseif (Session::has('message-updated'))
            <div id="flash" data-flash="{{ Session::get('message-updated') }}"></div>
        @endif
        
        @foreach ($posts as $post)
        <!-- start page title section -->
        <section class="wow fadeIn bg-light-gray padding-35px-tb page-title-small top-space">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-md-6 d-flex flex-column justify-content-center text-center text-md-left">
                        <!-- start page title -->
                        <h1 class="alt-font text-extra-dark-gray font-weight-600 no-margin-bottom text-uppercase">{{ $post->title }}</h1>
                        <!-- end page title -->
                    </div>
                    <div class="col-xl-6 col-md-6 alt-font breadcrumb justify-content-center justify-content-md-end text-small sm-margin-10px-top">
                        <!-- breadcrumb -->
                        <ul class="text-center text-md-left text-uppercase">
                            <li><a href="#" class="text-dark-gray">{{ $post->created_at->diffForHumans() }}</a></li>
                            <li><span class="text-dark-gray">by <a href="{{ route('blog.about-author', $post->author->slug) }}">{{ $post->author->author }}</a></span></li>
                            <li class="text-dark-gray"><a href="{{ route('blog.category', $post->category->slug) }}">{{ $post->category->category }}</a></li>
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                </div>
            </div>
        </section>
        <!-- end page title section -->

        <!-- start post content section --> 
        <section>
            <div class="container">
                <div class="row">
                    <main class="col-12 col-lg-9 right-sidebar md-margin-60px-bottom sm-margin-40px-bottom pl-0 md-no-padding-right">
                        <div class="col-12 blog-details-text last-paragraph-no-margin">
                            <img src="{{ url('storage/images/post/'. $post->post_image) }}" alt="" class="width-100 margin-45px-bottom pinterest-img">
                            {{-- <p>{{ $post->body }}</p> --}}
                            <blockquote class="border-color-deep-pink">
                                <p>{{ $post->quote->content }}</p>
                                <footer>{{ $post->quote->name }}</footer>
                            </blockquote>
                            <figure class="wp-caption alignleft"><img alt="" src="{{ url('storage/images/figure/'. $post->figure) }}">
                                <figcaption class="wp-caption-text">{{ $post->figure_caption }}</figcaption>
                            </figure>
                            <p>{!!Str::ucfirst($post->body)!!}</p>
                        </div>
                        
                        <div class="row mx-0">
                            <div class="col-12 col-lg-12 text-center text-lg-right">
                                <div class="social-icon-style-6">
                                    <ul class="extra-small-icon">
                                        <li><a class="likes-count" href="{{ route('like.index', $post->id) }}"><i class="fas fa-heart text-deep-pink"></i><span class="text-small">{{ $like }}</span></a></li>
                                        <li><a class="facebook" href="http://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a class="twitter" href="http://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                        <li><a class="whatsapp" href="http://whatsapp.com" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                                        <li><a class="pinterest" href="http://pinterest.com" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>
                                        <li><a class="linkedin" href="http://linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 margin-eight-top" id="comments">
                            <div class="divider-full bg-medium-light-gray"></div>
                        </div>
                        <div class="col-12 d-flex flex-wrap p-0">
                            <div class="col-12 mx-auto text-center margin-80px-tb md-margin-50px-tb sm-margin-30px-tb">
                                <div class="position-relative overflow-hidden width-100">
                                    <span class="text-small text-outside-line-full alt-font font-weight-600 text-uppercase text-extra-dark-gray"><a href="#comments" class="" id="btn-parent-comment">Write Your Own Comments Here</a></span>
                                </div>
                            </div>
                            <div class="container" style="display: none;" id="blank-comment">
                                <form class="form-inline" method="POST" action="{{ route('comment.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <input type="hidden" name="parent_id" value="0">
                                    <div class="col-12 form-group">
                                        <textarea name="comment" id="comment" placeholder="Enter your comment here with max 1000 character.." rows="4" class="medium-textarea-lg @error('comment') is-invalid @enderror" value="{{ old('comment') }}"></textarea>
                                        @error('comment')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 text-center">
                                        <button class="btn btn-dark-gray btn-small margin-15px-top" type="submit">Submit Comment</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 blog-details-comments">
                            <div class="width-100 mx-auto text-center margin-80px-tb md-margin-50px-tb sm-margin-30px-tb">
                                <div class="position-relative overflow-hidden width-100">
                                    <span class="text-small text-outside-line-full alt-font font-weight-600 text-uppercase text-extra-dark-gray"><a href="#viewcomments" class="" id="btn-list-comment">View Comments</a></span>
                                </div>
                            </div>
                            <ul class="blog-comment" style="display: none;" id="list-comments">
                                <li>
                                    @foreach ($post->comments as $comment)
                                    <li>
                                        <div class="d-block d-md-flex  width-100">
                                            <div class="width-110px sm-width-50px text-center sm-margin-10px-bottom">
                                                <img src="{{ $comment->user->avatar ? url('storage/images/avatar/'. $comment->user->avatar) : url('storage/images/avatar/avatar.jpg') }}" class="rounded-circle width-85 sm-width-100" alt=""/>
                                            </div>
                                            <div class="width-100 padding-40px-left last-paragraph-no-margin sm-no-padding-left">
                                                <a href="#" class="text-extra-dark-gray text-uppercase alt-font font-weight-600 text-small">{{ $comment->user->name }}</a>
                                                <a href="#childcomment" class="inner-link btn-reply text-uppercase alt-font text-extra-dark-gray">Reply</a>
                                                <div class="text-small text-medium-gray text-uppercase margin-10px-bottom">{{ $comment->created_at->format('D, d F Y') }} - {{ $comment->created_at->diffForHumans() }}</div>
                                                <p>{{ $comment->comment }}</p>
                                            </div>
                                        </div>
                                        <div class="container" style="margin-top: 20px;" id="childcomment">
                                            <form class="form-inline" method="POST" action="{{ route('commentreply.store') }}" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                {{-- <input type="hidden" name="parent_id" value="{{ $comment->id }}"> --}}
                                                <div class="col-12 form-group">
                                                    <textarea style="margin-left: 12%;" name="reply" id="reply" placeholder="Enter your replies here with max 500 character.." rows="2" class="medium-textarea-lg @error('reply') is-invalid @enderror" value="{{ old('reply') }}"></textarea>
                                                    @error('reply')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 text-center">
                                                    <button class="btn btn-dark-gray btn-small margin-15px-top" type="submit">Reply Comment</button>
                                                </div>
                                            </form>
                                        </div>
                                        @foreach ($comment->replies as $reply)
                                        @if ($reply->is_active == 1)
                                        <ul class="child-comment">
                                            <li>
                                                <div class="d-block d-md-flex  width-100">
                                                    <div class="width-110px sm-width-50px text-center sm-margin-10px-bottom">
                                                        <img src="{{ $reply->user->avatar ? url('storage/images/avatar/'. $reply->user->avatar) : url('storage/images/avatar/avatar.jpg') }}" class="rounded-circle width-85 sm-width-100" alt="" />
                                                    </div>
                                                    <div class="width-100 padding-40px-left last-paragraph-no-margin sm-no-padding-left">
                                                        <a href="#" class="text-extra-dark-gray text-uppercase alt-font font-weight-600 text-small">{{ $reply->user->name }}</a>
                                                        <div class="text-small text-medium-gray text-uppercase margin-10px-bottom">{{ $reply->created_at->format('D, d F Y') }} - {{ $reply->created_at->diffForHumans() }}</div>
                                                        <p>{{ $reply->reply }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        @endif
                                        @endforeach
                                    </li>
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 margin-eight-top" id="comments">
                            <div class="divider-full bg-medium-light-gray"></div>
                        </div>
                    </main>
                    <aside class="col-12 col-lg-3 float-right">
                        <div class="margin-45px-bottom sm-margin-25px-bottom">
                            <div class="text-extra-dark-gray margin-20px-bottom alt-font text-uppercase text-small font-weight-600 aside-title"><span>About Me</span></div>
                            <a href="{{ route('blog.about-author', $post->author->slug) }}"><img src="{{ url('storage/images/author/'. $post->author->post_author) }}" alt="" class="margin-25px-bottom"/></a>
                            <p class="margin-20px-bottom text-small">{{ Str::limit($post->author->about_author, 200,' ...') }}</p>
                            <a class="btn btn-very-small btn-dark-gray text-uppercase" href="{{ route('blog.about-author', $post->author->slug) }}">About Author</a>
                        </div>
                    </aside>
                </div>
            </div>
        </section>
        @endforeach

        <!-- end blog content section -->
          
        <!-- end team section -->

        <!-- start footer --> 
        @include('partials.footer')
        <!-- end footer -->

        <!-- start scroll to top -->
        @include('partials.arrowscrollup')
        <!-- end scroll to top  -->
        
        <!-- start js script -->
        @include('partials.scripts')
        <!-- end js script -->
        
        
        <script>
            $(document).ready(function(){
                $('#btn-parent-comment').click(function(){
                    $('#blank-comment').toggle('slide');
                });
            });
        </script>   

        <script>
            $(document).ready(function(){
                $('#btn-list-comment').click(function(){
                    $('#list-comments').toggle('slide');
                });
            });
        </script>

        <script src="{{ asset('assets/js/sharepost-socialmedia.js') }}"></script>

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

    </body>
</html>