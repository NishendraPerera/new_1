@extends('frontend.layout.main')

@section('content')

<div class="wrapper row3">
  <main class="hoc container clear" style="padding: 40px 0;">
    <!-- main body -->
    <!-- ################################################################################################ -->
    <div class="content three_quarter first" id="team">
      
      <ul class="nospace group">

        @foreach($videos AS $video)
        <li>
          {{-- <video
            id="my-video"
            class="video-js vjs-big-play-centered vjs-16-9"
            controls
            preload="none"
            style="width: 100%"
            poster="$video->thumbnail_link"
            data-setup="{}"
          >
            <source src="$video->link" type="video/mp4" />
  
          </video> --}}

          <video
            id="my-video"
            class="video-js vjs-big-play-centered vjs-16-9"
            controls
            preload="none"
            style="width: 100%"
            poster="{{ $video->thumbnail_link }} "
            data-setup="{}"
            >
            <source src="{{ $video->link }}" type="video/mp4" />
            </video>
            
          <article>
              <figcaption class="heading">Jane Doe</figcaption>
            </figure>
            <!-- <em>Job Type Here</em> -->
            <p>Nulla etiam eget lacus sit amet eros tempus elementum vivamus ligula mauris blandit eu [<a href="#">&hellip;</a>]</p>
            <!-- <footer>
              <ul class="faico clear">
                <li><a class="faicon-facebook" href="#"><i class="fab fa-facebook"></i></a></li>
                <li><a class="faicon-google-plus" href="#"><i class="fab fa-google-plus-g"></i></a></li>
                <li><a class="faicon-linkedin" href="#"><i class="fab fa-linkedin"></i></a></li>
                <li><a class="faicon-twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a class="faicon-vk" href="#"><i class="fab fa-vk"></i></a></li>
              </ul>
            </footer> -->
          </article>
        </li>

        @endforeach

      <nav class="pagination">
        <ul>
          <li><a href="#">&laquo; Previous</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><strong>&hellip;</strong></li>
          <li><a href="#">6</a></li>
          <li class="current"><strong>7</strong></li>
          <li><a href="#">8</a></li>
          <li><a href="#">9</a></li>
          <li><strong>&hellip;</strong></li>
          <li><a href="#">14</a></li>
          <li><a href="#">15</a></li>
          <li><a href="#">Next &raquo;</a></li>
        </ul>
      </nav>

    </div>

    <div class="sidebar one_quarter">
      <h6>Recent Articles</h6>

      <a href="javascript:void(0);"> <p>Nuncsed sed conseque a at quismodo tris mauristibus sed habiturpiscinia sed. </p> </a>

      <a href="javascript:void(0);"> <p>Nuncsed sed conseque a at quismodo tris mauristibus sed habiturpiscinia sed.</p> </a>

      <a href="javascript:void(0);"> <p>Nuncsed sed conseque a at quismodo tris mauristibus sed habiturpiscinia sed.</p> </a>
    </div>

  </main>
</div>

@endsection