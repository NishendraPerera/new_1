@extends('frontend.layout.main')

@section('content')

<!--================Home Banner Area =================-->

    <!--================Blog Area =================-->

    {{-- <style>
        .links a{
            color: black !important;
        }
    </style> --}}

    <div class="wrapper row3">
        <main class="hoc container clear" style="padding: 40px 0;">
          <!-- main body -->
          <!-- ################################################################################################ -->
          <div class="content three_quarter first">
            <ul class="nospace group">

            @foreach($articles AS $article)
            <li>
                <div class="one_quarter first" style="margin: 10px 0;">
                    <a href="{{ route('single', ['id' => $article->id]) }}"><img src="{{ $article->link }}" alt="" style="width:100%;" /></a>
                </div>
                <div class="three_quarter">
                  <article>
                    <figcaption class="heading"><a href="{{ route('single', ['id' => $article->id]) }}">{{ $article->title }}</a></figcaption>
                  </figure>
                  <!-- <em>Job Type Here</em> -->
                  <p>{{ substr(strip_tags(html_entity_decode($article->content)),0, 200) }}[<a href="{{ route('single', ['id' => $article->id]) }}">&hellip;</a>] </p>

                </article>
                </div>
              </li>
            @endforeach
{{-- 
          
              <li>
                <div class="one_quarter first" style="margin: 10px 0;">
                  <img src="images/video/thumbnails/1.png" style="width:100%;"/>
                </div>
                <div class="three_quarter">
                  <article>
                    <figcaption class="heading">Jane Doe</figcaption>
                  </figure>
                  <!-- <em>Job Type Here</em> -->
                  <p>Nulla etiam eget lacus sit amet eros tempus elementum vivamus ligula mauris blandit eu [<a href="#">&hellip;</a>]</p>
                </article>
                </div>
              </li>
      
              <li>
                <div class="one_quarter first" style="margin: 10px 0;">
                  <img src="images/video/thumbnails/1.png" style="width:100%;"/>
                </div>
                <div class="three_quarter">
                  <article>
                    <figcaption class="heading">Jane Doe</figcaption>
                  </figure>
                  <!-- <em>Job Type Here</em> -->
                  <p>Nulla etiam eget lacus sit amet eros tempus elementum vivamus ligula mauris blandit eu [<a href="#">&hellip;</a>]</p>
                </article>
                </div>
              </li>
      
              <li>
                <div class="one_quarter first" style="margin: 10px 0;">
                  <img src="images/video/thumbnails/1.png" style="width:100%;"/>
                </div>
                <div class="three_quarter">
                  <article>
                    <figcaption class="heading">Jane Doe</figcaption>
                  </figure>
                  <!-- <em>Job Type Here</em> -->
                  <p>Nulla etiam eget lacus sit amet eros tempus elementum vivamus ligula mauris blandit eu [<a href="#">&hellip;</a>]</p>
                </article>
                </div>
              </li> --}}
              
            </ul>

            {{-- {{ json_encode($articles) }} --}}


      
            <nav class="pagination">
                {{-- {{$articles->links()}} --}}
              <ul>
                {{-- <li><a href="{{ $articles->prev_page_url }}">&laquo; Previous</a></li> --}}
                {{-- <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><strong>&hellip;</strong></li>
                <li><a href="#">6</a></li>
                <li class="current"><strong>7</strong></li>
                <li><a href="#">8</a></li>
                <li><a href="#">9</a></li>
                <li><strong>&hellip;</strong></li>
                <li><a href="#">14</a></li>
                <li><a href="#">15</a></li> --}}
                {{-- <li><a href="{{ $articles->next_page_url }}">Next &raquo;</a></li> --}}
              </ul>
            </nav>
      
          </div>

          <div class="sidebar one_quarter">
            <h6>Recent Videos</h6>
      
            <a href="javascript:void(0);"> <p>Nuncsed sed conseque a at quismodo tris mauristibus sed habiturpiscinia sed. </p> </a>
      
            <a href="javascript:void(0);"> <p>Nuncsed sed conseque a at quismodo tris mauristibus sed habiturpiscinia sed.</p> </a>
      
            <a href="javascript:void(0);"> <p>Nuncsed sed conseque a at quismodo tris mauristibus sed habiturpiscinia sed.</p> </a>
          </div>
      
        </main>
      </div>
    
    <section class="blog_area padding_top">
        {{-- <div class="container">
            <div class="row">
                <h2>Articles</h2>
            </div>

            @foreach($articles AS $article)
                <div class="whole-wrap">
                    <div class="container box_1170">
                        <div class="section-top-border">
                            <div class="row links">
                                <div class="col-md-3">
                                    <a href="{{ route('single', ['id' => $article->id]) }}"><img src="{{ $article->link }}" alt="" class="img-fluid"></a>
                                </div>
                                <div class="col-md-9 mt-sm-20">
                                <h3 class="mb-30"><a href="{{ route('single', ['id' => $article->id]) }}">{{ $article->title }}</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach --}}

            <nav>
                <ul class="pagination justify-content-center pagination-lg">
                    {{$articles->links()}}
                </ul>
            </nav>
            
        </div>
    </section>
                

@endsection