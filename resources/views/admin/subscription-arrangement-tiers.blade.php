@extends('components.layouts.dashboard')

@section('title')
    Subscription Packages
@endsection
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('storage/assets/css/pricing.css') }}" />
@endsection

@section('admin-sidebar')
    <x-admin-sidebar/>
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
        <div class="me-auto fw-semibold">User update</div>
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


    <h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ $arrangement->arrangement_name }} /</span> Packages </h4>

    <div class="row">
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card text-center">
              <div class="card-header"><i class='fs-2 bx bx-package'></i></div>
              <div class="card-body">
                <h5 class="card-title">Create Packages for <span class="fw-bold">{{ $arrangement->arrangement_name }}</span></h5>
                <p class="card-text">Set and update prices, packages name </p>
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#createTierModal">Create</button>
              </div>
            </div>
        </div>
    </div>
    @if($arrangement->subscriptionTiers->count() > 0)
        <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
            @foreach($tiers as $tier)
            <div class="col" id="tierItem{{ $tier->id }}">
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
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="button" type="button" data-bs-toggle="modal" data-bs-target="#editTierModal{{ $tier->id }}">Edit</button>
                        <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteTierModal{{ $tier->id }}">Delete</button>
                    </div>
                  </div>
                </div>
            </div>


            <!-- Edit Modal -->
            <div class="modal fade" id="editTierModal{{ $tier->id }}" tabindex="-1" aria-hidden="true">
                <form action="{{ route('update.package') }}" method="POST">
                    @csrf
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Package: {{ ucfirst($tier->tier_name) }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="tier_name" class="form-label">Package Name</label> <span class="text-danger">*</span>
                                        <input type="text" id="tier_name" name="tier_name" class="form-control" placeholder="Enter Name of the Package" value="{{ old('tier_name', ucfirst($tier->tier_name)) }}" />
                                        @error('tier_name')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="duration" class="form-label">Duration</label> <span class="text-danger">*</span>
                                        <select id="duration" name="duration" class="select2 form-select" required>
                                            <option {{ $tier->duration == '2 Months' ? 'selected' : '' }} value="2 Months">2 Months</option>
                                            <option {{ $tier->duration == '3 Months' ? 'selected' : '' }} value="3 Months">3 Months</option>
                                            <option {{ $tier->duration == '6 Months' ? 'selected' : '' }} value="6 Months">6 Months</option>
                                            <option {{ $tier->duration == '12 Months' ? 'selected' : '' }} value="12 Months">12 Months</option>
                                         </select>
                                         @error('duration')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="price" class="form-label">Price</label> <span class="text-danger">*</span>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text">₱</span>
                                            <input type="text" class="form-control" placeholder="100" id="price" name="price" value="{{ old('price', $tier->price) }}" aria-label="Amount (to the nearest peso)" />
                                            <span class="input-group-text">.00</span>
                                        </div>
                                        @error('price')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="row d-none">
                                    <input type="hidden" name="tierId" value="{{ $tier->id }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="deleteTierModal{{ $tier->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete Package </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-text">Are you sure you want to delete "<span class="fw-bold">{{ ucfirst($tier->tier_name) }}</span>" ?</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger delete-tier-btn" data-tier="{{ $tier->id }}" data-route-url="{{ url('admin/package/delete/'.$tier->id) }}">Delete</button>
                        </div>
                    </div>
                </div>
            </div>


            @endforeach
        </div>
    @endif


    <!-- Create Modal -->
    <div class="modal fade" id="createTierModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('create.package') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Create Package for <span class="fw-bold">{{ ucwords($arrangement->arrangement_name) }}</span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="tierName" class="form-label">Package Name</label> <span class="text-danger">*</span>
                                <input type="text" id="tierName" name="tier_name" class="form-control" placeholder="Enter Name of the Package" value="{{ old('tier_name') }}" />
                                @error('tier_name')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="durationCreate" class="form-label">Duration</label> <span class="text-danger">*</span>
                                <select id="durationCreate" name="duration" class="select2 form-select" required>
                                    <option selected value="">Select Duration</option>
                                    <option value="2 Months">2 Months</option>
                                    <option value="3 Months">3 Months</option>
                                    <option value="6 Months">6 Months</option>
                                    <option value="12 Months">12 Months</option>
                                 </select>
                                 @error('duration')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="priceCreate" class="form-label">Price</label> <span class="text-danger">*</span>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" class="form-control" placeholder="100" id="priceCreate" name="price" value="{{ old('price') }}" aria-label="Amount (to the nearest peso)" />
                                    <span class="input-group-text">.00</span>
                                </div>
                                @error('price')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row d-none">
                            <input type="hidden" name="arrangement_id" value="{{ $arrangement->id }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
 <!-- / Content -->
@endsection

@section('page-js')
<script src="{{ asset('storage/assets/js/ui-toasts.js')}} "></script>
<script src="{{ asset('storage/assets/js/ui-modals.js') }}"></script>
<script src="{{ asset('storage/assets/js/custom/subscription-tier.js') }}"></script>
@endsection