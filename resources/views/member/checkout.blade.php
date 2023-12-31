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
      @if ($errors->any())
      <div class="row">
        <div class="col-md">
           <div class="alert alert-danger alert-dismissible" role="alert">
            Some input fields values are incorrect. Please check
           </div>
        </div>
     </div>
      @endif
  

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Checkout /</span> Subscription: {{ ucfirst($subscription_arrangement->arrangement_name) }}</h4>

    <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Personal Details</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('subscribe') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label> <span class="text-danger">*</span>
                <input class="form-control" type="text" id="firstname" name="firstname" value="{{ old('firstname', ucwords(Auth::user()->firstname)) }}" autofocus required />
                @error('firstname')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3">
                <label for="middlename" class="form-label">Middle Name</label>
                <input class="form-control" type="text" id="middlename" name="middlename" value="{{ old('middlename', ucwords(Auth::user()->middlename)) }}" autofocus />
                @error('middlename')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label> <span class="text-danger">*</span>
                <input class="form-control" type="text" name="lastname" id="lastname" value="{{ old('lastname', ucwords(Auth::user()->lastname)) }}" required />
                @error('lastname')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3"> 
                <label for="email" class="form-label">E-mail</label> <span class="text-danger">*</span>
                <input class="form-control" type="text" id="email" name="email" value="{{ old('email', ucwords(Auth::user()->email)) }}" required />
                @error('email')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
             </div>
              <div class="mb-3">
                <label class="form-label" for="phonenumber">Phone Number</label> <span class="text-danger">*</span>
                <div class="input-group input-group-merge">
                   <span class="input-group-text">PH (+63)</span>
                   <input type="text" id="phoneNumber" name="phone_number" class="form-control" value="{{ old('phone_number', ucwords(Auth::user()->phone_number)) }}" required />
                </div>
                @error('phone_number')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Address</label> <span class="text-danger">*</span>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', ucwords(Auth::user()->address)) }}" required />
                @error('address')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                <div class="form-text">You can use letters, numbers & periods</div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="country">Country</label> <span class="text-danger">*</span>
                <select id="country" name="country" class="select2 form-select" required>
                   <option value="">Select</option>
                   <option selected value="Philippines">Philippines</option>
                </select>
                @error('country')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3">
                <label for="city" class="form-label">City</label> <span class="text-danger">*</span>
                <input type="text" class="form-control" id="city" name="city" value="{{ old('city', ucwords(Auth::user()->city)) }}" required />
                @error('city')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3 d-none">
                <label for="tierId" class="form-label">Tier ID</label> <span class="text-danger">*</span>
                <input type="text" class="form-control" id="tierId" name="tierId" value="{{ $tier_id }}" required />
              </div>
              <div class="mb-3 d-none">
                <label for="subscriptionArrangementId" class="form-label">Tier ID</label> <span class="text-danger">*</span>
                <input type="text" class="form-control" id="subscriptionArrangementId" name="subscriptionArrangementId" value="{{ $subscription_arrangement->id }}" required />
              </div>
                
              {{-- Payment Option --}}
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Payment Option</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <select class="form-select" id="paymentOption" name="paymentOption" required>
                              <option value="credit card" selected>Credit card</option>
                              <option value="gcash">Gcash</option>
                              <option value="manual payment">Manual Payment</option>
                            </select>
                        </div>
                        <div id="creditCard" class="card shadow-none bg-transparent border border-secondary mb-3 payment-content">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="cardNumber">Card number</label> <span class="text-danger">*</span>
                                    <input type="text" class="form-control" id="cardNumber" name="cardNumber" value="{{ old('cardNumber') }}" />
                                    @error('cardNumber')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="validThru">Valid thru (mm/yy)</label> <span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" name="month" class="form-control" value="{{ old('month') }}" />
                                        <input type="text" name="year" class="form-control" value="{{ old('year') }}" />
                                    </div>
                                    @error('month')<div class="text-danger d-block pt-2">{{ $message }}</div>@enderror
                                    @error('year')<div class="text-danger d-block pt-2">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="cvv_cvc">CVV/CVC</label> <span class="text-danger">*</span>
                                    <input type="text" class="form-control" id="cvv_cvc" name="cvv_cvc" value="{{ old('cvv_cvc') }}" />
                                    @error('cvv_cvc')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="cardHolderName">Cardholder's name</label> <span class="text-danger">*</span>
                                    <input type="text" class="form-control" id="cardHolderName" name="cardHolderName" value="{{ old('cardHolderName') }}" />
                                    @error('cardHolderName')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div id="gcash" class="card shadow-none bg-transparent border border-secondary mb-3 payment-content d-none">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="mobileNumber">Mobile/Gcash number</label> <span class="text-danger">*</span>
                                    <input type="text" class="form-control" id="mobileNumber" name="mobile_number" value="{{ old('mobile_number') }}" />
                                    @error('mobile_number')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                  <label for="amount">Amount</label> <span class="text-danger">*</span>
                                  <div class="input-group input-group-merge">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" class="form-control" placeholder="100" id="amount" name="amount" value="{{ old('amount') }}" aria-label="Amount (to the nearest peso)" />
                                    <span class="input-group-text">.00</span>
                                  </div>
                                  @error('amount')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                  <label for="gCashFile" class="form-label">Upload your Gcash Receipt or Proof of Payment <span class="text-danger">*</span></label>
                                  <input class="form-control" type="file" id="gCashFile" name="gCashFile" value="{{ old('gCashFile') }}" />
                                  @error('gCashFile')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div id="manualPayment" class="card shadow-none bg-transparent border border-secondary mb-3 payment-content d-none">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="fullName">Full Name</label> <span class="text-danger">*</span>
                                    <input type="text" class="form-control" id="fullName" name="fullName" value="{{ old('fullName') }}" />
                                    @error('fullName')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                  <label for="manualPaymentAmount">Amount</label> <span class="text-danger">*</span>
                                  <div class="input-group input-group-merge">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" class="form-control" placeholder="100" id="manualPaymentAmount" name="manual_payment_amount" value="{{ old('manual_payment_amount') }}" aria-label="Amount (to the nearest peso)" />
                                    <span class="input-group-text">.00</span>
                                  </div>
                                  @error('manual_payment_amount')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
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
<script>
  $(document).ready(function() {
      // Check local storage for the selected payment option
      var selectedOption = localStorage.getItem('selected_payment_option');

      // If a selection is found, set the select element to that value
      if (selectedOption) {
          $('#paymentOption').val(selectedOption);

          // Show the content div corresponding to the selected option
          if(selectedOption == 'creditCard') {
            $('#creditCard').removeClass('d-none');
            $('#gcash').addClass('d-none');
            $('#manualPayment').addClass('d-none');
          } else if (selectedOption == 'gcash') {
            $('#creditCard').addClass('d-none');
            $('#gcash').removeClass('d-none');
            $('#manualPayment').addClass('d-none');
          } else {
            $('#creditCard').addClass('d-none');
            $('#gcash').addClass('d-none');
            $('#manualPayment').removeClass('d-none');
          }

      }

      // Listen for changes in the selected payment option
      $('#paymentOption').change(function() {
          // Get the selected option
          var selectedOption = toCamelCase($(this).val());

          // Store the selected option in local storage
          localStorage.setItem('selected_payment_option', selectedOption);
          
          // Hide all content divs
          $('.payment-content').addClass('d-none');
          
          // Show the content div corresponding to the selected option
          $('#' + selectedOption).removeClass('d-none');
      });

      function toCamelCase(str) {
        return str.replace(/(?:^\w|[A-Z]|\b\w)/g, function(word, index) {
            return index === 0 ? word.toLowerCase() : word.toUpperCase();
        }).replace(/\s+/g, '');
      }
  });
</script>
@endsection