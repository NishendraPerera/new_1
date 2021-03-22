@extends('frontend.layout.main')

@section('content')

<!--================Home Banner Area =================-->

    <!--================Blog Area =================-->

    <style>
        .links a{
            color: black !important;
        }
    </style>
    
    <!--================Blog Area =================-->
    <section class="blog_area padding_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">

                        @foreach($videos AS $video)
                            <article class="blog_item">
                                <div class="blog_item_img">
                                    {{-- <img class="card-img rounded-0" src="img/blog/single_blog_1.png" alt=""> --}}
                                    {{-- <a href="#" class="blog_item_date">
                                        <h3>15</h3>
                                        <p>Jan</p>
                                    </a> --}}
                                    <video
                                        id="my-video"
                                        class="video-js vjs-big-play-centered vjs-16-9"
                                        controls
                                        preload="none"
                                        poster="{{ $video->thumbnail_link }}"
                                        style=" width: 100%; "
                                        data-setup="{}">
                                        <source src="{{ $video->link }}" type="video/mp4" />
                                    </video>
                                </div>
    
                                <div class="blog_details">
                                    {{-- <a class="d-inline-block" href="single-blog.html"> --}}
                                        <h2>{{ $video->title }}</h2>
                                    {{-- </a> --}}
                                    <p>{{ $video->description }}</p>
                                    <ul class="blog-info-link">
                                        <li><a href="#"><i class="far fa-user"></i> {{ $video->user }}</a></li>
                                        <li><a href="#"> {{ $video->date }}</a></li>
                                    </ul>
                                </div>
                            </article>
                        @endforeach

                        <nav>
                            <ul class="pagination justify-content-center pagination-lg">
                                {{$videos->links()}}
                            </ul>
                        </nav>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">  

                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Recent Articles</h3>

                            @foreach($articles AS $article)
                                <div class="media post_item">
                                    {{-- <img src="{{ $article->link }}" alt="post"> --}}
                                    <div class="media-body">
                                        <a href="{{ route('single', ['id' => $article->id ]) }}">
                                            <h3>{{ $article->title }}</h3>
                                        </a>
                                        <p>{{ $article->date }}</p>
                                    </div>
                                </div>
                            @endforeach
                            
                        </aside>                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
                

@endsection