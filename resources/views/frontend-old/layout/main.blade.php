<!doctype html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Catholic_News_Online</title>
    <link rel="icon" href="{{ asset('frontend/img/favicon.png') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/all.css') }}">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/themify-icons.css') }}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

    <link href="https://vjs.zencdn.net/7.6.6/video-js.css" rel="stylesheet" />
</head>

<body>
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="{{ url('/') }}"> <h3><b>CatholicNews</b>Online</h3> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="menu_icon"><i class="fas fa-bars"></i></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                                </li>
                                {{-- <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_1"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Shop
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                                        <a class="dropdown-item" href="category.html"> shop category</a>
                                        <a class="dropdown-item" href="single-product.html">product details</a>
                                        
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_3"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        pages
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown_2">
                                        <a class="dropdown-item" href="login.html"> login</a>
                                        <a class="dropdown-item" href="tracking.html">tracking</a>
                                        <a class="dropdown-item" href="checkout.html">product checkout</a>
                                        <a class="dropdown-item" href="cart.html">shopping cart</a>
                                        <a class="dropdown-item" href="confirmation.html">confirmation</a>
                                        <a class="dropdown-item" href="elements.html">elements</a>
                                    </div>
                                </li> --}}
                                {{-- <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_2"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        blog
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown_2">
                                        <a class="dropdown-item" href="{{ route('articles') }}"> blog</a>
                                        <a class="dropdown-item" href="{{ route('articles') }}">Single blog</a>
                                    </div>
                                </li> --}}

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('articles') }}">Articles</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('videos') }}">Videos</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('about us')}}">About us</a>
                                </li>
                                
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                                </li>
                            </ul>
                        </div>
                        <div class="hearer_icon d-flex">
                            {{-- <a id="search_1" href="javascript:void(0)"><i class="ti-search"></i></a> --}}
                            <a href="{{ route('home') }}"><i class="ti-user"></i></a>
                            {{-- <div class="dropdown cart">
                                <a class="dropdown-toggle" href="#" id="navbarDropdown3" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cart-plus"></i>
                                </a>
                                <!-- <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <div class="single_product">
    
                                    </div>
                                </div> -->
                                
                            </div> --}}
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="search_input" id="search_input_box">
            <div class="container ">
                <form class="d-flex justify-content-between search-inner">
                    <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                    <button type="submit" class="btn"></button>
                    <span class="ti-close" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>
    </header>
    <!-- Header part end-->

    @yield('content')

    

    <!--::footer_part start::-->
    <footer class="footer_part">
        <div class="copyright_part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="copyright_text">
                            <P><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Developed by Nishendra Perera
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></P>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer_icon social_icon">
                            <ul class="list-unstyled">
                                <li><a href="https://www.facebook.com/archdiocesecmbnews/?epa=SEARCH_BOX" class="single_social_icon"><i class="fab fa-facebook-f"></i></a></li>
                                {{-- <li><a href="#" class="single_social_icon"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#" class="single_social_icon"><i class="fas fa-globe"></i></a></li>
                                <li><a href="#" class="single_social_icon"><i class="fab fa-behance"></i></a></li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--::footer_part end::-->

    <!-- jquery plugins here-->
    {{-- <script src="{{ asset('frontend/js/jquery-1.12.1.min.js') }}"></script> --}}
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <!-- popper js -->
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <!-- easing js -->
    <script src="{{ asset('frontend/js/jquery.magnific-popup.js') }}"></script>
    <!-- swiper js -->
    <script src="{{ asset('frontend/js/swiper.min.js') }}"></script>
    <!-- swiper js -->
    <script src="{{ asset('frontend/js/masonry.pkgd.js') }}"></script>
    <!-- particles js -->
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <!-- slick js -->
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/contact.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.form.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('frontend/js/mail-script.js') }}"></script>
    <!-- video.js -->
    <script src="https://vjs.zencdn.net/7.6.6/video.js"></script>
    <!-- custom js -->
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
</body>

</html>