@extends('components.layouts.dashboard')

@section('title')
    Subscription Arrangements
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
        <div class="me-auto fw-semibold">Subscription Arrangement Update</div>
            <small>1 sec ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <span id="status-message">Null</span>
        </div>
    </div>
    <!-- Toast with Placements -->

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Subscription Arrangements</span></h4>

      <!-- Hoverable Table rows -->
      <div class="card">
         <h5 class="card-header">Arrangements</h5>
         <div class="table-responsive text-nowrap">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th>Arrangement name</th>
                     <th>Countdown</th>
                     <th>Start Date</th>
                     <th>End Date</th>
                     <th>Status</th>
                     <th>Actions</th>
                  </tr>
               </thead>
               <tbody class="table-border-bottom-0">
                  @foreach ($subscriptionArrangements as $arrangement)
                     <tr class="arrangement-row-{{ $arrangement->id }}">
                        <td>{{ ucwords($arrangement->arrangement_name) }}</td>
                        <td>
                            <div class="dropdown position-static">
                                <button type="button" id="countdownToggleBtn{{ $arrangement->id }}" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    @if($arrangement->countdown == 'active')
                                        <span class="badge bg-label-success me-1">Active</span>
                                    @elseif($arrangement->countdown == 'disabled')
                                        <span class="badge bg-label-warning me-1">Disabled</span>
                                    @endif
                                </button>
                                <div class="dropdown-menu position-absolute">
                                    <a class="dropdown-item cursor-pointer countdown-status-item" data-status="active" data-arrangement="{{$arrangement->id}}" data-route-url="{{ route('toggleArrCountdown') }}"><span class="badge bg-label-success me-1">Active</span></a>
                                    <a class="dropdown-item cursor-pointer countdown-status-item" data-status="disabled" data-arrangement="{{$arrangement->id}}" data-route-url="{{ route('toggleArrCountdown') }}"><span class="badge bg-label-warning me-1">Disabled</span></a>
                                </div>
                            </div>
                        </td>
                        @if($arrangement->start_date && $arrangement->end_date)
                            <td>{{ \Carbon\Carbon::parse($arrangement->start_date) }}</td>
                            <td>{{ \Carbon\Carbon::parse($arrangement->end_date) }}</td>
                        @else 
                            <td>N/A</td>
                            <td>N/A</td>
                        @endif
                        <td>
                            <div class="dropdown position-static">
                                <button type="button" id="statusBtn{{ $arrangement->id }}" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    @if($arrangement->status == 'active')
                                        <span class="badge bg-label-success me-1">Active</span>
                                    @elseif($arrangement->status == 'disabled')
                                        <span class="badge bg-label-warning me-1">Disabled</span>
                                    @endif
                                </button>
                                <div class="dropdown-menu position-absolute">
                                    <a class="dropdown-item cursor-pointer status-item" data-status="active" data-arrangement="{{$arrangement->id}}" data-route-url="{{ route('toggleArrStatus') }}"><span class="badge bg-label-success me-1">Active</span></a>
                                    <a class="dropdown-item cursor-pointer status-item" data-status="disabled" data-arrangement="{{$arrangement->id}}" data-route-url="{{ route('toggleArrStatus') }}"><span class="badge bg-label-warning me-1">Disabled</span></a>
                                </div>
                            </div>                               
                        </td>
                        <td>
                            <div class="dropdown position-static">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu position-absolute">
                                    <button class="dropdown-item cursor-pointer"><i class="bx bx-edit"></i> Edit Arrangement</button>
                                    <button class="dropdown-item cursor-pointer"><i class="bx bx-plus"></i> Add New Tier</button>
                                    <a class="dropdown-item cursor-pointer"><i class="bx bx-trash"></i> Delete Arrangement</a>
                                    <a class="dropdown-item cursor-pointer" target="_blank"><i class="bx bx-show me-2"></i> View Arrangement</a>
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
                   @if ($subscriptionArrangements->onFirstPage())
                       <li class="page-item disabled">
                           <a class="page-link" href="javascript:void(0);">
                               Previous
                           </a>
                       </li>
                   @else
                       <li class="page-item">
                           <a class="page-link" href="{{ $subscriptionArrangements->previousPageUrl() }}">
                               Previous
                           </a>
                       </li>
                   @endif
           
                   <!-- Number of Pages -->
                   @for ($i = 1; $i <= $subscriptionArrangements->lastPage(); $i++)
                       <li class="page-item {{ $i == $subscriptionArrangements->currentPage() ? 'active' : '' }}">
                           <a class="page-link" href="{{ $subscriptionArrangements->url($i) }}">{{ $i }}</a>
                       </li>
                   @endfor
           
                   <!-- Next Page Link -->
                   @if ($subscriptionArrangements->hasMorePages())
                       <li class="page-item">
                           <a class="page-link" href="{{ $subscriptionArrangements->nextPageUrl() }}">
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
<script src="{{ asset('storage/assets/js/custom/subscription-arrangement.js')}} "></script>
@endsection