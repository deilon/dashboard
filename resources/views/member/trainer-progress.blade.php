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
    </div>
 </div>
 <!-- / Content -->
@endsection

@section('page-js')
<script src="{{ asset('storage/assets/js/dashboards-analytics.js') }}"></script>
<script src="{{ asset('storage/assets/js/ui-toasts.js')}} "></script>
@endsection