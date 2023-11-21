@extends('components.layouts.dashboard')

@section('title')
    Trainer Progress
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

    <!-- Toast with Placements -->
      <div class="bs-toast toast toast-placement-ex m-2" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
         <div class="toast-header">
            <i class='bx bx-bell me-2'></i>
         <div class="me-auto fw-semibold">Progress Week update</div>
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
   
    <h4 class="py-3 mb-2">My Fitness Progress</h4>
    <p>Here you can create your own separate Fitness Progress wether you have your own Trainer assigned or not. <br> 
        Own your progress by creating Progress Weeks, Daily Progress, and Task Lists.</p>

    <div class="row g-4">
         @foreach($progressWeeks as $pweek)
         <div class="col-xl-4 col-lg-6 col-md-6" id="pwItem{{ $pweek->id }}">
            <div class="card">
                <div class="card-body">
                   <div class="d-flex justify-content-between mb-2">
                      <h6 class="fw-normal">Total 1 user</h6>
                      <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                        @if($user->photo)
                           <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-sm pull-up" aria-label="{{ ucwords($user->firstname.' '.$user->lastname) }}" data-bs-original-title="{{ ucwords($user->firstname.' '.$user->lastname) }}">
                              <img class="rounded-circle" src="{{ asset('storage/assets/img/avatars/'.$user->photo) }}" alt="Avatar">
                           </li>
                        @else
                           <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-sm pull-up" aria-label="{{ ucwords($user->firstname.' '.$user->lastname) }}" data-bs-original-title="{{ ucwords($user->firstname.' '.$user->lastname) }}">
                              <img class="rounded-circle" src="{{ asset('storage/assets/img/avatars/default.jpg') }}" alt="Avatar">
                           </li>
                        @endif
                      </ul>
                   </div>
                   <div class="d-flex justify-content-between align-items-end">
                      <div class="role-heading">
                         <h4 class="mb-1">{{ ucwords($pweek->week_title) }}</h4>
                         <small class="d-block">Week No. {{ $pweek->week_number }}</small>
                         <a href="{{ url('member/my-weekly-progress/'.$pweek->id) }}" target="_blank"><small>View</small></a>
                         <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editProgressWeekModal{{ $pweek->id }}"><small>Edit</small></a>
                         <a href="javascript:void(0);" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteProgressWeekModal{{ $pweek->id }}"><small>Delete</small></a>
                      </div>
                   </div>
                </div>
             </div>
         </div>

         <!-- Edit Progress Week Modal -->
         <div class="modal fade" id="editProgressWeekModal{{ $pweek->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
               <div class="modal-content">
                  <form action="{{ route('update.progress.week') }}" method="POST">
                     @csrf
                     <div class="modal-header">
                        <h5 class="modal-title">Create Progress Week</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                        <div class="row">
                           <div class="col mb-3">
                              <label for="progressWeekTitle" class="form-label">Progress Week Title</label> <span class="text-danger">*</span>
                              <input type="text" id="progressWeekTitle" name="progress_week_title" class="form-control" value="{{ $pweek->week_title }}" placeholder="Enter Name" required />
                           </div>
                        </div>
                        <div class="row">
                           <div class="col mb-3">
                              <label for="progressWeekNumber" class="form-label">Week Number</label> <span class="text-danger">*</span>
                              <input type="number" id="progressWeekNumber" name="progress_week_number" class="form-control" value="{{ $pweek->week_number }}" placeholder="Enter Week Number" required/>
                              <input type="hidden" name="pw_id" class="form-control" value="{{ $pweek->id }}" required/>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>

         <!-- Delete Confirmation Modal -->
         <div class="modal fade" id="deleteProgressWeekModal{{ $pweek->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Deleting Progress Week </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                        <div class="modal-text">Are you sure you want to delete "<span class="fw-bold">{{ ucwords($pweek->week_title) }}</span>" ?</div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger delete-pw-btn" data-pw="{{ $pweek->id }}" data-route-url="{{ url('member/delete-progress-week/'.$pweek->id) }}">Delete</button>
                     </div>
                  </div>
            </div>
         </div>
         @endforeach
    </div>

    <!-- Create Progress Week Modal -->
   <div class="modal fade" id="createProgressWeekModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
         <div class="modal-content">
            <form action="{{ route('create.progress.week') }}" method="POST">
               @csrf
               <div class="modal-header">
                  <h5 class="modal-title">Create Progress Week</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <div class="row">
                     <div class="col mb-3">
                        <label for="progressWeekTitle" class="form-label">Progress Week Title</label> <span class="text-danger">*</span>
                        <input type="text" id="progressWeekTitle" name="progress_week_title" class="form-control" placeholder="Enter Name" required />
                     </div>
                  </div>
                  <div class="row">
                     <div class="col mb-3">
                        <label for="progressWeekNumber" class="form-label">Week Number</label> <span class="text-danger">*</span>
                        <input type="number" id="progressWeekNumber" name="progress_week_number" class="form-control" placeholder="Enter Week Number" required/>
                     </div>
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
<script src="{{ asset('storage/assets/js/dashboards-analytics.js') }}"></script>
<script src="{{ asset('storage/assets/js/ui-toasts.js')}} "></script>
<script>
$('.delete-pw-btn').click(function(e) {
    var pwId = $(this).data('pw');
    var routeUrl = $(this).data('route-url');

    $.ajax({
        url: routeUrl,
        type: 'POST',
        data: pwId,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            $('#deleteProgressWeekModal'+pwId).modal('hide');
            $('#pwItem'+pwId).addClass('d-none');

            // Toasts variables
            let toastContainer = document.querySelector('.toast-placement-ex');
            selectedPlacement = "top-0 start-50 translate-middle-x";

            selectedType = "bg-secondary";
            toastContainer.classList.add(selectedType);
            DOMTokenList.prototype.add.apply(toastContainer.classList, selectedPlacement.split(' '));
            $('#status-message').replaceWith('<span id="status-message"><strong>'+response.message+'</strong></span>');
            toast = new bootstrap.Toast(toastContainer);
            toast.show();
        }
    })
});
</script>
@endsection