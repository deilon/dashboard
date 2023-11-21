@extends('components.layouts.dashboard')

@section('title')
    Week Fitness Progress
@endsection
@section('custom-css')
 <style>
   .list-group-item:hover a {
      display: block !important;
   }
 </style>
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
   
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">My Weekly Fitness Progress /</span> Weight Loss</h4>
    <p>Here you can add Days and Tasks to Weekly Fitness Progress.</p>

    <div class="row g-4">
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
                         <div class="d-flex">
                           <button class="btn btn-danger btn-sm mt-3 me-2">Delete</button>
                           <button class="btn btn-primary btn-sm mt-3">Add Day Entry</button>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div id="accordionIcon" class="accordion accordion-without-arrow">
               <div class="accordion-item card">
                  <h2 class="accordion-header text-body d-flex justify-content-between align-items-center" id="accordionIconOne">
                     <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionIcon-1" aria-controls="accordionIcon-1">
                        <input class="form-check-input me-2 align-self-start" type="checkbox" value="" id="defaultCheck1">
                        <div class="flex-grow-1">
                           Day Title
                           <small class="d-block text-muted">Day 1</small>
                        </div>
                        <a class="cursor-pointer ms-auto align-self-start" data-user="" data-route-url=""><i class="bx bx-trash"></i></a>
                     </button>
                  </h2>
                  <div id="accordionIcon-1" class="accordion-collapse collapse" data-bs-parent="#accordionIcon">
                     <div class="accordion-body clearfix">
                        <div class="list-group list-group-flush">
                           <span class="list-group-item list-group-item-action">
                              Bear claw cake biscuit
                              <a class="cursor-pointer float-end d-none" data-user="" data-route-url=""><i class="bx bx-trash"></i></a>
                           </span>
                           <span class="list-group-item list-group-item-action">Soufflé pastry pie ice <a class="cursor-pointer float-end d-none" data-user="" data-route-url=""><i class="bx bx-trash"></i></a></span>
                           <span class="list-group-item list-group-item-action">Tart tiramisu cake <a class="cursor-pointer float-end d-none" data-user="" data-route-url=""><i class="bx bx-trash"></i></a></span>
                           <span class="list-group-item list-group-item-action">Bonbon toffee muffin <a class="cursor-pointer float-end d-none" data-user="" data-route-url=""><i class="bx bx-trash"></i></a></span>
                           <span class="list-group-item list-group-item-action">Dragée tootsie roll <a class="cursor-pointer float-end d-none" data-user="" data-route-url=""><i class="bx bx-trash"></i></a></span>
                        </div>
                        <input id="defaultInput" class="form-control" type="text" placeholder="Day 1 task entry">
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