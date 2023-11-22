@extends('components.layouts.dashboard')

@section('title')
    Announcements and Promotions
@endsection

@if(Auth::user()->role == 'admin')
    @section('admin-sidebar')
        <x-admin-sidebar/>
    @endsection
@elseif(Auth::user()->role == 'staff')
   @section('staff-sidebar')
      <x-staff-sidebar/>
   @endsection
@endif

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


    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Announcement and Promotions </span></h4>

    <div class="row">
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card text-center">
              <div class="card-header"><i class='bx bxs-megaphone'></i></div>
              <div class="card-body">
                <h5 class="card-title">Create Announcements and Promotions</h5>
                <p class="card-text">Photo, Texts, and Tags</p>
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#createAPModal">Create</button>
              </div>
            </div>
        </div>
    </div>
    @if($aps)
        <div class="row">
            @foreach($aps as $ap)
                <div class="col-md-6 col-lg-4 mb-3" id="apItem{{ $ap->id }}">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $ap->ap_title }}</h5>
                            <h6 class="card-subtitle text-muted">{{ $ap->ap_tag }}</h6>
                            @if($ap->photo)
                                <img class="img-fluid d-flex mx-auto my-4" src="{{ asset('storage/assets/img/layouts/'.$ap->photo) }}" alt="Card image cap">
                            @else
                                <img class="img-fluid d-flex mx-auto my-4" src="{{ asset('storage/assets/img/layouts/default_announcement.png') }}" alt="Card image cap">
                            @endif
                            @if($ap->ap_description)
                                <p class="card-text">{{ $ap->ap_description }}</p>
                            @endif
                            <a href="javascript:void(0);" class="btn btn-primary me-3" type="button" data-bs-toggle="modal" data-bs-target="#editAPModal{{ $ap->id }}">Edit</a>
                            <a href="javascript:void(0);" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAPModal{{ $ap->id }}">Delete</a>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editAPModal{{ $ap->id }}" tabindex="-1" aria-hidden="true">
                    <form action="{{ route('update.ap') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Update Announcement / Promotion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="ap_title" class="form-label">Title</label> <span class="text-danger">*</span>
                                            <input type="text" id="ap_title" name="title" class="form-control" placeholder="Enter Title" value="{{ old('title', ucfirst($ap->ap_title)) }}" />
                                            @error('title')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="ap_tag" class="form-label">Tag</label> <span class="text-danger">*</span>
                                            <input type="text" id="ap_tag" name="tag" class="form-control" placeholder="Enter Tag" value="{{ old('tag', ucfirst($ap->ap_tag)) }}" />
                                            <div class="form-text">Example: Gym and Fitness, Announcement, Promotion</div>
                                            @error('tag')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="ap_description" class="form-label">Description</label>
                                            <textarea class="form-control" id="ap_description" name="description" rows="3" style="height: 90px;">{{ old('description', ucfirst($ap->ap_description)) }}</textarea>
                                            @error('description')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="ap_photo" class="form-label">Photo</label>
                                            <input class="form-control" type="file" id="ap_photo" name="photo">
                                            @error('photo')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                                            @if($ap->photo)
                                                <img src="{{ asset('storage/assets/img/layouts/'.$ap->photo) }}" alt="" class="mt-5 img-fluid">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row d-none">
                                        <input type="hidden" name="authorId" value="{{ $ap->user->id }}">
                                        <input type="hidden" name="apId" value="{{ $ap->id }}">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="deleteAPModal{{ $ap->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Announcement/Promotion </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="modal-text">Are you sure you want to delete "<span class="fw-bold">{{ ucfirst($ap->ap_title) }}</span>" ?</div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger delete-ap-btn" data-ap="{{ $ap->id }}" data-route-url="{{ url('management/delete-ap/'.$ap->id) }}">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="createAPModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('create.ap') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Create Announcement / Promotion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="ap_title" class="form-label">Title</label> <span class="text-danger">*</span>
                                <input type="text" id="ap_title" name="title" class="form-control" placeholder="Enter Title" />
                                @error('title')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="ap_tag" class="form-label">Tag</label> <span class="text-danger">*</span>
                                <input type="text" id="ap_tag" name="tag" class="form-control" placeholder="Enter Tag" />
                                <div class="form-text">Example: Gym and Fitness, Announcement, Promotion</div>
                                @error('tag')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="ap_description" class="form-label">Description</label>
                                <textarea class="form-control" id="ap_description" name="description" rows="3" style="height: 90px;"></textarea>
                                @error('description')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="ap_photo" class="form-label">Photo</label>
                                <input class="form-control" type="file" id="ap_photo" name="photo">
                                @error('photo')<div class="text-danger d-block pt-3">{{ $message }}</div>@enderror
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
<script src="{{ asset('storage/assets/js/ui-toasts.js')}} "></script>
<script src="{{ asset('storage/assets/js/ui-modals.js') }}"></script>
<script src="{{ asset('storage/assets/js/custom/announcement.js') }}"></script>
@endsection