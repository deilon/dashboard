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
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Packages /</span> Regular</h4>
    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
        <div class="col">
          <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3 mb-3">
              <h4 class="my-0 fw-normal">2 Months</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">₱750<small class="text-muted fw-light">/mo</small></h1>
              {{-- <h1 class="card-title pricing-card-title">₱1,500</h1> --}}
              <ul class="list-unstyled mt-3 mb-4">
                <li>Unlimited Sessions</li>
                <li>Trainer Included</li>
                <li>No Hidden Charges</li>
                <li>All Access to Utilites</li>
                <li>All Access to Gym Equipments</li>
              </ul>
              <h6 class="fw-light fst-italic">*Total Cost ₱1,500</h6>
              <button type="button" class="w-100 btn btn-lg btn-outline-primary">Purchase</button>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3 mb-3">
              <h4 class="my-0 fw-normal">3 Months</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title">₱733.33<small class="text-muted fw-light">/mo</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>Unlimited Sessions</li>
                <li>Trainer Included</li>
                <li>No Hidden Charges</li>
                <li>All Access to Utilites</li>
                <li>All Access to Gym Equipments</li>
              </ul>
              <h6 class="fw-light fst-italic">*Total Cost ₱2,200</h6>
              <button type="button" class="w-100 btn btn-lg btn-primary">Purchase</button>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card mb-4 rounded-3 shadow-sm border-primary">
            <div class="card-header py-3 mb-3 text-white border-primary">
              <h4 class="my-0 fw-normal">6 Months</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">₱483.33<small class="text-muted fw-light">/mo</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>Unlimited Sessions</li>
                <li>Trainer Included</li>
                <li>No Hidden Charges</li>
                <li>All Access to Utilites</li>
                <li>All Access to Gym Equipments</li>
              </ul>
              <h6 class="fw-light fst-italic">*Total Cost ₱2,900</h6>
              <button type="button" class="w-100 btn btn-lg btn-primary">Purchase</button>
            </div>
          </div>
        </div>
      </div>

      <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm border-primary">
              <div class="card-header py-3 mb-3 text-warning-emphasis border-primary">
                <h4 class="my-0 fw-normal">Annually</h4>
              </div>
              <div class="card-body">
                <h1 class="card-title pricing-card-title">₱416.67<small class="text-muted fw-light">/mo</small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>Unlimited Sessions</li>
                    <li>Trainer Included</li>
                    <li>No Hidden Charges</li>
                    <li>All Access to Utilites</li>
                    <li>All Access to Gym Equipments</li>
                </ul>
                <h6 class="fw-light fst-italic">*Total Cost ₱5,000</h6>
                <button type="button" class="w-100 btn btn-lg btn-primary">Purchase</button>
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