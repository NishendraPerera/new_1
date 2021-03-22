
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Catholic_News_Online Admin Panel</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    {{-- Bootstrap CSS--}}
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    {{-- Font Awesome CSS--}}
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">
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
    {{-- Tweaks for older IEs--}}{{--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]--}}

  </head>
  <body>
        <div class="page login-page">
          <div class="container d-flex align-items-center">
            <div class="form-holder has-shadow">
              <div class="row">
                {{-- Logo & Information Panel--}}
                <div class="col-lg-6">
                  <div class="info d-flex align-items-center">
                    <div class="content">
                      <div class="logo">
                        <h1>CatholicNewsOnline</h1>
                      </div>
                      <p>Login page</p>
                    </div>
                  </div>
                </div>
                {{-- Form Panel    --}}
                <div class="col-lg-6 bg-white">
                  <div class="form d-flex align-items-center">
                    <div class="content">

                    <form method="POST" class="form-validate" action="{{ route('login') }}">
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <div class="form-group">

                            <input id="email" type="text" value="{{ old('email') }}" name="email" required data-msg="Please enter your email" class="input-material">
                            <label for="email" class="label-material">Email</label>

                            @if ($errors->has('email'))
                              <font size="2" color="red">{{ $errors->first('email') }}</font> 
                            @endif
                          
                        </div>

                        <div class="form-group">

                          <input id="password" type="password" name="password" required data-msg="Please enter your password" class="input-material">
                          <label for="password" class="label-material">Password</label>

                          @if ($errors->has('password'))
                            <font size="2" color="red">{{ $errors->first('password') }}</font> 
                          @endif
                        
                        </div>

                        
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>
                      
                    </form>
                  <p style="margin-top:10px;"> Not a registered user? <a href="{{ route('register') }}">Register here!</a></p>
                  <p> Back to <a href="{{ url('/') }}">Home</a></p>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      <div class="copyrights text-center">
        {{-- <p>Developed and Maintained by <a href="http://www.spectracube.com" class="external" style="color: white;">SpectraCube</a> --}}
          <p>Developed by Nishendra Perera</p>
      </div>
    </div>

    {{-- JavaScript files--}}
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/popper.js/umd/popper.min.js') }}"> </script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    {{-- Main File--}}
    <script src="{{ asset('js/front.js') }}"></script>
  </body>
</html>

