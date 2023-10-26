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
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Membership Details</span></h4>

    <div class="row row-cols-1 mb-3 text-center">
        <div class="col">
            @if($subscription) 
                <h1>You are subscribed to our Regular Subscription Plan.</h1>
            @else 
                <h1>You're not subscribed yet. Please meake a subscription <a href="{{ url('member/available-packages') }}">Here</a></h1>
            @endif
        </div>
    </div>

 </div>
 <!-- / Content -->
@endsection

@section('page-js')
<script src="{{ asset('storage/assets/js/dashboards-analytics.js') }}"></script>
@endsection