@extends('components.layouts.dashboard')

@section('title')
    Membership Details
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

    @if($subscription)
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Membership Details /</span> Regular Subscription Plan</h4>
    <div class="row">
        <!-- User Sidebar -->
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
         <!--/ User Sidebar -->
    </div>
    @else
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Membership Details /</span> Not Subscribed to any Subscription Plan yet</h4>
    <div class="row">
        <div class="col">
            <h1>You're not subscribed yet. Please meake a subscription <a href="{{ url('member/available-packages') }}">Here</a></h1>
        </div>
    </div>
    @endif

 </div>
 <!-- / Content -->
@endsection

@section('page-js')
<script src="{{ asset('storage/assets/js/dashboards-analytics.js') }}"></script>
@endsection