@extends('components.layouts.dashboard')

@section('title')
    Member Dashboard
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
    <div class="row">
       <div class="col mb-4 order-0">
          <div class="card">
             <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                   <div class="card-body">
                      <h5 class="card-title text-primary">Welcome to your Dashboard {{ ucwords(Auth::user()->firstname.' '.Auth::user()->lastname) }} 🚀</h5>
                      <p class="mb-4">
                         You are here. Task completed <span class="fw-bold">72%</span> by your staff today.
                      </p>
                      <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Logs</a>
                   </div>
                </div>
                {{-- <div class="col-sm-5 text-center text-sm-left">
                   <div class="card-body pb-0 px-0 px-md-4">
                      <img src="{{ asset('storage/assets/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png"/>
                   </div>
                </div> --}}
             </div>
          </div>
       </div>
    </div>

    <div class="row">
      <div class="col-lg-6 col-md-4 order-1">
         <div class="row">
            <div class="col-lg-6 col-md-12 col-6 mb-4">
               <div class="card">
                  <div class="card-body">
                     <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                           <img src="{{ asset('storage/assets/img/icons/unicons/paypal.png') }}" alt="Credit Card" class="rounded" />
                        </div>
                        <div class="dropdown">
                           <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                             <i class="bx bx-dots-vertical-rounded"></i>
                           </button>
                           <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                              <a class="dropdown-item" href="javascript:void(0);">View More</a>
                              <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                           </div>
                        </div>
                     </div>
                     <span class="fw-semibold d-block mb-1">Profit</span>
                     <h3 class="card-title mb-2">P12,628</h3>
                     {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> --}}
                  </div>
               </div>
            </div>
            <div class="col-lg-6 col-md-12 col-6 mb-4">
               <div class="card">
                  <div class="card-body">
                     <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                           <img src="{{ asset('storage/assets/img/icons/unicons/wallet-info.png') }}" alt="Credit Card" class="rounded"/>
                        </div>
                        <div class="dropdown">
                           <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="bx bx-dots-vertical-rounded"></i>
                           </button>
                           <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                              <a class="dropdown-item" href="javascript:void(0);">View More</a>
                              <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                           </div>
                        </div>
                     </div>
                     <span class="fw-semibold d-block mb-1">Sales</span>
                     <h3 class="card-title text-nowrap mb-1">P4,679</h3>
                     {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> --}}
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-6 mb-4">
         <div class="card">
            <div class="card-body">
               <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                     <img src="{{ asset('storage/assets/img/icons/unicons/chart-success.png') }}" alt="chart success" class="rounded" />
                  </div>
                  <div class="dropdown">
                     <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                        <i class="bx bx-dots-vertical-rounded"></i>
                     </button>
                     <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                     </div>
                  </div>
               </div>
               <span class="fw-semibold d-block mb-1">Registered Users</span>
               <h3 class="card-title text-nowrap mb-2">190</h3>
               {{-- <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small> --}}
            </div>
         </div>
      </div>

      <div class="col-6 mb-4">
         <div class="card">
            <div class="card-body">
               <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                     <img src="{{ asset('storage/assets/img/icons/unicons/cc-primary.png') }}" alt="Credit Card" class="rounded" />
                  </div>
                  <div class="dropdown">
                     <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                        <i class="bx bx-dots-vertical-rounded"></i>
                     </button>
                     <div class="dropdown-menu" aria-labelledby="cardOpt1">
                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                     </div>
                  </div>
               </div>
               <span class="fw-semibold d-block mb-1">Membership</span>
               <h3 class="card-title mb-2">102</h3>
               {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small> --}}
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