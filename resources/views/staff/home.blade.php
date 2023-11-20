@extends('components.layouts.dashboard')

@section('title')
    Admin Dashboard
@endsection

@section('staff-sidebar')
    <x-staff-sidebar/>
@endsection

@section('navbar-top')
    <x-navbar-top/>
@endsection

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">

   <!-- LAYER 1 -->
   <div class="card bg-transparent shadow-none border-0 my-4">
      <div class="card-body row p-0 pb-3">
         <div class="col-12 col-md-8">
            <h3>Welcome back, {{ ucwords( Auth::user()->firstname.' '.Auth::user()->lastname ) }} 👋🏻 </h3>
            <div class="col-12 col-lg-7 ">
               <p>Overview and Real-Time Insights.</p>
            </div>
         </div>
      </div>
   </div>

   <!-- LAYER 2 -->
   <div class="card mb-4">
      <div class="card-widget-separator-wrapper">
         <div class="card-body card-widget-separator">
            <div class="row gy-4 gy-sm-1">
               <div class="col-sm-6 col-lg-4">
                  <div class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                     <div>
                        <h3 class="mb-1">{{ App\Models\Subscription::where('status', 'active')->count() }}</h3>
                        <p class="mb-0">Active Gym <br/>Subscribers</p>
                     </div>
                     <div class="avatar me-sm-4">
                        <span class="avatar-initial rounded bg-label-secondary">
                        <i class="bx bx-user bx-sm"></i>
                        </span>
                     </div>
                  </div>
                  <hr class="d-none d-sm-block d-lg-none me-4">
               </div>
               <div class="col-sm-6 col-lg-4">
                  <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                     <div>
                        <h3 class="mb-1">{{ App\Models\Subscription::where('status', 'pending')->count() }}</h3>
                        <p class="mb-0">Pending Gym <br/>Subscribers</p>
                     </div>
                     <div class="avatar me-lg-4">
                        <span class="avatar-initial rounded bg-label-secondary">
                        <i class="bx bx-user-voice bx-sm"></i>
                        </span>
                     </div>
                  </div>
                  <hr class="d-none d-sm-block d-lg-none">
               </div>
               <div class="col-sm-6 col-lg-4">
                  <div class="d-flex justify-content-between align-items-start pb-3 pb-sm-0 card-widget-3">
                     <div>
                        <h3 class="mb-1">{{ App\Models\Subscription::where('status', 'expired')->count() }}</h3>
                        <p class="mb-0">Expired Gym <br> Subscriptions</p>
                     </div>
                     <div class="avatar me-sm-4">
                        <span class="avatar-initial rounded bg-label-secondary">
                        <i class="bx bx-user-x bx-sm"></i>
                        </span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- LAYER 3 -->
   <div class="row g-4 mb-4 mt-4">
      <div class="col-sm-6 col-xl-3">
         <div class="card">
            <div class="card-body">
               <div class="d-flex align-items-start justify-content-between">
                  <div class="content-left">
                     <span>Registered</span>
                     <div class="d-flex align-items-end mt-2">
                        <h4 class="mb-0 me-2">{{ App\Models\User::where('role', 'member')->count() }}</h4>
                        <small class="text-success">(+{{ $registered_today }})</small>
                     </div>
                     <p class="mb-0">Total Users</p>
                  </div>
                  <div class="avatar">
                     <span class="avatar-initial rounded bg-label-primary">
                     <i class="bx bx-user bx-sm"></i>
                     </span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-6 col-xl-3">
         <div class="card">
            <div class="card-body">
               <div class="d-flex align-items-start justify-content-between">
                  <div class="content-left">
                     <span>Active Users</span>
                     <div class="d-flex align-items-end mt-2">
                        <h4 class="mb-0 me-2">{{ App\Models\User::where('role', 'member')->where('status', 'active')->count() }}</h4>
                     </div>
                     <p class="mb-0">&nbsp;</p>
                  </div>
                  <div class="avatar">
                     <span class="avatar-initial rounded bg-label-success">
                     <i class="bx bx-user-check bx-sm"></i>
                     </span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-6 col-xl-3">
         <div class="card">
            <div class="card-body">
               <div class="d-flex align-items-start justify-content-between">
                  <div class="content-left">
                     <span>Inactive Users</span>
                     <div class="d-flex align-items-end mt-2">
                        <h4 class="mb-0 me-2">{{ App\Models\User::where('role', 'member')->where('status', 'inactive')->count() }}</h4>
                     </div>
                     <p class="mb-0">&nbsp;</p>
                  </div>
                  <div class="avatar">
                     <span class="avatar-initial rounded bg-label-warning">
                     <i class="bx bx-user-minus bx-sm"></i>
                     </span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-6 col-xl-3">
         <div class="card">
            <div class="card-body">
               <div class="d-flex align-items-start justify-content-between">
                  <div class="content-left">
                     <span>Suspended Users</span>
                     <div class="d-flex align-items-end mt-2">
                        <h4 class="mb-0 me-2">{{ App\Models\User::where('role', 'member')->where('status', 'suspended')->count() }}</h4>
                     </div>
                     <p class="mb-0">&nbsp;</p>
                  </div>
                  <div class="avatar">
                     <span class="avatar-initial rounded bg-label-danger">
                     <i class="bx bx-user-x bx-sm"></i>
                     </span>
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