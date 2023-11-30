@extends('components.layouts.dashboard')

@section('title')
    All Sales Revenue Report
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

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">All Service Report</span></h4>

      <!-- Hoverable Table rows -->
      <div class="card">
         <h5 class="card-header">Sales</h5>
         <div class="table-responsive text-nowrap">
            <div class="row mb-4 mx-2">
                <div class="col border-top border-bottom">
                    <div class="text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                        <div class="py-3">
                            <label>
                                <input type="search" name="searchSales" id="searchSales" class="form-control" placeholder="Search..">
                            </label>
                        </div>
                        <div class="py-3"> 
                            <button class="btn btn-secondary mx-3" type="button" data-bs-toggle="modal" data-bs-target="#exportModal">
                                <span><i class="bx bx-export me-1"></i>Export</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-hover">
                {{-- <caption class="ms-4">Sales Revenue Report for the Month of January</caption> --}}
               <thead>
                  <tr>
                     <th>Subscription Arrangement</th>
                     <th>Tier</th>
                     <th>Payment Method</th>
                     <th>Date</th>
                     <th>Customer Name</th>
                     <th>Amount</th>
                  </tr>
               </thead>
               <tbody id="allData" class="table-border-bottom-0">
                  @foreach ($sales as $srr)
                     <tr class="user-sales-row-{{ $srr->id }}">
                        <td>{{ $srr->subscription_arrangement }}</td>
                        <td>{{ ucwords($srr->tier_name) }}</td>
                        <td>{{ ucwords($srr->payment_method) }}</td>
                        <td>{{ $srr->date }}</td>
                        <td>{{ ucwords($srr->customer_name) }}</td>
                        <td>₱{{ $srr->amount }}</td>
                     </tr>
                  @endforeach
               </tbody>
               <tbody id="searchData" class="table-border-bottom-0 d-none"></tbody>
               <tfoot class="table-border-bottom-0">
                    <tr>
                        <th class="text-end" colspan="7">Total: <span class="fs-5 text-primary">₱{{ $total }}</span></th>
                    </tr>
              </tfoot>
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
                   @if ($sales->onFirstPage())
                       <li class="page-item disabled">
                           <a class="page-link" href="javascript:void(0);">
                               Previous
                           </a>
                       </li>
                   @else
                       <li class="page-item">
                           <a class="page-link" href="{{ $sales->previousPageUrl() }}">
                               Previous
                           </a>
                       </li>
                   @endif
           
                   <!-- Number of Pages -->
                   @for ($i = 1; $i <= $sales->lastPage(); $i++)
                       <li class="page-item {{ $i == $sales->currentPage() ? 'active' : '' }}">
                           <a class="page-link" href="{{ $sales->url($i) }}">{{ $i }}</a>
                       </li>
                   @endfor
           
                   <!-- Next Page Link -->
                   @if ($sales->hasMorePages())
                       <li class="page-item">
                           <a class="page-link" href="{{ $sales->nextPageUrl() }}">
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


        <!-- Export Confirmation Modal -->
        <div class="modal fade" id="exportModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Export Service Revenue</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-text">Export All Service Revenue Report?</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <a href="{{ route('sales.export') }}" class="btn btn-primary" id="exportModalBtn">Export</a>
                    </div>
                </div>
            </div>
        </div>

</div>
<!-- / Content -->
@endsection

@section('page-js')
<script src="{{ asset('storage/assets/js/dashboards-analytics.js') }}"></script>
<script src="{{ asset('storage/assets/js/ui-toasts.js')}} "></script>
<script src="{{ asset('storage/assets/js/ui-modals.js') }}"></script>
<script>
    $("#exportModalBtn").click(function() {
        $("#exportModal").modal('hide');
    })

    $(document).ready(function () {
        $('#searchSales').on('keyup', function () {
            $query = $(this).val();

            if($query) {
                $("#allData").hide();
                $('#searchData').removeClass('d-none');
                $('#searchData').show();
            } else {
                $("#allData").show();
                $('#searchData').hide();
            }

            $.ajax({
                url: '{{ route('sales.search') }}',
                method: 'get',
                data: { 'query': $query },
                success: function (data) {
                    $('#searchData').html(data);
                }
            });
        });
    });
</script>
@endsection