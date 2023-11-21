@extends('components.layouts.dashboard')

@section('title')
    Fitness Progress
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
   
      <h4 class="py-3 mb-4"><span class="text-muted fw-light">Fitness Progress</span></h4>
      <div class="row">
         <div class="col">
               <h5>Subscribe to our Gym Membership Plan to unlock this feature. <br> 
                <a href="{{ url('member/available-packages') }}">See available packages</a></h5>
         </div>
      </div>

 </div>
 <!-- / Content -->
@endsection

@section('page-js')
<script src="{{ asset('storage/assets/js/dashboards-analytics.js') }}"></script>
@endsection