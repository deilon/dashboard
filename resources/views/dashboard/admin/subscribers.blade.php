@extends('components.layouts.dashboard')

@section('title')
    Gym Subscribers
@endsection

@section('sidebar')
    <x-sidebar/>
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
        <div class="me-auto fw-semibold">Subscription update</div>
            <small>1 sec ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <span id="status-message">Null</span>
        </div>
    </div>
    <!-- Toast with Placements -->

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Users Records /</span> Subscribers</h4>

      <!-- Hoverable Table rows -->
      <div class="card">
         <h5 class="card-header">Users Records</h5>
         <div class="table-responsive text-nowrap">
            <div class="row mb-4 mx-2">
                <div class="col border-top border-bottom">
                    <div class="text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                        <div class="py-3">
                            <label>
                                <input type="search" class="form-control" placeholder="Search..">
                            </label>
                        </div>
                        <div class="py-3"> 
                            <button class="btn btn-secondary mx-3" tabindex="0" type="button">
                                <span><i class="bx bx-export me-1"></i>Export</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th>User</th>
                     <th>Arrangement</th>
                     <th>Tier</th>
                     <th>Payment Option</th>
                     <th>Status</th>
                     <th>Trainer</th>
                     <th>Actions</th>
                  </tr>
               </thead>
               <tbody class="table-border-bottom-0">
                  @foreach ($subscriptions as $subscription)
                    <tr class="subscription-record-row-{{ $subscription->id }}">
                        <td>
                            <div class="d-flex justify-content-start align-items-center user-name">
                                <div class="avatar-wrapper">
                                    <div class="avatar avatar-sm me-3">
                                        <img src="{{ $subscription->user->photo ? asset('storage/assets/img/avatars/'. $subscription->user->photo) : asset('storage/assets/img/avatars/default.jpg') }}" alt="Avatar" class="rounded-circle">
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <a href="{{ url('admin/view-profile/'.$subscription->user->id) }}" class="text-body text-truncate">
                                        <span class="fw-medium">{{ ucwords($subscription->user->firstname.' '.$subscription->user->lastname) }}</span>
                                    </a>
                                    <small class="text-muted">{{ $subscription->user->email }}</small>
                                </div>
                             </div>
                        </td>
                        <td>{{ ucwords($subscription->subscriptionArrangement->arrangement_name) }}</td>
                        <td>{{ ucwords($subscription->subscriptionTier->tier_name) }}</td>
                        <td>{{ ucwords($subscription->payment_option) }}</td>
                        <td>
                            <div class="dropdown position-static">
                                <button type="button" id="statusBtn{{ $subscription->id }}" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    @if($subscription->status == 'active')
                                        <span class="badge bg-label-success me-1">Active</span>
                                    @elseif($subscription->status == 'pending')
                                        <span class="badge bg-label-warning me-1">Pending</span>
                                    @endif
                                </button>
                                <div class="dropdown-menu position-absolute">
                                    <a class="dropdown-item cursor-pointer status-item" data-status="active" data-subscription-id="{{ $subscription->id }}" data-subscriber-id="{{ $subscription->user->id }}" data-route-url="{{ route('update-sub-status') }}"><span class="badge bg-label-success me-1">Active</span></a>
                                    <a class="dropdown-item cursor-pointer status-item" data-status="pending" data-subscription-id="{{ $subscription->id }}" data-subscriber-id="{{ $subscription->user->id }}" data-route-url="{{ route('update-sub-status') }}"><span class="badge bg-label-warning me-1">Pending</span></a>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <div  class="d-flex">
                                <ul id="trainerList{{ $subscription->id }}" class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                    @php
                                        $staff = App\Models\User::find($subscription->staff_assigned_id);
                                    @endphp
                                    @if($subscription->staff_assigned_id)
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="{{ ucwords($staff->firstname.' '.$staff->lastname) }}"> <img src="{{ $staff->photo ? asset('storage/assets/img/avatars/'. $staff->photo) : asset('storage/assets/img/avatars/default.jpg') }}" alt="Avatar" class="rounded-circle" /></li>
                                    @else
                                        <li></li>
                                    @endif
                                </ul>
                                <button class="btn btn-sm btn-icon" data-bs-toggle="modal" data-bs-target="#addTrainerModal{{ $subscription->id }}"><i class="bx bx-edit"></i></button>
                            </div>
                        </td>
                        <td>
                            <div class="d-inline-block text-nowrap">
                                <a class="btn btn-sm btn-icon delete-subscription-btn" data-subscription-id="{{ $subscription->id }}" data-route-url="{{ url('admin/delete-subscription/'.$subscription->id) }}"><i class="bx bx-trash"></i></a>
                                <a href="{{ url('admin/view-subscription/'.$subscription->user->id) }}" class="btn btn-sm btn-icon" target="_blank"><i class="bx bx-show me-2"></i></a>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal: Add Trainer -->
                    <div class="modal fade" id="addTrainerModal{{ $subscription->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-sm modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Trainer / Staff</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">
                                            <p class="fs-6">For: <span class="fw-bold">{{ ucwords($subscription->user->firstname.' '.$subscription->user->lastname) }}</span></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <div class="form-check mt-3" id="inputUniqueness{{ $subscription->id }}">
                                                @foreach($staffs as $staff)
                                                <div class="d-flex justify-content-start align-items-center py-2 user-name">
                                                    <input name="staff" class="form-check-input me-3" type="radio" value="{{ $staff->id }}" {{ $staff->id == $subscription->staff_assigned_id ? 'checked' : '' }} id="trainerSelect{{ $staff->id }}"/>
                                                    <label for="trainerSelect{{ $staff->id }}" class="d-flex justify-content-start align-items-center">
                                                        <div class="avatar-wrapper">
                                                            <div class="avatar avatar-sm me-3">
                                                                <img src="{{ $staff->photo ? asset('storage/assets/img/avatars/'. $staff->photo) : asset('storage/assets/img/avatars/default.jpg') }}" alt="Avatar" class="rounded-circle">
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <span class="text-body text-truncate">
                                                                <span class="fw-medium">{{ ucwords($staff->firstname.' '.$staff->lastname) }}</span>
                                                            </span>
                                                            <small class="text-muted">{{ $staff->email }}</small>
                                                        </div>
                                                    </label>
                                                 </div>
                                                 @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-sm btn-danger remove-trainer-btn" data-modal-id="{{ $subscription->id }}" data-subscriber-id="{{ $subscription->user->id }}" data-route-url="{{ route('remove-trainer') }}">Remove Trainer</button>
                                    <button type="button" class="btn btn-sm btn-primary add-trainer-btn" data-modal-id="{{ $subscription->id }}" data-subscriber-id="{{ $subscription->user->id }}" data-route-url="{{ route('update-trainer') }}">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Modal: Assign Trainer -->

                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
      <!--/ Hoverable Table rows -->

      <div class="card bg-transparent shadow-none px-5 mt-3">
         <div class="demo-inline-spacing">
            <!-- Basic Pagination -->
            <nav aria-label="Page navigation">
               <ul class="pagination justify-content-end">
                   <!-- Previous Page Link -->
                   @if ($subscriptions->onFirstPage())
                       <li class="page-item disabled">
                           <a class="page-link" href="javascript:void(0);">
                               Previous
                           </a>
                       </li>
                   @else
                       <li class="page-item">
                           <a class="page-link" href="{{ $subscriptions->previousPageUrl() }}">
                               Previous
                           </a>
                       </li>
                   @endif
           
                   <!-- Number of Pages -->
                   @for ($i = 1; $i <= $subscriptions->lastPage(); $i++)
                       <li class="page-item {{ $i == $subscriptions->currentPage() ? 'active' : '' }}">
                           <a class="page-link" href="{{ $subscriptions->url($i) }}">{{ $i }}</a>
                       </li>
                   @endfor
           
                   <!-- Next Page Link -->
                   @if ($subscriptions->hasMorePages())
                       <li class="page-item">
                           <a class="page-link" href="{{ $subscriptions->nextPageUrl() }}">
                               Next
                           </a>
                       </li>
                   @else
                       <li class="page-item disabled">
                           <a class="page-link" href="javascript:void(0);">
                               Next
                           </a>
                       </li>
                   @endif
               </ul>
           </nav>
            <!--/ Basic Pagination -->
          </div>
      </div>

</div>
<!-- / Content -->
@endsection

@section('page-js')
<script src="{{ asset('storage/assets/js/dashboards-analytics.js') }}"></script>
<script src="{{ asset('storage/assets/js/ui-toasts.js')}} "></script>
<script src="{{ asset('storage/assets/js/ui-modals.js') }}"></script>
<script src="{{ asset('storage/assets/js/custom/subscribers-records.js')}} "></script>
@endsection