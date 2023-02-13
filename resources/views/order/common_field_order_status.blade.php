
{{-- Common-Use: Order Status --}}
@if($order->isRequest())
    <span class="badge bg-warning">Request</span>
@elseif($order->isPending())
    <span class="badge bg-danger">Pending</span>
@elseif($order->isCompleted())
    <span class="badge bg-success">Completed</span>
@endif



