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
   
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Progress Week / View /</span> {{ ucwords($weekProgress->week_title) }}</h4>
    <p>This is your Fitness Progress curated by your Trainer. <br> 
        NOTE: That only your trainer can make changes to this progres.</p>

    <div class="row g-4">

      @if($assigned_staff)
      <!-- Trainer details -->
      <div class="col-xl-4 col-lg-5 col-md-5 order-2 order-md-0">
         <div class="card mb-4">
            <div class="card-body">
               <h5 class="card-title text-center">Trainer Details</h5>
               <div class="user-avatar-section">
                  <div class=" d-flex align-items-center flex-column">
                     <img class="img-fluid rounded my-4" src="{{ $assigned_staff->photo ? asset('storage/assets/img/avatars/'. $assigned_staff->photo) : asset('storage/assets/img/avatars/default.jpg') }}" height="110" width="110" alt="User avatar" />            
                     <div class="user-info text-center">
                        <h4 class="mb-2">{{ ucwords($assigned_staff->firstname.' '.$assigned_staff->lastname) }}</h4>
                        <span class="badge bg-label-secondary">{{ ucfirst($assigned_staff->role) }}</span>
                     </div>
                  </div>
               </div>
               <div class="d-flex justify-content-around flex-wrap my-4 py-3">
                  <div class="d-flex align-items-start me-4 mt-3 gap-3">
                     <span class="badge bg-label-primary p-2 rounded"><i class='bx bx-check bx-sm'></i></span>
                     <div>
                        <h5 class="mb-0">1.23k</h5>
                        <span>Tasks Done</span>
                     </div>
                  </div>
                  <div class="d-flex align-items-start mt-3 gap-3">
                     <span class="badge bg-label-primary p-2 rounded"><i class='bx bx-customize bx-sm'></i></span>
                     <div>
                        <h5 class="mb-0">568</h5>
                        <span>Workout done</span>
                     </div>
                  </div>
               </div>
               <h5 class="pb-2 border-bottom mb-4">Details</h5>
               <div class="info-container">
                  <ul class="list-unstyled">
                     <li class="mb-3">
                        <span class="fw-medium me-2">Email:</span>
                        <span>{{$user->email}}</span>
                     </li>
                     <li class="mb-3">
                        <span class="fw-medium me-2">Status:</span>
                        @if($user->status == 'active')
                           <span class="badge bg-label-success me-1">Active</span>
                        @elseif($user->status == 'inactive')
                           <span class="badge bg-label-warning me-1">Inactive</span>
                        @elseif($user->status == 'disabled')
                           <span class="badge bg-label-secondary me-1">Disabled</span>
                        @else
                           <span class="badge bg-label-warning me-1">Suspended</span>
                        @endif
                     </li>
                     <li class="mb-3">
                        <span class="fw-medium me-2">Role:</span>
                        <span>{{$assigned_staff->role}}</span>
                     </li>
                     <li class="mb-3">
                        <span class="fw-medium me-2">Country:</span>
                        <span>{{ $assigned_staff->country }}</span>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <!--/ Trainer Details -->
      @else
      <!-- Pending Trainer details -->
      <div class="col-xl-4 col-lg-5 col-md-5 order-2 order-md-0">
         <div class="card mb-4">
            <div class="card-body">
               <h5 class="card-title text-center">Trainer Details</h5>
               <div class="user-avatar-section">
                  <div class=" d-flex align-items-center flex-column">
                     <img class="img-fluid rounded my-4" src="{{ asset('storage/assets/img/avatars/default.jpg') }}" height="110" width="110" alt="User avatar" />            
                     <div class="user-info text-center">
                        <h4 class="mb-2">...</h4>
                        <span class="badge bg-label-secondary">Trainer / Staff</span>
                     </div>
                  </div>
               </div>
               <h5 class="pb-2 border-bottom mb-4">Details</h5>
               <div class="info-container">
                  <ul class="list-unstyled">
                     <li class="mb-3">
                        <span class="fw-medium me-2">Email:</span>
                        <span>Pending</span>
                     </li>
                     <li class="mb-3">
                        <span class="fw-medium me-2">Status:</span>
                        <span class="badge bg-label-secondary me-1">Pending</span>
                     </li>
                     <li class="mb-3">
                        <span class="fw-medium me-2">Role:</span>
                        <span>Trainer / Staff</span>
                     </li>
                     <li class="mb-3">
                        <span class="fw-medium me-2">Country:</span>
                        <span>Philippines</span>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <!--/ Pending Trainer Details -->
      @endif



        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                   <div class="d-flex justify-content-between mb-2">
                      <h6 class="fw-normal">Progress Week</h6>
                      <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                      </ul>
                   </div>
                   <div class="d-flex justify-content-between align-items-end">
                      <div class="role-heading">
                         <h4 class="mb-1">{{ ucwords($weekProgress->week_title) }}</h4>
                         <small class="d-block">Week No. {{ $weekProgress->week_number }}</small>
                         <div class="d-flex">
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
                     <h2 class="accordion-header text-body d-flex justify-content-between align-items-center" id="accordionIcon{{$day->id}}">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionIcon-{{$day->id}}" aria-controls="accordionIcon-{{$day->id}}">
                            <input class="form-check-input me-2 align-self-start day-check" name="status" data-day="{{ $day->id }}" type="checkbox" value="completed" {{ $day->status == 'completed' ? 'checked' : '' }}>
                            <div class="flex-grow-1">
                              {{ ucfirst($day->day_title) }}
                              <small class="d-block text-muted">{{ $day->day_number }}</small>
                           </div>
                        </button>
                     </h2>
                     <div id="accordionIcon-{{$day->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionIcon">
                        <div class="accordion-body clearfix">
                           @php
                               $dayTasks = App\Models\ProgressDayTask::where('progress_day_id', $day->id)->get();
                           @endphp
                           <div class="list-group list-group-flush" id="listGroup{{ $day->id }}">
                              @foreach($dayTasks as $task)
                                 <span id="taskItem{{ $task->id }}" class="list-group-item list-group-item-action">{{ ucfirst($task->task_title) }}</span>
                              @endforeach
                           </div>
                        </div>
                     </div>
                  </div>
               @endforeach
            </div>
         </div>
        @endif

    </div>
 </div>
 <!-- / Content -->
@endsection

@section('page-js')
<script src="{{ asset('storage/assets/js/dashboards-analytics.js') }}"></script>
@endsection