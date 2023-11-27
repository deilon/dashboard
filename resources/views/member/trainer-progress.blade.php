@extends('components.layouts.dashboard')

@section('title')
    Trainer Progress
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

    <!-- Toast with Placements -->
      <div class="bs-toast toast toast-placement-ex m-2" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
         <div class="toast-header">
            <i class='bx bx-bell me-2'></i>
         <div class="me-auto fw-semibold">Progress Week update</div>
            <small>1 sec ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
         </div>
         <div class="toast-body">
            <span id="status-message">Null</span>
         </div>
      </div>
      <!-- Toast with Placements -->

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
    @if ($errors->any())
      <div class="row">
          <div class="col-md">
          <div class="alert alert-danger alert-dismissible" role="alert">
              Some input fields values are incorrect. Please check
          </div>
          </div>
      </div>
    @endif
   
    <h4 class="py-3 mb-2">Your Trainer Fitness Progress Weeks</h4>
    <p>This is your Fitness Progress curated by your Trainer. <br> 
        NOTE: That only your trainer can make changes to this progress.</p>


    <div class="row g-4">

      
      @if($assigned_staff !== null)
      <!-- Trainer details -->
      <div class="col-xl-4 col-lg-5 col-md-5 order-2 order-md-0">
         <div class="card mb-4">
            <div class="card-body">
               <h5 class="card-title text-center">Trainer Details</h5>
               <div class="user-avatar-section">
                  <div class=" d-flex align-items-center flex-column">
                     <img class="img-fluid rounded my-4" src="{{ $assigned_staff->photo ? asset('storage/assets/img/avatars/'. $assigned_staff->photo) : asset('storage/assets/img/avatars/default.jpg') }}" height="110" width="110" alt="User avatar" />            
                     <div class="user-info text-center">
                        <h4 class="mb-2">{{ ucwords($assigned_staff->firstname.' '.$assigned_staff->lastname) }}</h4>
                        <span class="badge bg-label-secondary">{{ ucfirst($assigned_staff->role) }}</span>
                     </div>
                  </div>
               </div>
               <div class="d-flex justify-content-around flex-wrap my-4 py-3">
                  <div class="d-flex align-items-start me-4 mt-3 gap-3">
                     <span class="badge bg-label-primary p-2 rounded"><i class='bx bx-check bx-sm'></i></span>
                     <div>
                        @php
                           $mySubscription = App\Models\Subscription::where('user_id', Auth::user()->id)->first();
                           $countUser = App\Models\User::find($mySubscription->staff_assigned_id);

                           $totalProgressDayTasks = $countUser->progressWeek()
                              ->with('progressDay.progressDayTask') // Eager load relationships
                              ->get()
                              ->pluck('progressDay')
                              ->flatten()
                              ->pluck('progressDayTask')
                              ->flatten()
                              ->count();
                           $totalProgressWeeks = $countUser->progressWeek()->count();  
                        @endphp
                        <h5 class="mb-0">{{ $totalProgressDayTasks }}</h5>
                        <span>Tasks Done</span>
                     </div>
                  </div>
                  <div class="d-flex align-items-start mt-3 gap-3">
                     <span class="badge bg-label-primary p-2 rounded"><i class='bx bx-customize bx-sm'></i></span>
                     <div>
                        <h5 class="mb-0">{{ $totalProgressWeeks }}</h5>
                        <span>Weeks Progress</span>
                     </div>
                  </div>
               </div>
               <h5 class="pb-2 border-bottom mb-4">Details</h5>
               <div class="info-container">
                  <ul class="list-unstyled">
                     <li class="mb-3">
                        <span class="fw-medium me-2">Email:</span>
                        <span>{{$user->email}}</span>
                     </li>
                     <li class="mb-3">
                        <span class="fw-medium me-2">Status:</span>
                        @if($user->status == 'active')
                           <span class="badge bg-label-success me-1">Active</span>
                        @elseif($user->status == 'inactive')
                           <span class="badge bg-label-warning me-1">Inactive</span>
                        @elseif($user->status == 'disabled')
                           <span class="badge bg-label-secondary me-1">Disabled</span>
                        @else
                           <span class="badge bg-label-warning me-1">Suspended</span>
                        @endif
                     </li>
                     <li class="mb-3">
                        <span class="fw-medium me-2">Role:</span>
                        <span>{{$assigned_staff->role}}</span>
                     </li>
                     <li class="mb-3">
                        <span class="fw-medium me-2">Country:</span>
                        <span>{{ $assigned_staff->country }}</span>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <!--/ Trainer Details -->
      @else
      <!-- Pending Trainer details -->
      <div class="col-xl-4 col-lg-5 col-md-5 order-2 order-md-0">
         <div class="card mb-4">
            <div class="card-body">
               <h5 class="card-title text-center">Trainer Details</h5>
               <div class="user-avatar-section">
                  <div class=" d-flex align-items-center flex-column">
                     <img class="img-fluid rounded my-4" src="{{ asset('storage/assets/img/avatars/default.jpg') }}" height="110" width="110" alt="User avatar" />            
                     <div class="user-info text-center">
                        <h4 class="mb-2">...</h4>
                        <span class="badge bg-label-secondary">Trainer / Staff</span>
                     </div>
                  </div>
               </div>
               <h5 class="pb-2 border-bottom mb-4">Details</h5>
               <div class="info-container">
                  <ul class="list-unstyled">
                     <li class="mb-3">
                        <span class="fw-medium me-2">Email:</span>
                        <span>Pending</span>
                     </li>
                     <li class="mb-3">
                        <span class="fw-medium me-2">Status:</span>
                        <span class="badge bg-label-secondary me-1">Pending</span>
                     </li>
                     <li class="mb-3">
                        <span class="fw-medium me-2">Role:</span>
                        <span>Trainer / Staff</span>
                     </li>
                     <li class="mb-3">
                        <span class="fw-medium me-2">Country:</span>
                        <span>Philippines</span>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <!--/ Pending Trainer Details -->
      @endif

      @if($progressWeeks !== null)
         @foreach($progressWeeks as $pweek)
         <div class="col-xl-4 col-lg-6 col-md-6" id="pwItem{{ $pweek->id }}">
            <div class="card">
                <div class="card-body">
                   <div class="d-flex justify-content-between mb-2">
                      <h6 class="fw-normal">Progress Week</h6>
                      <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                      </ul>
                   </div>
                   <div class="d-flex justify-content-between align-items-end">
                      <div class="role-heading">
                         <h4 class="mb-1">{{ ucwords($pweek->week_title) }}</h4>
                         <small class="d-block">Week No. {{ $pweek->week_number }}</small>
                         <a href="{{ url('member/static-trainer-week/'.$pweek->id) }}" target="_blank"><small>View</small></a>
                      </div>
                   </div>
                </div>
             </div>
         </div>
         @endforeach
      @endif
    </div>
 </div>
 <!-- / Content -->
@endsection

@section('page-js')
<script src="{{ asset('storage/assets/js/dashboards-analytics.js') }}"></script>
<script src="{{ asset('storage/assets/js/ui-toasts.js')}} "></script>
@endsection