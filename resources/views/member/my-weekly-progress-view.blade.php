@extends('components.layouts.dashboard')

@section('title')
    Week Fitness Progress
@endsection
@section('custom-css')
 <style>
   .list-group-item:hover a {
      display: block !important;
   }
 </style>
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
   
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">My Weekly Fitness Progress /</span> {{ ucwords($weekProgress->week_title) }}</h4>
    <p>Here you can add Days and Tasks to Weekly Fitness Progress.</p>

    <div class="row g-4">
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                   <div class="d-flex justify-content-between mb-2">
                      <h6 class="fw-normal">Total 1 user</h6>
                      <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                        @if($user->photo)
                           <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-sm pull-up" aria-label="Vinnie Mostowy" data-bs-original-title="Vinnie Mostowy">
                              <img class="rounded-circle" src="{{ asset('storage/assets/img/avatars/'.$user->photo) }}" alt="Avatar">
                           </li>
                        @else
                           <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-sm pull-up" aria-label="Vinnie Mostowy" data-bs-original-title="Vinnie Mostowy">
                              <img class="rounded-circle" src="{{ asset('storage/assets/img/avatars/default.jpg') }}" alt="Avatar">
                           </li>
                        @endif
                      </ul>
                   </div>
                   <div class="d-flex justify-content-between align-items-end">
                      <div class="role-heading">
                         <h4 class="mb-1">{{ ucwords($weekProgress->week_title) }}</h4>
                         <small class="d-block">Week No. {{ $weekProgress->week_number }}</small>
                         <div class="d-flex">
                           <button class="btn btn-primary btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#createDayModal">Add Day Entry</button>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
        </div>
        @if($days)
         <div class="col-xl-4 col-lg-6 col-md-6">
            <div id="accordionIcon" class="accordion accordion-without-arrow">
               @foreach($days as $day)
                  <div class="accordion-item card" id="dayItem{{ $day->id }}">
                     <h2 class="accordion-header text-body d-flex justify-content-between align-items-center" id="accordionIconOne">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionIcon-1" aria-controls="accordionIcon-1">
                           <input class="form-check-input me-2 align-self-start day-check" name="status" data-day="{{ $day->id }}" type="checkbox" value="completed" {{ $day->status == 'completed' ? 'checked' : '' }}>
                           <div class="flex-grow-1">
                              {{ $day->day_title }}
                              <small class="d-block text-muted">{{ $day->day_number }}</small>
                           </div>
                           <div class="ms-auto align-self-start">
                              <a class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#editDayModal{{ $day->id }}"><i class="bx bx-edit"></i></a>
                              <a class="cursor-pointer delete-day" data-bs-toggle="modal" data-bs-target="#deleteDayModal{{ $day->id }}"><i class="bx bx-trash"></i></a>
                           </div>
                        </button>
                     </h2>
                     <div id="accordionIcon-1" class="accordion-collapse collapse" data-bs-parent="#accordionIcon">
                        <div class="accordion-body clearfix">
                           @php
                               $dayTasks = App\Models\ProgressDayTask::where('progress_day_id', $day->id)->get();
                           @endphp
                           <div class="list-group list-group-flush" id="listGroup{{ $day->id }}">
                              @foreach($dayTasks as $task)
                                 <span id="taskItem{{ $task->id }}" class="list-group-item list-group-item-action">{{ ucfirst($task->task_title) }} <a class="cursor-pointer float-end d-none delete-task" data-task="{{ $task->id }}" data-route-url="{{ url('member/delete-day-task/'.$task->id) }}"><i class="bx bx-trash"></i></a></span>
                              @endforeach
                           </div>
                           <input class="form-control task-input" type="text" data-day="{{ $day->id }}" data-route-url="{{ route('create.task') }}" placeholder="Day 1 task entry">
                        </div>
                     </div>
                  </div>


                     <!-- Edit Progress Day Modal -->
                     <div class="modal fade" id="editDayModal{{ $day->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                           <div class="modal-content">
                              <form action="{{ route('update.day') }}" method="POST">
                                 @csrf
                                 <div class="modal-header">
                                    <h5 class="modal-title">Edit Day Progress</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    <div class="row">
                                       <div class="col mb-3">
                                          <label for="progressDayTitle" class="form-label">Progress Day Title</label> <span class="text-danger">*</span>
                                          <input type="text" id="progressDayTitle" name="day_title" class="form-control" value="{{ old('day_title', $day->day_title) }}" placeholder="Enter Name" required />
                                          @error('day_title')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col mb-3">
                                          <label for="progressDayNumber" class="form-label">Day Number</label> <span class="text-danger">*</span>
                                          <select id="progressDayNumber" name="day_number" class="form-select" required>
                                             <option value="Day 1">Select Day of the Week</option>
                                             <option value="Day 1" {{ $day->day_number == 'Day 1' ? 'selected' : '' }}>Day 1</option>
                                             <option value="Day 2" {{ $day->day_number == 'Day 2' ? 'selected' : '' }}>Day 2</option>
                                             <option value="Day 3" {{ $day->day_number == 'Day 3' ? 'selected' : '' }}>Day 3</option>
                                             <option value="Day 4" {{ $day->day_number == 'Day 4' ? 'selected' : '' }}>Day 4</option>
                                             <option value="Day 5" {{ $day->day_number == 'Day 5' ? 'selected' : '' }}>Day 5</option>
                                             <option value="Day 6" {{ $day->day_number == 'Day 6' ? 'selected' : '' }}>Day 6</option>
                                             <option value="Day 7" {{ $day->day_number == 'Day 7' ? 'selected' : '' }}>Day 7</option>
                                           </select>
                                           @error('day_number')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                                           <input type="hidden" name="day_id" class="form-control" value="{{ $day->id }}" />
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


                     <!-- Delete Day Confirmation Modal -->
                     <div class="modal fade" id="deleteDayModal{{ $day->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title">Deleting Day Progress </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    <div class="modal-text">Are you sure you want to delete "<span class="fw-bold">{{ ucwords($day->day_title) }}</span>" ?</div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-danger delete-day" data-day="{{ $day->id }}" data-route-url="{{ url('member/delete-day-progress/'.$day->id) }}">Delete</button>
                                 </div>
                              </div>
                        </div>
                     </div>
               @endforeach
            </div>
         </div>
        @endif

    </div>

    <!-- Create Day Modal -->
    <div class="modal fade" id="createDayModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
         <div class="modal-content">
            <form action="{{ route('create.day') }}" method="POST">
               @csrf
               <div class="modal-header">
                  <h5 class="modal-title">Create Progress Day</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <div class="row">
                     <div class="col mb-3">
                        <label for="progressDayTitle" class="form-label">Progress Day Title</label> <span class="text-danger">*</span>
                        <input type="text" id="progressDayTitle" name="day_title" class="form-control" placeholder="Enter Name of Day" required />
                        @error('day_title')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                     </div>
                  </div>
                  <div class="row">
                     <div class="col mb-3">
                        <label for="progressDayNumber" class="form-label">Day Number</label> <span class="text-danger">*</span>
                        <select id="progressDayNumber" name="day_number" class="form-select" required>
                           <option>Select Day of the Week</option>
                           <option value="Day 1">Day 1</option>
                           <option value="Day 2">Day 2</option>
                           <option value="Day 3">Day 3</option>
                           <option value="Day 4">Day 4</option>
                           <option value="Day 5">Day 5</option>
                           <option value="Day 6">Day 6</option>
                           <option value="Day 7">Day 7</option>
                         </select>
                         @error('day_number')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                         <input type="hidden" name="progress_week_id" class="form-control" value="{{ $weekProgress->id }}" />
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
<script>
$(document).ready(function(){

  $(".task-input").on("keydown", function(event){
   var taskValue = $(this).val();
   var dayId = $(this).data('day');
   var routeUrl = $(this).data('route-url');

   // Check if the pressed key is Enter (key code 13)
    if(event.which === 13){
      $.ajax({
         url: routeUrl,
         type: 'POST',
         data: { task_title: taskValue, progress_day_id: dayId },
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         success: function(response) {
               var deleteUrl = "{{ url('member/delete-day-task/') }}/" + response.task_id;
               $('#listGroup'+dayId).append("<span id=\"taskItem"+response.task_id+"\" class=\"list-group-item list-group-item-action\">"+taskValue.charAt(0).toUpperCase()+taskValue.slice(1)+"<a class=\"cursor-pointer float-end d-none delete-task\" data-task=\""+response.task_id+"\" data-route-url=\""+deleteUrl+"\"><i class=\"bx bx-trash\"></i></a></span>");

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
      });
    }
  });

});


   $('.list-group').on('click', '.delete-task', function(e) {
      var taskId = $(this).data('task');
      var routeUrl = $(this).data('route-url');

      $.ajax({
         url: routeUrl,
         type: 'POST',
         data: taskId,
         headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         success: function(response) {
               $('#taskItem'+taskId).addClass('d-none');

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
      });
   });

   $('.delete-day').click(function(e) {
      var dayId = $(this).data('day');
      var routeUrl = $(this).data('route-url');

      $.ajax({
         url: routeUrl,
         type: 'POST',
         data: dayId,
         headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         success: function(response) {
               $('#deleteDayModal'+dayId).modal('hide');
               $('#dayItem'+dayId).addClass('d-none');

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
      });
   });


   $('.day-check').on('change', function(e) {
      var dayCheckId = $(this).data('day');
      if($(this).is(':checked')) {
         var dayCheckVal = 'completed';
      } else {
         var dayCheckVal = 'active';
      }

      $.ajax({
         url: "{{ url('member/day/complete') }}/" + dayCheckId,
         type: 'POST',
         data: {status: dayCheckVal},
         headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         success: function(response) {
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
      });
   });


</script>
@endsection