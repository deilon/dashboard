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

   <!-- LAYER 1 -->
   <div class="card bg-transparent shadow-none border-0 my-4">
      <div class="card-body row p-0 pb-3">
         <div class="col-12 col-md-8">
            <h3>Hello, {{ ucwords( Auth::user()->firstname.' '.Auth::user()->lastname ) }} 👋🏻 Welcome back</h3>
            <div class="col-12 col-lg-7 ">
               <p>Unlock the Overview and Real-Time Insights. Enhance your experience by subscribing to access more features on your dashboard</p>
            </div>
         </div>
      </div>
   </div>

      <!-- User Sidebar -->
      <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
         <!-- User Card -->
         <div class="card mb-4">
            <div class="card-body">
               <div class="user-avatar-section">
                  <div class=" d-flex align-items-center flex-column">
                      <img class="img-fluid rounded my-4" src="{{ $user->photo ? asset('storage/assets/img/avatars/'. $user->photo) : asset('storage/assets/img/avatars/default.jpg') }}" height="110" width="110" alt="User avatar" />            
                     <div class="user-info text-center">
                        <h4 class="mb-2">{{ ucwords($user->firstname.' '.$user->lastname) }}</h4>
                        <span class="badge bg-label-secondary">{{ ucfirst($user->role) }}</span>
                     </div>
                  </div>
               </div>
               <div class="d-flex justify-content-around flex-wrap my-4 py-3">
                  <div class="d-flex align-items-start me-4 mt-3 gap-3">
                     <span class="badge bg-label-primary p-2 rounded"><i class='bx bx-check bx-sm'></i></span>
                     <div>
                        @php
                           $countUser = App\Models\User::find(Auth::user()->id);

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
                        <span>{{$user->role}}</span>
                     </li>
                     <li class="mb-3">
                        <span class="fw-medium me-2">Contact:</span>
                        <span>{{ $user->phone_number }}</span>
                     </li>
                     <li class="mb-3">
                        <span class="fw-medium me-2">Country:</span>
                        <span>{{ $user->country }}</span>
                     </li>
                     <li class="mb-3">
                        <span class="fw-medium me-2">Account creation:</span>
                        <span>{{ $user->created_at->format('F j, Y \a\t l h:ia') }}</span>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <!-- /User Card -->
      </div>
      <!--/ User Sidebar -->

      @if($subscription)
       <!-- Plan card -->
       <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
          <!-- Plan Card -->
          <div class="card mb-4">
             <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                   <span class="badge bg-label-primary">{{ ucfirst($tier->tier_name) }}</span>
                   <div class="d-flex justify-content-center">
                      <sup class="h5 pricing-currency mt-3 mb-0 me-1 text-primary">₱</sup>
                      <h1 class="display-5 mb-0 text-primary">{{$tier->price}}</h1>
                   </div>
                </div>
                <ul class="ps-3 g-2 my-4">
                   <li class="mb-2">{{ $tier->duration }} Duration</li>
                   <li class="mb-2">Unlimited Sessions</li>
                   <li class="mb-2">Trainer Included</li>
                   <li class="mb-2">No Hidden Charges</li>
                   <li class="mb-2">All Access to Utilites</li>
                   <li>All Access to Gym Equipments</li>
                </ul>
                <div class="my-4 justify-content-between align-items-center">
                   <div>Start date: <span class="fw-bold">{{ $start_date->format('F j, Y') }}</span></div>
                   <div>End date: <span class="fw-bold">{{ $end_date->format('F j, Y') }}</span></div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-1">
                   <span>Days</span>
                   <span><?php echo round($percentage_completed); ?>% Completed</span>
                </div>
                <div class="progress mb-1" style="height: 8px;">
                   <div class="progress-bar" role="progressbar" style="width: <?php echo $percentage_completed; ?>%;" aria-valuenow="<?php echo $percentage_completed; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span><?php echo $total_days - $days_elapsed; ?> days remaining</span>
                <div class="d-grid w-100 mt-4 pt-2">
                   <div class="{{ $subscription->status == 'active' ? 'bg-success' : ($subscription->status == 'pending' ? 'bg-warning' : 'bg-danger') }} text-center text-white p-2 rounded">{{ ucfirst($subscription->status) }}</div>
                </div>
             </div>
          </div>
          <!-- /Plan Card -->
       </div>
       <!--/ Plan Card -->
      @endif

   </div>

 </div>
 <!-- / Content -->
@endsection

@section('page-js')
<script src="{{ asset('storage/assets/js/dashboards-analytics.js') }}"></script>
@endsection