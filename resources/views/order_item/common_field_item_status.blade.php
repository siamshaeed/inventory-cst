
{{-- Order Item Status --}}
@if($order_item->isRequest())
    <span class="badge bg-warning">Request</span>
@elseif($order_item->isPending())
    <span class="badge bg-danger">Pending</span>
@elseif($order_item->isCompleted())
    <span class="badge bg-success">Completed</span>
@endif



