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
    
    @if($subscriptionArrangement->countdown === 'active')
      <!-- Display the countdown timer -->
      <div id="countdown" class="alert alert-success text-center fs-3" role="alert"></div>
    @endif

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
              @if($subscriptionArrangement->promo == 'yes')
                @php
                  $basedArrangement = App\Models\SubscriptionArrangement::find(1);
                  $regularTier = App\Models\SubscriptionTier::where('subscription_arrangement_id', $basedArrangement->id)->where('duration', $tier->duration)->first();
                @endphp
                <s class="text-gray"><h4 class="card-title pricing-card-title text-muted">₱{{ ceil($regularTier->price) }}</h4></s>
              @endif
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

@if ($subscriptionArrangement->countdown === 'active')
  <script>
    // Get the start and end dates from Blade (replace with your actual Blade variables)
    var startDate = new Date("{{ $subscriptionArrangement->start_date }}");
    var endDate = new Date("{{ $subscriptionArrangement->end_date }}");

    // Function to update the countdown display
    function updateCountdown() {
        // Get the current date and time
        var now = new Date();

        // Calculate the time difference between now and the end date
        var timeDifference = endDate - now;

        // Check if the countdown has reached zero or is negative
        if (timeDifference <= 0) {
            // Stop the countdown and update the display
            clearInterval(countdownInterval);
            $("#countdown").html("Countdown expired!");
        } else {
            // Calculate days, hours, minutes, and seconds
            var days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
            var hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

            // Update the countdown display
            $("#countdown").html("<span class='fw-bold'>{{ ucwords($subscriptionArrangement->arrangement_name) }}</span> Ends in " + days + "d " + hours + "h " + minutes + "m " + seconds + "s");
        }
    }

    // Update the countdown every second
    var countdownInterval = setInterval(updateCountdown, 1000);
  </script>
@endif

@endsection