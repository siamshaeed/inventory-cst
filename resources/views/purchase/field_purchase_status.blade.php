
{{-- purchase status --}}
@if($row->isOrdered())
    <span class="badge bg-warning">Ordered</span>
@elseif($row->isPending())
    <span class="badge bg-danger">Pending</span>
@elseif($row->isReceived())
    <span class="badge bg-success">Received</span>
@endif



