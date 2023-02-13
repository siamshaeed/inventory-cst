
{{-- purchase payment status --}}
@if($row->isUnpaid())
    <span class="badge bg-warning">unPaid</span>
@elseif($row->isPartiallyPaid())
    <span class="badge bg-danger">Partially Paid</span>
@elseif($row->isPaid())
    <span class="badge bg-success">Paid</span>
@endif

{{-- purchase payment pay --}}
{{--@if($row->isUnpaid() || $row->isPartiallyPaid())
    <a href="#" class="float-end" data-toggle="tooltip" title="Due Payment Pay"><i class="fa fa-plus"></i></a>
@endif--}}
