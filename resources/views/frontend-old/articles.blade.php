@extends('frontend.layout.main')

@section('content')

<!--================Home Banner Area =================-->

    <!--================Blog Area =================-->

    <style>
        .links a{
            color: black !important;
        }
    </style>
    
    <section class="blog_area padding_top">
        <div class="container">
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
            @endforeach

            <nav>
                <ul class="pagination justify-content-center pagination-lg">
                    {{$articles->links()}}
                </ul>
            </nav>
            
        </div>
    </section>
                

@endsection