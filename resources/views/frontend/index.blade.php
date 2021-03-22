@extends('frontend.layout.main')

@section('content')

<div id="image-slider" class="splide">
	<div class="splide__track">
		<ul class="splide__list">
            @foreach($sliders AS $slider)
                <li class="splide__slide">
                    <img src="{{ $slider->link }}">
                    <div class="slider_text">
                    <h1 class="slider_heading">{{ $slider->title }}</h1>
                    <div class="slider_desctiption">
                        {{ $slider->description }}
                    </div>
                    </div>
                </li>
            @endforeach
		</ul>
    </div>
</div>

<div class="wrapper row3">
    <main class="hoc container clear"> 
      <article class="group">
        <div class="one_half first">
          <h6 class="heading underline font-x2">Pope Francis says...</h6>
          <p> “Work is precisely from the human being. It expresses his dignity of being created in the image of God. Therefore it is said that work is sacred,” </p>
            
          <p> Because of this, he added, managing employment “is a great human and social responsibility which can't be left in the hands of the few, or discharged to a divinized market.” </p>
            
            <p>The Pope spoke to pilgrims present in the Vatican's Paul VI Hall for his Wednesday general audience. His comments are part of his continued series of catechesis on the family&hellip;</p>
        </div>
        <div class="one_half"><a class="imgover" href="javascript:void(0);"><img class="borderedbox inspace-10" src="{{ asset('template/images/pope.jpeg') }}" alt=""></a></div>
      </article>
      <div class="clear"></div>
    </main>
</div>

<div class="wrapper bgded overlay dark" style="background-image:url('{{ asset('template/images/vision.jpg') }}');">
    <div id="shout" class="hoc container clear"> 
        <article>
        <h3 class="heading font-x2">Vision</h3>
        <p>To Provide an efficient and viable service to the Multi-religious and multi-ethnic Population in Sri Lanka, to build a Community in the Spirit of Christ through the print and publication media. </p>
        </article>
        <br>
        <article>
        <h3 class="heading font-x2">Mission</h3>
        <p>By updating and improving the equipments and Machinery to provide proper facilities to work and For training Prepress and Printing technicians and Other personnel to assist the Sri Lankan community To experience the Spirit of Christ in the Printing And Publishing media.</p>
        </article>
    </div>
</div>

<div class="wrapper row2">
    <section class="hoc container clear"> 
      <div class="center btmspace-80">
        <h6 class="heading underline font-x2">Recent Articles</h6>
      </div>
      <ul class="nospace group latest">

        @foreach($articles AS $key => $article)
            <li class="one_third @if($key==0) first @endif">
                <article>
                <time><i class="far fa-calendar-alt rgtspace-5"></i> {{ $article->date }} </time>
                <div class="excerpt">

                    <a href="{{ route('single', ['id' => $article->id] ) }}">

                    <img src="{{ $article->link }}" alt="">

                    {{-- <img src="{{ asset('template/images/vision.jpg') }}" alt="">  --}}
                    
                    <br> <br>

                    <h6 class="heading">{{ $article->title }}</h6>

                    </a>

                    {{-- <p>{{ $article->title }}  [<a href="#">&hellip;</a>]</p> --}}
                    <ul class="meta">
                    <li><i class="fas fa-user rgtspace-5"></i> <a href="javascript:void(0)">{{ $article->user }}</a></li>
                    </ul>
                </div>
                </article>
            </li>
        @endforeach

      </ul>
      <footer class="view_more"><a class="btn" href="javascript:void(0);">View More</a></footer>

    </section>
</div>

<div class="wrapper bgded overlay light" style="background-image:url('{{ asset('template/images/bookshop.jpg') }}');">
    <section id="cta" class="hoc container clear"> 
      <h6 class="three_quarter first">Colombo Catholic Press Bookshop</h6>
      <footer class="one_quarter"><a class="btn" href="http://www.colomboarchdiocesancatholicpress.com/book-shop.php">Click here to visit</a></footer>
    </section>
</div>

<div class="wrapper row3">
    <section id="team" class="hoc container clear"> 
      <div class="center btmspace-80">
        <h6 class="heading underline font-x2">Recent Videos</h6>
      </div>
      <ul class="nospace group">

        @foreach($videos AS $key => $video)

        <li class="one_half @if($key==0) first @endif">
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
            {{-- <figcaption class="heading"><a href="{{ route('single_video', ['id' => $video->id] ) }}">  {{ $video->title }} </a></figcaption> --}}
            </figure>
            {{-- <p>Nulla etiam eget lacus sit amet eros tempus elementum vivamus ligula mauris blandit eu [<a href="#">&hellip;</a>]</p> --}}

            </article>
        </li>

        @endforeach

        
    </ul>

    <footer class="view_more"><a class="btn" href="javascript:void(0);">View More</a></footer>
      
    </section>
</div>

    <!-- product_list part end-->

    <!-- subscribe_area part start-->
    {{-- <section class="subscribe_area section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="subscribe_area_text text-center">
                        <h5>Join Our Newsletter</h5>
                        <h2>Subscribe to get Updated
                            with new offers</h2>
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="enter email address"
                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <a href="#" class="input-group-text btn_2" id="subscribe_button">subscribe now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!--::subscribe_area part end::-->
    {{-- <script>
        $(function() {
            alert(çlicked);
            $('#subscribe_button').click(function() {
                alert(çlicked);
            });

        });
    
        $(function() {
                    
            var token = "{{ Session::token() }}";

            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

            var form_data = new FormData();
            form_data.append('email', $("#email").val());
            // form_data.append('article_option', $("#article_option").val());
            // form_data.append('content', content);
            // form_data.append('file', $('#file').prop('files')[0]);
            form_data.append('_token', token);
                    
            $.ajax({
                url: "{{ route('subscribe.store') }}",
                type: "post",
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {

                    if(data=="Success"){
                        location.reload(true);
                    }
                    else{
                        $.alert({
                            type: 'red',
                            title: 'Error!',
                            content: "An error occured!",
                        });
                    }
                },
                error: function (data) {
                    console.log(data.responseText);
                    window.scrollTo(0, 0);
                    $('#message').html('<div class="alert alert-danger">Request Failed!</div>');
                }
            });   
    
        }); 
    </script> --}}
@endsection