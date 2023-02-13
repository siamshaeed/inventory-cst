
{{-- purchase payment status --}}
@if($row->isUnpaid())
    <span class="badge bg-warning">unPaid</span>
@elseif($row->isPaid())
    <span class="badge bg-success">Paid</span>
@endif

{{-- purchase payment pay --}}
@if($row->isUnpaid())
    <a href="#" class="float-end" data-toggle="tooltip" title="Due Payment Pay"><i class="fa fa-plus"></i></a>
@endif
