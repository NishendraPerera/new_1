@extends('frontend.layout.main')

@section('content')

<div class="wrapper row3">
   <main class="hoc container clear" style="padding: 40px 0;"> 
     <!-- main body -->
     <!-- ################################################################################################ -->
     <div class="content three_quarter first"> 

      <img src="{{ $article->link }}" alt="">
 
       <h1 style="font-size: 40px; font-weight:bold;">{{ $article->title }}</h1>
       <address> <i class="fas fa-user"></i> {{ $article->user }} </address>
         <i class="fas fa-clock"> </i> {{ date( 'l, d F Y, g:i a' , strtotime($article->created_at)) }}
 
         <br>
         <br>
      
         {!! $article->content !!}
 
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