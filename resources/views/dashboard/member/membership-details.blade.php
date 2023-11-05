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

      @if($assigned_staff)
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
                        <span class="badge bg-label-secondary">{{ ucfirst($user->role) }}</span>
                     </div>
                  </div>
               </div>
               <div class="d-flex justify-content-around flex-wrap my-4 py-3">
                  <div class="d-flex align-items-start me-4 mt-3 gap-3">
                     <span class="badge bg-label-primary p-2 rounded"><i class='bx bx-check bx-sm'></i></span>
                     <div>
                        <h5 class="mb-0">1.23k</h5>
                        <span>Tasks Done</span>
                     </div>
                  </div>
                  <div class="d-flex align-items-start mt-3 gap-3">
                     <span class="badge bg-label-primary p-2 rounded"><i class='bx bx-customize bx-sm'></i></span>
                     <div>
                        <h5 class="mb-0">568</h5>
                        <span>Workout done</span>
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

      <!-- Payment details -->
      <div class="col-xl-4 col-lg-5 col-md-5 order-3 order-md-0">
         <div class="card mb-4">
            <div class="card-header">
              <h5 class="mb-0">Payment Details</h5>
            </div>
            <div class="card-body">
               @if($subscription->payment_option == 'credit card')
                  <h5 class="card-title">Credit Card</h5>
                  <div class="mb-3">
                     <label class="form-label" for="creditCardNumber">Credit Card Number</label>
                     <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-credit-card-alt"></i></span>
                        <input type="text" class="form-control ps-3" id="creditCardNumber" value="XXXXXXXXXX-{{ substr($creditCard->credit_card_number, -4) }}" disabled>
                     </div>
                  </div>
                  <div class="mb-3">
                     <label class="form-label" for="validThru">Valid thru (mm/yy)</label>
                     <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                         <input type="text" name="month" class="form-control ps-3" value="{{ $creditCard->valid_thru_month }}" disabled />
                         <input type="text" name="year" class="form-control ps-3" value="{{ $creditCard->valid_thru_year }}" disabled />
                     </div>
                  </div>
                  <div class="mb-3">
                     <label class="form-label" for="cvv_cvc">CVV/CVC</label>
                     <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-credit-card"></i></span>
                        <input type="text" class="form-control ps-3" id="cvv_cvc" name="cvv_cvc" value="XXX" disabled />
                     </div>
                  </div>
                  <div class="mb-3">
                     <label class="form-label" for="cardHolderName">Card Holder Name</label>
                     <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bxs-user-rectangle"></i></span>
                        <input type="text" class="form-control ps-3" id="cardHolderName" name="cardHolderName" value="{{ strtoupper($creditCard->cardholder_name) }}" disabled />
                     </div>
                  </div>
               @elseif($subscription->payment_option == 'gcash')
                  <h5 class="card-title">GCash</h5>
                  <div class="mb-3">
                     <label class="form-label" for="amount">Amount Paid</label>
                     <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-money"></i></span>
                        <input type="text" class="form-control ps-3" id="amount" value="₱{{ $gCash->amount }}" disabled>
                     </div>
                  </div>
                  <div class="mb-3">
                     <label class="form-label" for="phoneNumber">Phone number</label>
                     <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-phone"></i></span>
                        <input type="text" class="form-control ps-3" id="phoneNumber" value="{{ $gCash->phone_number }}" disabled>
                     </div>
                  </div>       
                  <div class="mb-3">
                     <label class="form-label" for="receiptPhoto">Receipt Photo</label>
                     <img class="img-fluid d-flex mx-auto my-4 border" id="receiptPhoto" src="{{ asset('storage/assets/img/gcash_receipts/'.$gCash->receipt_photo) }}" alt="Receipt photo">
                  </div>
               @elseif($subscription->payment_option == 'manual payment')
                  <h5 class="card-title">Manual Payment</h5>
                  <div class="mb-3">
                     <label class="form-label" for="amount">Amount Paid</label>
                     <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-money"></i></span>
                        <input type="text" class="form-control ps-3" id="amount" value="₱{{ $manualPayment->amount }}" disabled>
                     </div>
                  </div>
                  <div class="mb-3">
                     <label class="form-label" for="fullName">Full Name</label>
                     <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bxs-user-rectangle"></i></span>
                        <input type="text" class="form-control ps-3" id="fullName" value="{{ strtoupper($manualPayment->full_name) }}" disabled>
                     </div>
                  </div>
               @endif
            </div>
          </div>
      </div>
      <!--/ Payment Details -->
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