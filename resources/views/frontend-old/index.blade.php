@extends('frontend.layout.main')

@section('content')

{{-- <style>

video {
  width: 100%    !important;
  height: 100%    !important;
}

</style> --}}

<!-- banner part start-->
<section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="banner_slider owl-carousel">

                        @foreach($sliders AS $slider)
                            <div class="single_banner_slider">
                                <div class="row">
                                    <div class="col-lg-5 col-md-8">
                                        <div class="banner_text">
                                            <div class="banner_text_iner">
                                                <h1>{{ $slider->title }}</h1>
                                                <p>{{ $slider->description }}</p>
                                                {{-- <a href="#" class="btn_2">buy now</a> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="banner_img d-none d-lg-block">
                                        <img src="{{ $slider->link }}" alt="">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                    </div>
                    {{-- <div class="slider-counter"></div> --}}
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->

    <!-- product_list part start-->
    <section class="product_list best_seller section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_tittle text-center">
                        <h2>Recent News</h2>
                    </div>
                </div>
            </div>
            
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-12">  

                    @for($i=1; $i<count($articles); $i*2)

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="single_product_item">
                                    <a href="{{ route('single', ['id' => $articles[$i-1]['id']]) }}">
                                        <img src="{{ $articles[$i-1]['link'] }}" alt="">
                                    </a>
                                    <div class="single_product_text">
                                        <h4> {{$articles[$i-1]['title']}} </h4>
                                        <h3>{{$articles[$i-1]['date']}}</h3>
                                    </div>
                                </div>
                            </div>

                            @php $i++; @endphp

                            @if($i<=count($articles))
                                <div class="col-lg-6">
                                    <div class="single_product_item">
                                        <a href="{{ route('single', ['id' => $articles[$i-1]['id']]) }}">
                                            <img src="{{ $articles[$i-1]['link'] }}" alt="">
                                        </a>
                                        <div class="single_product_text">
                                            <h4>{{$articles[$i-1]['title']}}</h4>
                                            <h3>{{$articles[$i-1]['date']}}</h3>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @php $i++; @endphp

                        </div>

                    @endfor
                </div>
            </div>
            <div class="row justify-content-center" style="margin-top:40px;">
                <div class="col-lg-12">
                    <div class="section_tittle text-center">
                        <h2>Recent Videos</h2>
                    </div>
                </div>
            </div>
            {{-- <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_title text-center">
                        <h2>Recent Videos</h2>
                    </div>
                </div>
            </div> --}}
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-12">

                    @for($i=1; $i<=count($videos); $i*2)
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="single_product_item">
                                    <video
                                        id="my-video"
                                        class="video-js vjs-big-play-centered vjs-16-9"
                                        controls
                                        preload="none"
                                        poster="{{ $videos[$i-1]['thumbnail_link'] }}"
                                        style=" width: 100%; "
                                        data-setup="{}">
                                        <source src="{{ $videos[$i-1]['link'] }}" type="video/mp4" />                                            
                                    </video>
                                    <div class="single_product_text">
                                        <h4>{{ $videos[$i-1]['title'] }}</h4>
                                        {{-- <h3>{{$articles[$i-1]['date']}}</h3> --}}
                                    </div>
                                </div>
                            </div>

                            <?php $i++; ?>

                            @if($i<=count($videos))
                                <div class="col-lg-6">
                                    <div class="single_product_item">
                                        <video
                                            id="my-video"
                                            class="video-js vjs-big-play-centered vjs-16-9"
                                            controls
                                            preload="none"
                                            poster="{{ $videos[$i-1]['thumbnail_link'] }}"
                                            style=" width: 100%; "
                                            data-setup="{}">
                                            <source src="{{ $videos[$i-1]['link'] }}" type="video/mp4" />                                            
                                        </video>
                                        <div class="single_product_text">
                                            <h4>{{ $videos[$i-1]['title'] }}</h4>
                                            {{-- <h3>{{$articles[$i-1]['date']}}</h3> --}}
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <?php $i++; ?>
                        </div>

                    @endfor

                </div>
            </div>
        </div>
    </section>
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