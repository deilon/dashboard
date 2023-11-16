<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('storage/assets') }}" data-template="vertical-menu-template-free">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
      <title>Register</title>
      <meta name="description" content="" />
      <!-- Favicon -->
      <link rel="icon" type="image/x-icon" href="{{ asset('storage/assets/img/favicon/favicon.ico') }}" />
      <!-- Fonts -->
      <link rel="preconnect" href="https://fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"/>
      <!-- Icons. Uncomment required icon fonts -->
      <link rel="stylesheet" href="{{ asset('storage/assets/vendor/fonts/boxicons.css') }}" />
      <!-- Core CSS -->
      <link rel="stylesheet" href="{{ asset('storage/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
      <link rel="stylesheet" href="{{ asset('storage/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
      <link rel="stylesheet" href="{{ asset('storage/assets/css/demo.css') }}" />
      <!-- Vendors CSS -->
      <link rel="stylesheet" href="{{ asset('storage/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
      <!-- Page CSS -->
      <!-- Page -->
      <link rel="stylesheet" href="{{ asset('storage/assets/vendor/css/pages/page-auth.css') }}" />
      <!-- Helpers -->
      <script src="{{ asset('storage/assets/vendor/js/helpers.js') }}"></script>
      <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
      <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
      <script src="{{ asset('storage/assets/js/config.js') }}"></script>
      {{-- Custom css --}}
      <link rel="stylesheet" href="{{ asset('storage/assets/css/custom.css') }}" />
   </head>
   <body>
      <!-- Content -->
      <div class="container-xxl registration-wrap">
         <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
               <!-- Register Card -->
               <div class="card">
                  <div class="card-body">
                     <!-- Logo -->
                     <div class="app-brand justify-content-center">
                        <a href="index.html" class="app-brand-link gap-2">
                           <span class="app-brand-logo demo">
                            <img src="{{ asset('storage/assets/img/logo/logo.svg') }}" alt="Company logo" height="auto" width="130" />
                           </span>
                        </a>
                     </div>
                     <!-- /Logo -->
                     <h4 class="mb-2">Register 🎯</h4>
                     <p class="mb-4">Track your Fitness tasks and more!</p>
                     <form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="POST">
                       @csrf 
                        <div class="mb-3">
                           <label for="firstname" class="form-label">First Name</label>
                           <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname') }}" placeholder="Enter your first name" />
                           @error('firstname')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                           <label for="lastname" class="form-label">Last Name</label>
                           <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') }}" placeholder="Enter your last name" />
                           @error('lastname')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                           <label for="email" class="form-label">Email</label>
                           <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" />
                           @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3 form-password-toggle">
                           <label class="form-label" for="password">Password</label>
                           <div class="input-group input-group-merge">
                              <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                              <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                              @error('password')<div class="text-danger">{{ $message }}</div>@enderror
                           </div>
                        </div>
                        <div class="mb-3 form-password-toggle">
                           <label class="form-label" for="password">Re-type Password</label>
                           <div class="input-group input-group-merge">
                              <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                              <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                              @error('password_confirmation')<div class="text-danger">{{ $message }}</div>@enderror
                           </div>
                        </div>
                        <div class="mb-3">
                           <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                              <label class="form-check-label" for="terms-conditions">
                              I agree to
                              <a href="javascript:void(0);">privacy policy & terms</a>
                              </label>
                           </div>
                        </div>
                        <button class="btn btn-primary d-grid w-100">Sign up</button>
                     </form>
                     <p class="text-center">
                        <span>Already have an account?</span>
                        <a href="{{ url('login') }}">
                           <span>Sign in instead</span>
                        </a>
                     </p>
                  </div>
               </div>
               <!-- Register Card -->
            </div>
         </div>
      </div>
      <!-- / Content -->




      <!-- Core JS -->
      <!-- build:js assets/vendor/js/core.js -->
      <script src="{{ asset('storage/assets/vendor/libs/jquery/jquery.js') }}"></script>
      <script src="{{ asset('storage/assets/vendor/libs/popper/popper.js') }}"></script>
      <script src="{{ asset('storage/assets/vendor/js/bootstrap.js') }}"></script>
      <script src="{{ asset('storage/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
      <script src="{{ asset('storage/assets/vendor/js/menu.js') }}"></script>
      <!-- endbuild -->
      <!-- Vendors JS -->
      <!-- Main JS -->
      <script src="{{ asset('storage/assets/js/main.js') }}"></script>
      <!-- Page JS -->
      <!-- Place this tag in your head or just before your close body tag. -->
      <script async defer src="https://buttons.github.io/buttons.js"></script>
   </body>
</html>