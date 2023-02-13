
{{-- Rrder Status --}}
@if($row->isRequest())
    <span class="badge bg-warning">Request</span>
@elseif($row->isPending())
    <span class="badge bg-danger">Pending</span>
@elseif($row->isCompleted())
    <span class="badge bg-success">Completed</span>
@endif



