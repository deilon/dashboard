@extends('components.layouts.dashboard')

@section('title')
    Staff Records
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

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Users Records /</span> Staff</h4>

      <!-- Hoverable Table rows -->
      <div class="card">
         <h5 class="card-header">Users Records</h5>
         <div class="table-responsive text-nowrap">
            <div class="row mb-4 mx-2">
                <div class="col border-top border-bottom">
                    <div class="text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                        {{-- <div class="py-3">
                            <label>
                                <input type="search" class="form-control" placeholder="Search..">
                            </label>
                        </div> --}}
                        <div class="py-3"> 
                            {{-- <button class="btn btn-secondary mx-3" tabindex="0" type="button">
                                <span><i class="bx bx-export me-1"></i>Export</span>
                            </button>  --}}
                            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#createStaff" aria-controls="createStaff">
                                <span>
                                    <i class="bx bx-plus me-0 me-sm-1"></i>
                                    <span class="d-none d-sm-inline-block">Add New Staff</span>
                                </span>
                            </button> 
                        </div>
                    </div>
                </div>
            </div>
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
               <tbody class="table-border-bottom-0">
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
                              <button type="button" class="btn p-0" data-bs-toggle="offcanvas" data-bs-target="#editStaff{{ $user->id }}" aria-controls="editStaff{{ $user->id }}"><i class="bx bx-edit"></i></button>
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

                    <!-- Staff Edit Modal -->
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="editStaff{{ $user->id }}" aria-labelledby="offcanvasEndLabel">
                        <div class="offcanvas-header">
                            <h5 id="offcanvasEndLabel" class="offcanvas-title">Edit Staff</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body my-auto mx-0 flex-grow-0">
                        <form action="{{ route('update.staff'); }}" method="POST" class="add-new-staff" id="updateStaffForm">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="add-staff-firstname">First Name</label>
                                <input type="text" class="form-control" id="add-staff-firstname" placeholder="John" name="firstName" value="{{ old('firstName', ucwords($user->firstname)) }}" aria-label="John">
                                @error('firstName')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="add-staff-lastname">Last Name</label>
                                <input type="text" class="form-control" id="add-staff-lastname" placeholder="Doe" name="lastName" value="{{ old('lastName', ucwords($user->lastname)) }}" aria-label="Doe">
                                @error('lastName')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="add-staff-email">Email</label>
                                <input type="text" class="form-control" id="add-staff-email" placeholder="email@example.com" value="{{ old('email', ucwords($user->email)) }}" name="email">
                                @error('email')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="add-staff-password">Password</label>
                                <input type="password" class="form-control" id="add-staff-password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                                @error('password')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="add-staff-password-confirmation">Password Confirmation</label>
                                <input type="password" class="form-control" id="add-staff-password-confirmation" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                                @error('password_confirmation')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                            </div>
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Update</button>
                                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                                <input type="hidden" name="staffId" value="{{$user->id}}">
                        </form>
                    </div>
                                
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
      <!--/ Hoverable Table rows -->

        <!-- Staff Create Modal -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="createStaff" aria-labelledby="offcanvasEndLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasEndLabel" class="offcanvas-title">Create New Staff</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body my-auto mx-0 flex-grow-0">
            <form action="{{ route('create.staff'); }}" method="POST" class="add-new-staff" id="addNewStaffForm">
                @csrf
                <div class="mb-3">
                   <label class="form-label" for="add-staff-firstname">First Name</label>
                   <input type="text" class="form-control" id="add-staff-firstname" placeholder="John" name="firstName" value="{{ old('firstName') }}" aria-label="John">
                   @error('firstName')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                   <label class="form-label" for="add-staff-lastname">Last Name</label>
                   <input type="text" class="form-control" id="add-staff-lastname" placeholder="Doe" name="lastName" value="{{ old('lastName') }}" aria-label="Doe">
                   @error('lastName')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                   <label class="form-label" for="add-staff-email">Email</label>
                   <input type="text" class="form-control" id="add-staff-email" placeholder="email@example.com" value="{{ old('email') }}" name="email">
                   @error('email')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                   <label class="form-label" for="add-staff-password">Password</label>
                   <input type="password" class="form-control" id="add-staff-password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                   @error('password')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                   <label class="form-label" for="add-staff-password-confirmation">Password Confirmation</label>
                   <input type="password" class="form-control" id="add-staff-password-confirmation" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                   @error('password_confirmation')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="btn btn-primary me-sm-3 me-1">Create</button>
                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                <input type="hidden">
            </form>
        </div>
    </div>


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

