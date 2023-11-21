@extends('components.layouts.dashboard')

@section('title')
    My Fitness Progress
@endsection
@section('custom-css')

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
   
    <h4 class="py-3 mb-2">My Fitness Progress</h4>
    <p>Here you can create your own separate Fitness Progress wether you have your own Trainer assigned or not. <br> 
        Own your progress by creating Progress Weeks, Daily Progress, and Task Lists.</p>

    <div class="row g-4">
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card h-100">
               <div class="row h-100">
                  <div class="col-sm-5">
                     <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                        <img src="{{ asset('storage/assets/img/illustrations/girl-doing-yoga-light.png') }}" class="img-fluid" alt="Image" width="120" data-app-light-img="illustrations/sitting-girl-with-laptop-light.png" data-app-dark-img="illustrations/sitting-girl-with-laptop-dark.png">
                     </div>
                  </div>
                  <div class="col-sm-7">
                     <div class="card-body text-sm-end text-center ps-sm-0">
                        <button data-bs-target="#addRoleModal" data-bs-toggle="modal" class="btn btn-primary mb-3 text-nowrap">Add Progress</button>
                        <p class="mb-0">We will start the progress by week.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                   <div class="d-flex justify-content-between mb-2">
                      <h6 class="fw-normal">Total 4 users</h6>
                      <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                         <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-sm pull-up" aria-label="Vinnie Mostowy" data-bs-original-title="Vinnie Mostowy">
                            <img class="rounded-circle" src="{{ asset('storage/assets/img/avatars/5.png') }}" alt="Avatar">
                         </li>
                      </ul>
                   </div>
                   <div class="d-flex justify-content-between align-items-end">
                      <div class="role-heading">
                         <h4 class="mb-1">Weight Loss</h4>
                         <small class="d-block">Week No. 1</small>
                         <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><small>View</small></a>
                      </div>
                   </div>
                </div>
             </div>
        </div>
    </div>

 </div>
 <!-- / Content -->
@endsection

@section('page-js')
<script src="{{ asset('storage/assets/js/dashboards-analytics.js') }}"></script>
@endsection