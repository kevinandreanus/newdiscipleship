{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Resend Verification Email') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout> --}}

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
    <link rel="icon" href="../img/core-img/favicon.ico">
    <link rel="apple-touch-icon" href="../img/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../img/icons/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="167x167" href="../img/icons/icon-167x167.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/icons/icon-180x180.png">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/tiny-slider.css">
    <link rel="stylesheet" href="../css/baguetteBox.min.css">
    <link rel="stylesheet" href="../css/rangeslider.css">
    <link rel="stylesheet" href="../css/vanilla-dataTables.min.css">
    <link rel="stylesheet" href="../css/apexcharts.css">
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="../style.css">
    <!-- Web App Manifest -->
    <link rel="manifest" href="../manifest.json">
  </head>
  <body>
    <!-- Preloader -->
    <div id="preloader">
      <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
    </div>
    <!-- Internet Connection Status -->
    <!-- # This code for showing internet connection status -->
    <div class="internet-connection-status" id="internetStatus"></div>
    <!-- Back Button -->
    <div class="login-back-button"><a href="{{ url()->previous() }}">
        <svg class="bi bi-arrow-left-short" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"></path>
        </svg></a></div>
    <!-- Login Wrapper Area -->
    <div class="login-wrapper d-flex align-items-center justify-content-center">
      <div class="custom-container">
        <div class="text-center"><img class="mx-auto mb-4 d-block" src="../img/logos.png" alt="" width="200px">
          <h3>Email Verification</h3>
          <p>Your email need to be verified.</p>
            <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to send verification email') }}</button>.
            </form>
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 text-sm text-success" style="font-size: 12px">
                    {{ __('Verification Sent.') }}
                </div>
            @endif
        </div>
        <!-- OTP Send Form -->

      </div>
    </div>
    <!-- All JavaScript Files -->
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/slideToggle.min.js"></script>
    <script src="../js/internet-status.js"></script>
    <script src="../js/tiny-slider.js"></script>
    <script src="../js/baguetteBox.min.js"></script>
    <script src="../js/countdown.js"></script>
    <script src="../js/rangeslider.min.js"></script>
    <script src="../js/vanilla-dataTables.min.js"></script>
    <script src="../js/index.js"></script>
    <script src="../js/magic-grid.min.js"></script>
    <script src="../js/dark-rtl.js"></script>
    <script src="../js/active.js"></script>
    <!-- PWA -->
    <script src="../js/pwa.js"></script>
  </body>
</html>