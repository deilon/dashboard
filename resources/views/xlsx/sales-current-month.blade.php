<table class="table table-hover">
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
   <tbody class="table-border-bottom-0">
      @foreach ($sales as $srr)
         <tr class="user-sales-row-{{ $srr->id }}">
            <td>{{ $srr->id }}</td>
            <td>{{ $srr->subscription_arrangement }}</td>
            <td>{{ $srr->tier_name }}</td>
            <td>{{ ucwords($srr->payment_method) }}</td>
            <td>{{ $srr->date }}</td>
            <td>{{ ucwords($srr->customer_name) }}</td>
            <td>₱{{ $srr->amount }}</td>
         </tr>
      @endforeach
   </tbody>
   <tfoot class="table-border-bottom-0">
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th class="text-end">Month Total: <span class="fs-5 text-primary">₱{{ $total }}</span></th>
        </tr>
  </tfoot>
</table>