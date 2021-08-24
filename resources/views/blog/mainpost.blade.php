<!-- start post item --> 
<div class="col-12 blog-post-content margin-60px-bottom sm-margin-30px-bottom text-center text-md-left">
    <div class="swiper-full-screen swiper-container white-move">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><a href="#"><img src="{{ url('storage/images/post/'. $post->post_image) }}" alt=""></a></div>
            <div class="swiper-slide"><a href="#"><img src="{{ url('storage/images/figure/'. $post->figure) }}" alt=""></a></div>
        </div>  
        <div class="swiper-pagination swiper-pagination-square swiper-pagination-white swiper-full-screen-pagination"></div>
        <div class="swiper-button-next swiper-button-black-highlight"></div>
        <div class="swiper-button-prev swiper-button-black-highlight"></div>
    </div> 
    <div class="blog-text border-all d-inline-block width-100">
        <div class="content padding-50px-all sm-padding-20px-all">
            <div class="text-medium-gray text-extra-small margin-5px-bottom text-uppercase alt-font">
                <span>Posted on {{ $post->created_at->diffForHumans() }}</span>
                    &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                <span><a href="{{ route('blog.category', $post->category->slug) }}" class="text-medium-gray ">{{ $post->category->category }}</a></span>
            </div>
            <a href="{{ route('blog.post', [$post->id, $post->slug]) }}" class="text-extra-dark-gray text-uppercase alt-font text-large font-weight-600 margin-15px-bottom d-block">{{ $post->title }}</a>
            <p class="m-0">{!! Str::limit($post->body, 300, '...') !!}</p>
        </div>
        <div class="row m-0 author border-top border-color-extra-light-gray text-center">
            <div class="col-12 col-md-4 d-flex flex-column justify-content-center name padding-15px-all">
                <div>
                    <img src="{{ url('storage/images/author/'. $post->author->post_author) }}" alt="" class="rounded-circle width-30px">
                    <span class="text-medium-gray text-uppercase text-extra-small alt-font padding-10px-left">by <a href="{{ route('blog.about-author', $post->author->slug) }}" class="text-medium-gray">{{ $post->author->author }}</a></span>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex flex-column justify-content-center name border-lr padding-15px-all border-color-extra-light-gray sm-no-border">
                <div>
                    <a href="#" class="text-extra-small alt-font text-medium-gray text-uppercase"><i class="far fa-heart margin-5px-right text-small"></i>5 like(s)</a>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex flex-column justify-content-center name padding-15px-all">
                <div>
                    <a href="#" class="text-extra-small alt-font text-medium-gray text-uppercase"><i class="far fa-comment margin-5px-right text-small"></i>{{ $totalcomments }} Comment(s)</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end post item --> 



