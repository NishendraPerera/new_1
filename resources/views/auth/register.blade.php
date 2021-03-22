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
                      <p>Registration page</p>
                    </div>
                  </div>
                </div>
                {{-- Form Panel    --}}
                <div class="col-lg-6 bg-white">
                  <div class="form d-flex align-items-center">
                    <div class="content">

                    <form method="POST" class="form-validate" action="{{ route('register') }}">
                        <input type="hidden" name="_token" value="{{ Session::token() }}">

                        <div class="form-group">
                            <input id="name" type="text" onkeypress="return /[a-z]/i.test(event.key)" value="{{ old('name') }}" name="name" required data-msg="Please enter your name" class="input-material">
                            <label for="name" class="label-material">Name<span class="text-danger">*</span>
                            </label>
                            

                            @if ($errors->has('name'))
                                <font size="2" color="red">{{ $errors->first('name') }}</font> 
                            @endif
                          
                        </div>

                        <div class="form-group">
                            <input id="email" type="email" value="{{ old('email') }}" name="email" required data-msg="Please enter your email" class="input-material">
                            <label for="email" class="label-material">Email<span class="text-danger">*</span></label>

                            @if ($errors->has('email'))
                              <font size="2" color="red">{{ $errors->first('email') }}</font> 
                            @endif
                          
                        </div>

                        <div class="form-group">
                          <input id="nic" type="text" maxlength="12" value="{{ old('nic') }}" name="nic" required data-msg="Please enter your NIC no" class="input-material">
                          <label for="nic" class="label-material">NIC No<span class="text-danger">*</span></label>

                          @if ($errors->has('nic'))
                            <font size="2" color="red">{{ $errors->first('nic') }}</font> 
                          @endif
                        
                        </div>

                        <div class="form-group">
                          <input id="contact" type="tel" maxlength="10" value="{{ old('contact') }}" name="contact" required data-msg="Please enter your contact no" class="input-material">
                          <label for="contact" class="label-material">Contact No<span class="text-danger">*</span></label>

                          @if ($errors->has('contact'))
                            <font size="2" color="red">{{ $errors->first('contact') }}</font> 
                          @endif
                        
                        </div>

                        <div class="form-group">

                          <input id="password" type="password" name="password" required data-msg="Please enter a password" class="input-material">
                          <label for="password" class="label-material">Password<span class="text-danger">*</span></label>

                          @if ($errors->has('password'))
                            <font size="2" color="red">{{ $errors->first('password') }}</font> 
                          @endif
                        
                      </div>   
                      
                      <div class="form-group">

                        <input id="password-confirm" type="password" name="password_confirmation" required data-msg="Re-enter the password" class="input-material">
                        <label for="password-confirm" class="label-material">Confirm Password<span class="text-danger">*</span></label>
                        
                    </div> 

                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                        
                    </form>
                    <p style="margin-top:10px;"> Already a user? <a href="{{ route('login') }}">Login here!</a></p>
                    <p> Back to <a href="{{ url('/') }}">Home</a></p>
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

