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
        NOTE: That only your trainer can make changes to this progress.</p>

    <div class="row g-4">
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