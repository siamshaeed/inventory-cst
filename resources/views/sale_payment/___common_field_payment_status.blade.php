
{{-- Sale Payment Status --}}
@if($sale->isUnpaid())
    <span class="badge bg-warning">unPaid</span>
@elseif($sale->isPaid())
    <span class="badge bg-success">Paid</span>
@endif

