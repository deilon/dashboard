<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #3490dc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }
    </style>

</head>
<body>
            <h1>Sales List</h1>

           <table class="table table-hover" width="100%">
                {{-- <caption class="ms-4">Sales Revenue Report for the Month of January</caption> --}}
               <thead>
                  <tr>
                     <th>ID</th>
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
                        <td>{{ $srr->id }}</td>
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
                        <th class="text-end" colspan="7">Month Total: <span class="fs-5 text-primary">₱{{ $total }}</span></th>
                    </tr>
              </tfoot>
            </table>
            <script src="{{ asset('storage/assets/vendor/libs/jquery/jquery.js') }}"></script>
            <script src="{{ asset('storage/assets/vendor/libs/popper/popper.js') }}"></script>
            <script src="{{ asset('storage/assets/vendor/js/bootstrap.js') }}"></script>
</body>
</html>