@extends('components.layouts.dashboard')

@section('title')
    Change Password
@endsection

@if(Auth::user()->role == 'admin')
    @section('admin-sidebar')
        <x-admin-sidebar/>
    @endsection
@elseif(Auth::user()->role == 'staff')
    @section('staff-sidebar')
        <x-staff-sidebar/>
    @endsection
@elseif(Auth::user()->role == 'member')
    @section('member-sidebar')
        <x-member-sidebar/>
    @endsection
@endif

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


    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Change Password</h4>
      <div class="row">
         <div class="col-md-6">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
               <li class="nav-item">
                  <a class="nav-link {{ (request()->is('user/account-settings')) ? 'active' : '' }}" href="{{ url('user/account-settings') }}"><i class="bx bx-user me-1"></i> Account</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link {{ (request()->is('user/change-password')) ? 'active' : '' }}" href="{{ url('user/change-password') }}"
                     ><i class="bx bx-lock-alt me-1"></i> Password</a
                     >
               </li>
            </ul>

            <div class="card mb-4">
               <h5 class="card-header">Change Password</h5>
               <div class="card-body">
                  <div class="mb-3 col-12 mb-0">
                     <div class="alert alert-warning">
                        <h6 class="alert-heading fw-bold mb-1">
                           <i class="menu-icon tf-icons bx bx-info-circle"></i>
                           Password modification
                        </h6>
                        <p class="mb-0">Please choose a strong, unique password for enhanced security. Do not share it with anyone. Contact support if you have concerns.</p>
                     </div>
                  </div>
                  <form action="{{ url('user/change-password') }}" method="POST">
                     @csrf
                     <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current password" />
                        @error('current_password')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                     </div>
                     <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="New password" />
                        @error('password')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                     </div>
                     <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Re-type Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-type password" />
                        @error('password_confirmation')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                     </div>
                     <div class="mb-3">
                        <a href="">Forgot password?</a>
                     </div>
                     {{-- <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button> --}}
                     <button type="submit" class="btn btn-danger change-password">Change Password</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
 </div>
 <!-- / Content -->
@endsection