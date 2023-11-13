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

    @if(session('error'))
    <div class="row">
        <div class="col-md">
            <div class="alert alert-danger alert-dismissible" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif

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
            <div class="row mb-4 mx-2">
                <div class="col border-top border-bottom">
                    <div class="text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                        <div class="py-3">
                            <label>
                                <input type="search" class="form-control" placeholder="Search..">
                            </label>
                        </div>
                        <div class="py-3 ms-3"> 
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewArrangement" tabindex="0" type="button">
                                <span>
                                    <i class="bx bx-plus me-0 me-sm-1"></i>
                                    <span class="d-none d-sm-inline-block">Add New Arrangement</span>
                                </span>
                            </button> 
                        </div>
                    </div>
                </div>
            </div>
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
                            <td>{{ \Carbon\Carbon::parse($arrangement->start_date)->format('M d, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($arrangement->end_date)->format('M d, Y') }}</td>
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
                                    <a class="dropdown-item cursor-pointer status-item" data-status="active" data-arrangement="{{ $arrangement->id }}" data-route-url="{{ route('toggleArrStatus') }}"><span class="badge bg-label-success me-1">Active</span></a>
                                    <a class="dropdown-item cursor-pointer status-item" data-status="disabled" data-arrangement="{{ $arrangement->id }}" data-route-url="{{ route('toggleArrStatus') }}"><span class="badge bg-label-warning me-1">Disabled</span></span></a>
                                </div>
                            </div>                               
                        </td>
                        <td>
                            <div class="dropdown position-static">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu position-absolute">
                                    <button class="dropdown-item cursor-pointer" data-bs-toggle="modal" data-bs-target="#arrangementEditModal{{ $arrangement->id }}"><i class="bx bx-edit"></i> Edit Arrangement</button>
                                    <a class="dropdown-item cursor-pointer"><i class="bx bx-trash"></i> Delete Arrangement</a>
                                    <a href="{{ url('admin/packages/sub-plan/'.$arrangement->id) }}" class="dropdown-item cursor-pointer" target="_blank"><i class="bx bx-cog me-2"></i> Manage Arrangement</a>
                                </div>
                             </div>
                        </td>
                     </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="arrangementEditModal{{ $arrangement->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="{{ route('updateArrangement') }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit "{{ ucwords($arrangement->arrangement_name) }}" arrangement</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="arrangementName" class="form-label">Arrangement Name</label>
                                                <input type="text" id="arrangementName" class="form-control" name="arrangement_name" placeholder="{{ $arrangement->arrangement_name }}" value="{{ old('arrangement_name', ucwords($arrangement->arrangement_name)) }}"  />
                                                @error('arrangement_name')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col mb-0">
                                                <label for="editStartDate" class="col-md-2 col-form-label">Start Date</label>
                                                <div class="col-md-10">
                                                  <input class="form-control" type="date" name="start_date" value="{{ old('start_date', $arrangement->start_date) }}" id="editStartDate" />
                                                  @error('start_date')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                                                </div>
                                            </div>
                                            <div class="col mb-3">
                                                <label for="html5-date-input" class="col-md-2 col-form-label">End Date</label>
                                                <div class="col-md-10">
                                                  <input class="form-control" type="date" name="end_date" value="{{ old('end_date', $arrangement->end_date) }}" id="editEndDate" />
                                                  <input class="form-control" type="hidden" name="arrangement_id" value="{{ $arrangement->id }}"/>
                                                  @error('end_date')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                                                </div>
                                            </div>
                                        </div>
                                        @if($arrangement->default != "yes")
                                        <div class="row g-2">
                                            <div class="col">
                                                <div class="form-check form-check-inline mt-3">
                                                <input class="form-check-input" type="checkbox" id="promo" name="promo" value="yes" {{ $arrangement->promo == 'yes' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="promo">Mark as promo</label>
                                                </div>
                                                <div class="alert alert-warning mt-2" role="alert"><i class="menu-icon tf-icons bx bx-info-circle"></i>Mark as promo will show previous based prices (regular).</div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
      <!--/ Hoverable Table rows -->

        <!-- Create Modal -->
        <div class="modal fade" id="addNewArrangement" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('addArrangement') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Add new arrangement</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="addArrangementName" class="form-label">Arrangement Name</label>
                                    <input type="text" id="addArrangementName" name="arrangement_name" class="form-control" placeholder="Arrangement name" value="{{ old('arrangement_name') }}"/>
                                </div>
                                @error('arrangement_name')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                            </div>
                            <div class="row g-2">
                                <div class="col mb-0">
                                    <label for="addStartDate" class="col-md-2 col-form-label">Start Date</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="start_date" type="date" id="addStartDate" value="{{ old('start_date') }}" />
                                    </div>
                                    @error('start_date')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                                </div>
                                <div class="col mb-0">
                                    <label for="addEndDate" class="col-md-2 col-form-label">End Date</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="end_date" type="date" id="addEndDate" value="{{ old('end_date') }}" />
                                    </div>
                                    @error('end_date')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col">
                                    <div class="form-check form-check-inline mt-3">
                                    <input class="form-check-input" type="checkbox" id="promo" name="promo" value="yes">
                                        <label class="form-check-label" for="promo">Mark as promo</label>
                                    </div>
                                    <div class="alert alert-warning mt-2" role="alert"><i class="menu-icon tf-icons bx bx-info-circle"></i>Mark as promo will show previous based prices (regular).</div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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
<script src="{{ asset('storage/assets/js/ui-modals.js') }}"></script>
<script src="{{ asset('storage/assets/js/custom/subscription-arrangement.js')}} "></script>
@endsection