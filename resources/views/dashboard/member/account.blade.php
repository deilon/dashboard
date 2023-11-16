@extends('components.layouts.dashboard')

@section('title')
    Account Settings
@endsection

@section('member-sidebar')
    <x-member-sidebar/>
@endsection

@section('navbar-top')
    <x-navbar-top/>
@endsection

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
      
      {{-- Alerts for form --}}
      @if(session('success'))
         <div class="row">
            <div class="col-md">
               <div class="alert alert-success alert-dismissible" role="alert">
                  {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
         </div>
      @endif

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>
    <div class="row">
       <div class="col-md-12">
          <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item">
               <a class="nav-link {{ (request()->is('member/account-settings')) ? 'active' : '' }}" href="{{ url('member/account-settings') }}"><i class="bx bx-user me-1"></i> Account</a>
            </li>
            <li class="nav-item">
               <a class="nav-link {{ (request()->is('member/change-password')) ? 'active' : '' }}" href="{{ url('member/change-password') }}"
                  ><i class="bx bx-lock-alt me-1"></i> Password</a
                  >
            </li>
          </ul>
          <div class="card mb-4">
             <h5 class="card-header">Profile Details</h5>
             <!-- Account -->
             <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                   @if(Auth::user()->photo !== null)
                        <img src="{{ asset('storage/assets/img/avatars/'. Auth::user()->photo) }}" alt="user-avatar" class="d-block rounded user-photo" height="100" width="100" id="uploadedAvatar"/>
                   @elseif(Auth::user()->photo == null)
                        <img src="{{ asset('storage/assets/img/avatars/default.jpg') }}" alt="user-avatar" class="d-block rounded user-photo" height="100" width="100" id="uploadedAvatar"/>
                   @endif
                    <div class="button-wrapper">
                      <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                        <span class="d-none d-sm-block upload-button">Upload new photo</span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                      </label>
                      <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                        <i class="bx bx-reset d-block d-sm-none"></i>
                        <span class="d-none d-sm-block reset-photo">Reset</span>
                      </button>
                      <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                   </div>
                </div>
             </div>
             <hr class="my-0" />
             <div class="card-body">
                <form id="formAccountSettings" action="{{ url('member/profile-update') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                   <div class="row">
                      <div class="mb-3 col-md-6">
                         <label for="firstname" class="form-label">First Name</label>
                         <input class="form-control" type="text" id="firstname" name="firstname" value="{{ old('firstname', ucwords(Auth::user()->firstname)) }}" autofocus />
                         @error('firstname')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                      </div>
                      <div class="mb-3 col-md-6">
                         <label for="middlename" class="form-label">Middle Name</label>
                         <input class="form-control" type="text" id="middlename" name="middlename" value="{{ old('middlename', ucwords(Auth::user()->middlename)) }}" autofocus />
                         @error('middlename')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                      </div>
                      <div class="mb-3 col-md-6">
                         <label for="lastname" class="form-label">Last Name</label>
                         <input class="form-control" type="text" name="lastname" id="lastname" value="{{ old('lastname', ucwords(Auth::user()->lastname)) }}" />
                         @error('lastname')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                      </div>
                      <div class="mb-3 col-md-6">
                         <label for="email" class="form-label">E-mail</label>
                         <input class="form-control" type="text" id="email" name="email" value="{{ old('email', ucwords(Auth::user()->email)) }}" />
                         @error('email')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                      </div>
                      <div class="mb-3 col-md-6">
                         <label class="form-label" for="phonenumber">Phone Number</label>
                         <div class="input-group input-group-merge">
                            <span class="input-group-text">PH (+63)</span>
                            <input type="text" id="phoneNumber" name="phone_number" class="form-control" value="{{ old('phone_number', ucwords(Auth::user()->phone_number)) }}" />
                         </div>
                         @error('phone_number')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                      </div>
                      <div class="mb-3 col-md-6">
                         <label for="address" class="form-label">Address</label>
                         <input type="text" class="form-control" id="address" name="address" value="{{ old('address', ucwords(Auth::user()->address)) }}" />
                         @error('address')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                      </div>
                      <div class="mb-3 col-md-6">
                         <label class="form-label" for="country">Country</label>
                         <select id="country" name="country" class="select2 form-select">
                            <option value="">Select</option>
                            <option selected value="Philippines">Philippines</option>
                         </select>
                         @error('country')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                      </div>
                      <div class="mb-3 col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" value="{{ old('city', ucwords(Auth::user()->city)) }}" />
                        @error('city')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                     </div>
                     <div class="input-and-label mb-3 d-none">
                        <label for="photo" class="font-medium">Upload profile photo</label> <br>
                        <input type="file" class="h-9 mt-2 border-1 border-slate-200 shadow-lg w-full photo-upload" name="photo" id="photo" value="{{ old('photo', Auth::user()->photo) }}">
                        @error('photo')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                      </div>
                   </div>
                   <div class="mt-2">
                      <button type="submit" class="btn btn-primary me-2">Save changes</button>
                      <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                   </div>
                </form>
             </div>
             <!-- /Account -->
          </div>
          {{-- <div class="card">
             <h5 class="card-header">Delete Account</h5>
             <div class="card-body">
                <div class="mb-3 col-12 mb-0">
                   <div class="alert alert-warning">
                      <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                      <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                   </div>
                </div>
                <form id="formAccountDeactivation" onsubmit="return false">
                   <div class="form-check mb-3">
                      <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
                      <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
                   </div>
                     <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                </form>
             </div>
          </div> --}}
       </div>
    </div>
 </div>
 <!-- / Content -->
@endsection

@section('page-js')
<script src="{{ asset('storage/assets/js/dashboards-analytics.js') }}"></script>
<script>
   $(document).ready(function() {
     
     var readURL = function(input) {
         if (input.files && input.files[0]) {
             var reader = new FileReader();
 
             reader.onload = function (e) {
                 $('.user-photo').attr('src', e.target.result);
             }
     
             reader.readAsDataURL(input.files[0]);
         }
     }
   
      // Event handler for the "Reset" button
      $(".account-image-reset").on('click', function() {
         // Set the profile photo to the default image
         $('.user-photo').attr('src', '/storage/assets/img/avatars/default.jpg');
         // Clear the file input
         $('#photo').val('');
      });
 
     $(".photo-upload").on('change', function(){
         readURL(this);
     });
     
     $(".upload-button").on('click', function() {
       $(".photo-upload").click();
     });

   });
 </script>
@endsection