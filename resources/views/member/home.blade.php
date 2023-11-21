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

 </div>
 <!-- / Content -->
@endsection

@section('page-js')
<script src="{{ asset('storage/assets/js/dashboards-analytics.js') }}"></script>
@endsection