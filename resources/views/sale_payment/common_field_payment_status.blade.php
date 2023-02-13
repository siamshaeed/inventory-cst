
{{-- Payment Status --}}
@if($row->isUnPaid())
    <span class="badge bg-warning">unPaid</span>
@elseif($row->isPaid())
    <span class="badge bg-success">Paid</span>
@endif



