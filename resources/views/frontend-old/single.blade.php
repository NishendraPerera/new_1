@extends('frontend.layout.main')

@section('content')

    <!--================Home Banner Area =================-->

     <!--================Blog Area =================-->
     <section class="blog_area single-post-area padding_top">
        <div class="container">
           <div class="row">
              <div class="col-lg-8 posts-list">
                 <div class="single-post">
                    <div class="feature-img">
                       <img class="img-fluid" src="{{ $article->link }}" alt="">
                    </div>
                    <div class="blog_details">
                       <h2>{{ $article->title }}</h2>
                       <ul class="blog-info-link mt-3 mb-4">
                          <li>{{ $article->category }}</li>
                           <li><a href="#"><i class="far fa-user"></i> {{ $article->user }}</a></li>
                       </ul>

                       {!! $article->content !!}
                        
                    </div>
                 </div>
                
              </div>
              <div class="col-lg-4">
                 <div class="blog_right_sidebar">

                    <aside class="single_sidebar_widget popular_post_widget">
                       <h3 class="widget_title">Recent Articles</h3>

                        @foreach($articles AS $data)
                           <div class="media post_item">
                              {{-- <img src="{{ $data->link }}" alt="post"> --}}
                              <div class="media-body">
                                 <a href="{{ route('single', ['id' => $data->id]) }}">
                                    <h3>{{ $data->title }}</h3>
                                 </a>
                                 <p>{{ $data->date }} </p>
                              </div>
                           </div>
                        @endforeach

                    </aside>
                    
                    {{-- <aside class="single_sidebar_widget newsletter_widget">
                       <h4 class="widget_title">Newsletter</h4>
                       <form action="#">
                          <div class="form-group">
                             <input type="email" class="form-control" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Enter email'" placeholder='Enter email' required>
                          </div>
                          <button class="button rounded-0 primary-bg text-white w-100 btn_1"
                             type="submit">Subscribe</button>
                       </form>
                    </aside> --}}
                 </div>
              </div>
           </div>
        </div>
     </section>
     <!--================Blog Area end =================-->

@endsection