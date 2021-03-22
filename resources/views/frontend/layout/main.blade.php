<!DOCTYPE html>
<!--
Template Name: Shicso
Author: <a href="https://www.os-templates.com/">OS Templates</a>
Author URI: https://www.os-templates.com/
Copyright: OS-Templates.com
Licence: Free to use under our free template licence terms
Licence URI: https://www.os-templates.com/template-terms
-->
<html lang="">
<!-- To declare your language - read more here: https://www.w3.org/International/questions/qa-html-language-declarations -->
<head>
<title>Catholic Press</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="{{ asset('template/layout/styles/layout.css') }}" rel="stylesheet" type="text/css" media="all">
<link href="{{ asset('template/layout/styles/custom.css') }}" rel="stylesheet" type="text/css" media="all">
<link rel="icon" href=" {{ asset('template/images/favicon.png') }}" sizes="16x16" type="image/png">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
<link href="https://vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet" />

<style>
  .splide__pagination__page {
    background: #306F9F;
  }

  .splide__pagination__page.is-active {
    background: #004B84;
  }
</style>

</head>

<body id="top">
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <!-- <div class="wrapper row0">
      <header id="header" class="hoc clear"> 
        <div id="logo" class="one_third first">
          <h1 class="logoname clear"><a href="index.html"><span><b style="color: #20639B;">Catholic</b> Press</span></a></h1>
        </div>
      </header>
    </div> -->
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <div class="wrapper row1">
    
      <div class="hoc clear">
        <!-- ################################################################################################ -->
        <nav id="mainav" class="group" style="font-size: 17px !important; font-weight: bold !important; ">
          <div class="one_third first" style="margin-top: 10px;">
            <h1 class="logoname clear" ><a href="index.html"><!-- <i class="fas fa-handshake"></i> --> <span><b style="color: #20639B;">Catholic</b> <b style="color: #474747;">Press</b></span></a></h1>
          </div>
          <div class="two_third">
            <ul class="clear" style="text-align: right !important;">
            
              <li class="active"><a href="{{ route('index') }}">Home</a></li>
              <li><a href="{{ route('articles') }}">Articles</a></li>
              <li><a href="{{ route('videos') }}">Videos</a></li>
              <li><a href="{{ route('about us') }}">About Us</a></li>
              <li><a href="{{ route('contact') }}">Contact Us</a></li>
              <li><a href="{{ route('home') }}"><i class="fas fa-user"></i></a></li>
            </ul>
          </div>      
        </nav>
        <!-- ################################################################################################ -->
      </div>
    </div>

    @yield('content')

    <div class="wrapper row4">
        <footer id="footer" class="hoc clear"> 
          <!-- ################################################################################################ -->
          <div class="one_third first">
            <h1 class="logoname clear"><a href="index.html"><!-- <i class="fas fa-handshake"></i> --> <span>Catholic Press</span></a></h1>
            <p class="btmspace-30">Our vision is to provide an efficient and viable service to the Multi-religious and multi-ethnic Population in Sri Lanka, to build a Community in the Spirit of Christ through the print and publication media. </p>
            <!-- <ul class="faico clear">
              <li><a class="faicon-facebook" href="#"><i class="fab fa-facebook"></i></a></li>vi
              <li><a class="faicon-google-plus" href="#"><i class="fab fa-google-plus-g"></i></a></li>
              <li><a class="faicon-linkedin" href="#"><i class="fab fa-linkedin"></i></a></li>
              <li><a class="faicon-twitter" href="#"><i class="fab fa-twitter"></i></a></li>
              <li><a class="faicon-vk" href="#"><i class="fab fa-vk"></i></a></li>
            </ul> -->
          </div>
          <div class="one_third">
            <h6 class="heading">Felis lobortis pulvinar</h6>
            <ul class="nospace linklist contact">
              <li><i class="fas fa-map-marker-alt"></i>
                <address>
                Street Name &amp; Number, Town, Postcode/Zip
                </address>
              </li>
              <li><i class="fas fa-phone"></i> +00 (123) 456 7890</li>
              <li><i class="fas fa-fax"></i> +00 (123) 456 7890</li>
              <li><i class="far fa-envelope"></i> info@domain.com</li>
            </ul>
          </div>
          <!-- <div class="one_quarter">
            <h6 class="heading">Recent Videos</h6>
            <ul class="nospace linklist">
              <li><a href="#">Maecenas sem fusce quis</a></li>
              <li><a href="#">Vel leo semper rhoncus ut</a></li>
              <li><a href="#">Suscipit pede eu diam class</a></li>
              <li><a href="#">Aptent taciti sociosqu ad</a></li>
            </ul>
          </div> -->
          <div class="one_third">
            <h6 class="heading">Recent Articles</h6>
            <ul class="nospace linklist">
              <li>
                <article>
                  <p class="nospace btmspace-10"><a href="#">Nostra per inceptos himenaeos cras augue est dictum quis&hellip;</a></p>
                  <time class="block font-xs" datetime="2045-04-06">Friday, 6<sup>th</sup> April 2045</time>
                </article>
              </li>
              <li>
                <article>
                  <p class="nospace btmspace-10"><a href="#">Suscipit vel est in pulvinar aliquam vulputate purus in tincidunt&hellip;</a></p>
                  <time class="block font-xs" datetime="2045-04-05">Thursday, 5<sup>th</sup> April 2045</time>
                </article>
              </li>
            </ul>
          </div>
          <!-- ################################################################################################ -->
        </footer>
      </div>
      <!-- ################################################################################################ -->
      <!-- ################################################################################################ -->
      <!-- ################################################################################################ -->
      <div class="wrapper row5">
        <div id="copyright" class="hoc clear"> 
          <!-- ################################################################################################ -->
          <p class="fl_left">Copyright &copy; <script>document.write(new Date().getFullYear());</script> - All Rights Reserved <!-- <a href="#">Domain Name</a> --> </p>
          <p class="fl_right">Project By Nishendra Perera</p>
          <!-- ################################################################################################ -->
        </div>
      </div>
      <!-- ################################################################################################ -->
      <!-- ################################################################################################ -->
      <!-- ################################################################################################ -->
      <a id="backtotop" href="#top"><i class="fas fa-chevron-up"></i></a>
      <!-- JAVASCRIPTS -->
      <script src="{{ asset('template/layout/scripts/jquery.min.js') }}"></script>
      <script src="{{ asset('template/layout/scripts/jquery.backtotop.js') }}"></script>
      <script src="{{ asset('template/layout/scripts/jquery.mobilemenu.js') }}"></script>
      
      <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
      <script src="https://vjs.zencdn.net/7.10.2/video.min.js"></script>
      
      <script>
          document.addEventListener( 'DOMContentLoaded', function () {
              new Splide( '.splide', {
              'cover'      : true,
              'heightRatio': 0.4,
          autoplay: true,
          interval: 3000,
          rewind: true
          } ).mount();
          } );
      </script>
      
      </body>
      </html>