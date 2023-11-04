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
        <div class="me-auto fw-semibold">User update</div>
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
                            <button class="btn btn-primary" tabindex="0" type="button">
                                <span>
                                    <i class="bx bx-plus me-0 me-sm-1"></i>
                                    <span class="d-none d-sm-inline-block">Add New User</span>
                                </span>
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
                     <th>Actions</th>
                  </tr>
               </thead>
               <tbody class="table-border-bottom-0">
                  @foreach ($subscriptions as $subscription)
                    <tr>
                        <td>
                            <div class="d-flex justify-content-start align-items-center user-name">
                                <div class="avatar-wrapper"><div class="avatar avatar-sm me-3">
                                    <img src="{{ $subscription->user->photo ? asset('storage/assets/img/avatars/'. $subscription->user->photo) : asset('storage/assets/img/avatars/default.jpg') }}" alt="Avatar" class="rounded-circle">
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <a href="app-user-view-account.html" class="text-body text-truncate">
                                    <span class="fw-medium">{{ ucwords($subscription->user->firstname.' '.$subscription->user->lastname) }}</span>
                                </a>
                                <small class="text-muted">{{ $subscription->user->email }}</small>
                            </div>
                        </td>
                        <td>{{ ucwords($subscription->subscriptionArrangement->arrangement_name) }}</td>
                        <td>{{ ucwords($subscription->subscriptionTier->tier_name) }}</td>
                        <td>{{ ucwords($subscription->payment_option) }}</td>
                        <td>
                            @if($subscription->status == 'active')
                                <span class="badge bg-label-success me-1">Active</span>
                            @elseif($subscription->status == 'pending')
                                <span class="badge bg-label-warning me-1">Pending</span>
                            @elseif($subscription->status == 'expired')
                                <span class="badge bg-label-danger me-1">Expired</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-inline-block text-nowrap">
                                <button class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button>
                                <button class="btn btn-sm btn-icon delete-record"><i class="bx bx-trash"></i></button>
                                <button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded me-2"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end m-0" style="">
                                    <a href="app-user-view-account.html" class="dropdown-item"><i class="bx bx-show me-2"></i> View</a>
                                    {{-- <a href="javascript:;" class="dropdown-item">Suspend</a> --}}
                                </div>
                            </div>                     
                        </td>
                    </tr>
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
<script src="{{ asset('storage/assets/js/custom/users-records.js')}} "></script>
@endsection