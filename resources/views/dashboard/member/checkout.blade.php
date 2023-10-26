@extends('components.layouts.dashboard')

@section('title')
    Checkout
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

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Checkout /</span> Subscription: {{ ucfirst($arrangement_name) }}</h4>

    <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Personal Details</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('subscribe') }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label> <span class="text-danger">*</span>
                <input class="form-control" type="text" id="firstname" name="firstname" value="{{ old('firstname', ucwords(Auth::user()->firstname)) }}" autofocus />
                @error('firstname')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3">
                <label for="middlename" class="form-label">Middle Name</label>
                <input class="form-control" type="text" id="middlename" name="middlename" value="{{ old('middlename', ucwords(Auth::user()->middlename)) }}" autofocus />
                @error('middlename')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label> <span class="text-danger">*</span>
                <input class="form-control" type="text" name="lastname" id="lastname" value="{{ old('lastname', ucwords(Auth::user()->lastname)) }}" />
                @error('lastname')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3"> 
                <label for="email" class="form-label">E-mail</label> <span class="text-danger">*</span>
                <input class="form-control" type="text" id="email" name="email" value="{{ old('email', ucwords(Auth::user()->email)) }}" />
                @error('email')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
             </div>
              <div class="mb-3">
                <label class="form-label" for="phonenumber">Phone Number</label> <span class="text-danger">*</span>
                <div class="input-group input-group-merge">
                   <span class="input-group-text">PH (+63)</span>
                   <input type="text" id="phoneNumber" name="phone_number" class="form-control" value="{{ old('phone_number', ucwords(Auth::user()->phone_number)) }}" />
                </div>
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Address</label> <span class="text-danger">*</span>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', ucwords(Auth::user()->address)) }}" />
                @error('address')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                <div class="form-text">You can use letters, numbers & periods</div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="country">Country</label> <span class="text-danger">*</span>
                <select id="country" name="country" class="select2 form-select">
                   <option value="">Select</option>
                   <option selected value="Philippines">Philippines</option>
                </select>
                @error('country')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3">
                <label for="city" class="form-label">City</label> <span class="text-danger">*</span>
                <input type="text" class="form-control" id="city" name="city" value="{{ old('city', ucwords(Auth::user()->city)) }}" />
                @error('city')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3 d-none">
                <label for="tierId" class="form-label">Tier ID</label> <span class="text-danger">*</span>
                <input type="text" class="form-control" id="tierId" name="tierId" value="{{ $tier_id }}" />
              </div>
                
              {{-- Payment Option --}}
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Payment Option</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <select class="form-select" id="paymentOption" name="paymentOption">
                              <option selected value="credit card">Credit card</option>
                            </select>
                        </div>
                        <div class="card shadow-none bg-transparent border border-secondary mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="cardNumber">Card number</label> <span class="text-danger">*</span>
                                    <input type="text" class="form-control" id="cardNumber" name="cardNumver" />
                                </div>
                                <div class="mb-3">
                                    <label for="validThru">Valid thru (mm/yy)</label> <span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" name="month1" class="form-control" />
                                        <input type="text" name="month2" class="form-control" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="cvvcvc">CVV/CVC</label> <span class="text-danger">*</span>
                                    <input type="text" class="form-control" id="cvvcvc" name="cvvcvc" />
                                </div>
                                <div class="mb-3">
                                    <label for="cardHolderName">Cardholder's name</label> <span class="text-danger">*</span>
                                    <input type="text" class="form-control" id="cardHolderName" name="cardHolderName" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="d-grid gap-2">
                      <button type="submit" class="btn btn-primary btn-lg" type="button">Place Subscription</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>


      <div class="col-xl text-center">
        <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3 mb-3">
              <h4 class="my-0 fw-normal">{{ ucwords($tier->tier_name) }}</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">₱{{ ceil($tier->price) }}</h1>
              {{-- <h1 class="card-title pricing-card-title">₱1,500</h1> --}}
              <div class="divider">
                <div class="divider-text">
                  <i class="bx bx-star"></i>
                </div>
              </div>
              <ul class="list-unstyled mt-3 mb-4">
                <li>{{ $tier->duration.' Duration' }}</li>
                <li>Unlimited Sessions</li>
                <li>Trainer Included</li>
                <li>No Hidden Charges</li>
                <li>All Access to Utilites</li>
                <li>All Access to Gym Equipments</li>
              </ul>
              <div class="divider">
                <div class="divider-text">
                  <i class="bx bx-star"></i>
                </div>
              </div>
              {{-- <a href="{{ route('checkout.plan', ['subscriptionType' => $subscriptionType, 'tier_id' => $tier->id]) }}" class="w-100 btn btn-lg btn-outline-primary">Subscribe</a> --}}
            </div>
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