@extends('components.layouts.dashboard')

@section('title')
    Admin Records
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
        <div class="me-auto fw-semibold">Admin update</div>
            <small>1 sec ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <span id="status-message">Null</span>
        </div>
    </div>
    <!-- Toast with Placements -->

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Users Records /</span> Admin</h4>

      <!-- Hoverable Table rows -->
      <div class="card">
         <h5 class="card-header">Admin Records</h5>
         <div class="table-responsive text-nowrap">
            {{-- <div class="row mb-4 mx-2">
                <div class="col border-top border-bottom">
                    <div class="text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                        <div class="py-3">
                            <label>
                                <input type="search" class="form-control" id="searchAdmin" name="searchAdmin" placeholder="Search..">
                            </label>
                        </div>
                        <div class="py-3"> 
                            <button class="btn btn-secondary mx-3" tabindex="0" type="button">
                                <span><i class="bx bx-export me-1"></i>Export</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div> --}}
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th>{{ ucfirst($role) }}</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Role</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody class="table-border-bottom-0" id="allData">
                  @foreach ($users as $user)
                     <tr class="user-record-row-{{ $user->id }}">
                        <td><img src="{{ $user->photo ? asset('storage/assets/img/avatars/'. $user->photo) : asset('storage/assets/img/avatars/default.jpg') }}" class="rounded" width="25" height="25" alt="user photo"></td>
                        <td>{{ ucwords($user->firstname.' '.$user->lastname) }}</td>
                        <td><a class="link-opacity-100" href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                        <td>{{ $user->role }}</td>
                        {{-- <td><span class="badge bg-label-primary me-1">Active</span></td> --}}
                        <td>
                            <div class="dropdown position-static">
                                <button type="button" id="statusBtn{{ $user->id }}" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    @if($user->status == 'active')
                                        <span class="badge bg-label-success me-1">Active</span>
                                    @elseif($user->status == 'inactive')
                                        <span class="badge bg-label-warning me-1">Inactive</span>
                                    @elseif($user->status == 'disabled')
                                        <span class="badge bg-label-secondary me-1">Disabled</span>
                                    @else
                                        <span class="badge bg-label-danger me-1">Suspended</span>
                                    @endif
                                </button>
                                <div class="dropdown-menu position-absolute">
                                    <a class="dropdown-item cursor-pointer status-item" data-status="active" data-user="{{$user->id}}" data-route-url="{{ route('update-status') }}"><span class="badge bg-label-success me-1">Active</span></a>
                                    @if(Auth::user()->id != $user->id && $role != 'admin')
                                        <a class="dropdown-item cursor-pointer status-item" data-status="inactive" data-user="{{$user->id}}" data-route-url="{{ route('update-status') }}"><span class="badge bg-label-warning me-1">Inactive</span></a>
                                        <a class="dropdown-item cursor-pointer status-item" data-status="disabled" data-user="{{$user->id}}" data-route-url="{{ route('update-status') }}"><span class="badge bg-label-secondary me-1">Disabled</span></a>
                                    @endif
                                </div>
                            </div>                               
                        </td>
                        <td>
                           <div class="dropdown position-static">
                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                              <div class="dropdown-menu position-absolute">
                                 <a class="dropdown-item" href="{{ url('admin/view-profile/'.$user->id) }}">View</a>
                                 @if(Auth::user()->id != $user->id && $role != 'admin')
                                    <a class="dropdown-item cursor-pointer suspend-user" data-status="suspended" data-user="{{ $user->id }}" data-route-url="{{ route('update-status') }}">Suspend</a>
                                    <a class="dropdown-item cursor-pointer delete-user-btn" data-user="{{ $user->id }}" data-route-url="{{ url('admin/delete-user/'.$user->id) }}">Delete</a>
                                 @endif
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
                   @if ($users->onFirstPage())
                       <li class="page-item disabled">
                           <a class="page-link" href="javascript:void(0);">
                               Previous
                           </a>
                       </li>
                   @else
                       <li class="page-item">
                           <a class="page-link" href="{{ $users->previousPageUrl() }}">
                               Previous
                           </a>
                       </li>
                   @endif
           
                   <!-- Number of Pages -->
                   @for ($i = 1; $i <= $users->lastPage(); $i++)
                       <li class="page-item {{ $i == $users->currentPage() ? 'active' : '' }}">
                           <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                       </li>
                   @endfor
           
                   <!-- Next Page Link -->
                   @if ($users->hasMorePages())
                       <li class="page-item">
                           <a class="page-link" href="{{ $users->nextPageUrl() }}">
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