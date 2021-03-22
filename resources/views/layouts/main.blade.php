<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Catholic News Online - User Panel</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    {{-- Bootstrap CSS--}}
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    
    {{-- Font Awesome CSS--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- Fontastic Custom icon font--}}
    <link rel="stylesheet" href="{{ asset('css/fontastic.css') }}">
    {{-- Google fonts - Poppins --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    {{-- theme stylesheet--}}
    <link rel="stylesheet" href="{{ asset('css/style.default.css') }}" id="theme-stylesheet">
    {{-- Custom stylesheet - for your changes--}}
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    {{-- Favicon--}}
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">

      <link rel="stylesheet" href="{{ asset('dataTable/dataTables.bootstrapv4.css') }}">

      <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css">

      <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">

    @if(Route::currentRouteName()=="article.create"||Route::currentRouteName()=="article.edit")
      <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
      {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-bs4.min.css" rel="stylesheet"> --}}
    @endif

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">

    <link rel="stylesheet" href="{{ asset('datetime/bootstrap-datetimepicker.min.css') }}">

    @php $role = \App\Role::select('name')->where('id', Auth::user()->role_id)->first()->name; @endphp

  </head>
  <body>

  <div id="LoadingImage" style="position:fixed; width: 100px; height:100px; left: 50%; top:50%; z-index: 20;">
  <img src="{{ asset('img/loading.gif') }}" />
  </div>

    <div class="page" id="page" style="display:none;">
      {{-- Main Navbar--}}
      <header class="header">
        <nav class="navbar">
          {{-- Search Box--}}
          <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
            <form id="searchForm" role="search">
              <input type="search" id="searchKey" placeholder="Please enter a serial number...." class="form-control">
            </form>
          </div>
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              {{-- Navbar Header--}}
              <div class="navbar-header">
                {{-- Navbar Brand --}}<a href="{{ route('home') }}" class="navbar-brand">
                  <div class="brand-text brand-big"><span>CatholicNews</span><strong>Online</strong></div>
                  <div class="brand-text brand-small"><strong>CP</strong></div></a>
                {{-- Toggle Button--}}<a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
              </div>
              {{-- Navbar Menu --}}
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">

                <li class="nav-item dropdown"> <a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
      
                {{-- Logout    --}}
              <li class="nav-item"><a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link logout">Logout, {{ Auth::user()->name }}<i class="fa fa-sign-out"></i></a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="page-content d-flex align-items-stretch"> 
        {{-- Side Navbar --}}
        <nav class="side-navbar" style="height:auto;">
          {{-- Sidebar Header--}}
          <div class="sidebar-header d-flex align-items-center">
            <div class="title">
              <h1 class="h4">{{ Auth::user()->name }}</h1>
              <p>{{ ucfirst($role) }}</p>
            </div>
          </div>

          <ul class="list-unstyled" style="overflow-y: auto; max-height:100%;">

            @if($role!="User")
              <li>
                <a href="#articleDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-form"></i>Articles </a>
                <ul id="articleDropdown" class="collapse list-unstyled">
                  <li><a href="{{ route('article.home') }}">All</a></li>
                  <li><a href="{{ route('article.create') }}">New</a></li>
                </ul>
              </li>
            @endif


              <li><a href="#adDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-pencil-case"></i>Advertisements </a>
                <ul id="adDropdown" class="collapse list-unstyled ">
                    <li><a href="{{ route('advertisement.home') }}">All</a></li>
                    {{-- @if($role=="User") --}}
                      <li><a href="{{ route('advertisement.create') }}">New</a></li>
                    {{-- @endif --}}
                    @if($role!="User")
                      <li><a href="{{ route('advertisement.price') }}">Price</a></li>
                    @endif
                </ul>
              </li>

              <li><a href="#orderDropdown" aria-expanded="false" data-toggle="collapse" id="invoiceNotification"> <i class="icon-bill" ></i>Orders </a>
                <ul id="orderDropdown" class="collapse list-unstyled ">
                    <li><a href="{{ route('order.home') }}">All</a></li>
                    {{-- @if($role=="User") --}}
                    <li><a href="{{ route('order.create') }}">New</a></li>
                    {{-- @endif --}}
                </ul>
              </li>

              @if($role!="User")
                <li><a href="#previousDropdown" aria-expanded="false" data-toggle="collapse" id="paymentNotification"> <i class="icon-check"></i>Previous Newspapers </a>
                  <ul id="previousDropdown" class="collapse list-unstyled ">
                      <li><a href="{{ route('previous.home') }}">All</a></li>
                      <li><a href="{{ route('previous.create') }}">New</a></li>
                  </ul>
                </li>
              @endif

              <li><a href="#userDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Videos </a>
                <ul id="userDropdown" class="collapse list-unstyled ">
                    <li><a href="{{ route('video.home') }}">All</a></li>
                    {{-- @if($role=="User") --}}
                      <li><a href="{{ route('video.create') }}">New</a></li>
                    {{-- @endif --}}
                </ul>
              </li>

              @if($role=="Admin")
               <li><a href="#videoDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-user"></i>Users </a>
                <ul id="videoDropdown" class="collapse list-unstyled ">
                    <li><a href="{{ route('user.management.employees_home') }}">Employees</a></li>
                    {{-- @if($role=="User") --}}
                      <li><a href="{{ route('user.management.users_home') }}">Users</a></li>
                    {{-- @endif --}}
                    <li><a href="{{ route('user.management.new_home') }}">New</a></li>
                </ul>
              </li>

                {{-- <li><a href="{{ route('user.management.home') }}"> <i class="icon-user"></i>Users </a></li> --}}
              @endif

              @if($role=="Admin")
                <li><a href="#reportDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Reports </a>
                  <ul id="reportDropdown" class="collapse list-unstyled ">
                      <li><a href="{{ route('report.advertisement') }}">Advertisement</a></li>
                  </ul>
                </li>
              @endif

              <li><a href="#settingDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-list"></i>Settings </a>
                <ul id="settingDropdown" class="collapse list-unstyled ">
                    <li><a href="{{ route('setting.home') }}">Password Change</a></li>
                    @if($role!="User")
                      <li><a href="{{ route('setting.slider') }}">Slider</a></li>
                    @endif
                </ul>
              </li>
            
          </ul>
        </nav>
        <div class="content-inner">
          {{-- Page Header--}}
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">@yield('title')</h2>
            </div>
          </header>
          
          @yield('content')
          
          {{-- Page Footer--}}
          <footer class="main-footer">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-6">
                <p>Catholic News Online &copy; {{ date('Y') }}</p>
                </div>
                <div class="col-sm-6 text-right">
                  <p>Developed by Nishendra Perera</p>
                </div>
              </div>
            </div>
          </footer>
        </div>
      </div>
    </div>

    {{-- JavaScript files--}}
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/popper.js/umd/popper.min.js') }}"> </script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery.cookie/jquery.cookie.js') }}"> </script>

    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>

      <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

      {{-- <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script> --}}

      <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>

        {{-- <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.4.2/js/buttons.flash.min.js">
        </script> --}}
        <script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
        </script>
        {{-- <script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js">
        </script> --}}
        {{-- <script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js">
        </script> --}}
        <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js">
        </script>
        {{-- <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script> --}}
      {{-- @endif --}}
    {{-- @endif --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>


    @if(Route::currentRouteName()=="article.create"||Route::currentRouteName()=="article.edit")
      {{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-bs4.min.js"></script> --}}
      <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    @endif

    <script type="text/javascript" src="{{ asset('datetime/bootstrap-datetimepicker.js') }}"></script>

    {{-- Main File--}}
    <script src="{{ asset('js/front.js') }}"></script>

    <script>    
      window.onload = function() {
        document.getElementById("LoadingImage").style.display = "none";
        document.getElementById("page").style.display = "block";
      };
      
    </script>

    {{-- <script src="{{ asset('dropdown/mock.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('dropdown/jquery.dropdown.css') }}">
    <script src="{{ asset('dropdown/jquery.dropdown.js') }}"></script> --}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> --}}
    {{-- <link rel="stylesheet" href={{ asset("bootstrap-multiselect/bootstrap-multiselect.css") }} type="text/css">
    <script type="text/javascript" src="{{ asset("bootstrap-multiselect/fuse.js") }}"></script>
    <script type="text/javascript" src="{{ asset("bootstrap-multiselect/bootstrap-multiselect.js") }}"></script> --}}

  </body>
</html>