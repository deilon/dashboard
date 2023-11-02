@extends('components.layouts.dashboard')

@section('title')
    Packages
@endsection
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('storage/assets/css/pricing.css') }}" />
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
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Packages /</span> {{ ucfirst($subscriptionArrangement->arrangement_name) }}</h4>

      <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
        @foreach($tiers as $tier)
        <div class="col">
          <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3 mb-3">
              <h4 class="my-0 fw-normal">{{ ucwords($tier->tier_name) }}</h4>
              <div class="divider">
                <div class="divider-text">
                  <i class="bx bx-time-five"></i>
                  {{ $tier->duration.' Duration' }}
                </div>
              </div>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">₱{{ ceil($tier->price) }}</h1>
              {{-- <h1 class="card-title pricing-card-title">₱1,500</h1> --}}
              <ul class="list-unstyled mt-3 mb-4">
                <li>Unlimited Sessions</li>
                <li>Trainer Included</li>
                <li>No Hidden Charges</li>
                <li>All Access to Utilites</li>
                <li>All Access to Gym Equipments</li>
              </ul>
              @if(Auth::user()->subscriptions->count() > 0)
                <a class="w-100 btn btn-lg btn-secondary" disabled data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="" data-bs-original-title="<i class='bx bx-lock-alt bx-xs' ></i> <span>You have an existing subscription</span>">Subscribe</a> 
              @else
                <a href="{{ route('checkout.plan', ['subscription_arrangement_id' => $subscriptionArrangement->id, 'tier_id' => $tier->id]) }}" class="w-100 btn btn-lg btn-outline-primary">Subscribe</a>
              @endif
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
@endsection