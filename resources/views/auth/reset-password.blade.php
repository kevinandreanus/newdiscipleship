<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Discipleship APPS">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#0134d4">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Title -->
    <title>Discipleship</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="/img/core-img/favicon.ico">
    <link rel="apple-touch-icon" href="/img/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/img/icons/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="167x167" href="/img/icons/icon-167x167.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/icons/icon-180x180.png">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tiny-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/baguetteBox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/rangeslider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vanilla-dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/apexcharts.css') }}">
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.flexdatalist.min.css') }}">
    @stack('custom-css')
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{ asset('style.css') }}">
  </head>
  <body>
    <!-- Preloader -->
    <div id="preloader">
      <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
    </div>
    <!-- Internet Connection Status -->
    <!-- # This code for showing internet connection status -->
    <div class="internet-connection-status" id="internetStatus"></div>
    <!-- Back Button-->
    <div class="login-back-button"><a href="{{ url()->previous() }}">
        <svg class="bi bi-arrow-left-short" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"></path>
        </svg></a></div>
    <!-- Login Wrapper Area -->
    <div class="login-wrapper d-flex align-items-center justify-content-center">
      <div class="custom-container">
        <div class="text-center px-4"><img class="login-intro-img" src="/img/logos.png" alt=""></div>
        <!-- Register Form -->
        <div class="register-form mt-4">
            
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
    
                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
    
                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Email')" />
    
                    <x-input id="email" class="form-control block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
                </div>
    
                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />
    
                    <x-input id="password" class="form-control block mt-1 w-full" type="password" name="password" required />
                </div>
    
                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />
    
                    <x-input id="password_confirmation" class="form-control block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required />
                </div>

                <!-- Validation Errors -->
                <x-auth-validation-errors class="text-danger" style="font-size: 12px; color: red" :errors="$errors" />

                <div class="flex items-center justify-end mt-4">
                    <x-button id="reset_btn" class="btn btn-primary">
                        {{ __('Reset Password') }}
                    </x-button>
                </div>
            </form>
        </div>
      </div>
    </div>
    <!-- All JavaScript Files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/slideToggle.min.js') }}"></script>
    <script src="{{ asset('js/internet-status.js') }}"></script>
    <script src="{{ asset('js/tiny-slider.js') }}"></script>
    <script src="{{ asset('js/baguetteBox.min.js') }}"></script>
    {{-- <script src="{{ asset('js/countdown.js') }}"></script> --}}
    <script src="{{ asset('js/rangeslider.min.js') }}"></script>
    <script src="{{ asset('js/vanilla-dataTables.min.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <script src="{{ asset('js/magic-grid.min.js') }}"></script>
    <script src="{{ asset('js/dark-rtl.js') }}"></script>
    <script src="{{ asset('js/active.js') }}"></script>
    {{-- Custom JS --}}
    <script src="{{ asset('js/font-awesome.js') }}"></script>
    <script>
        
        $('#password').on('keyup', function(){
            var length1 = $(this).val().length
            var length2 = $('#password_confirmation').val().length
            
            if(length1 > 0 && length2 > 0){
                $('#reset_btn').removeClass('disabled');
            }
            else{
                $('#reset_btn').addClass('disabled');
            }
        });
        $('#password_confirmation').on('keyup', function(){
            var length1 = $(this).val().length
            var length2 = $('#password').val().length
            
            if(length1 > 0 && length2 > 0){
                $('#reset_btn').removeClass('disabled');
            }
            else{
                $('#reset_btn').addClass('disabled');
            }
        });
    </script>
  </body>
</html>