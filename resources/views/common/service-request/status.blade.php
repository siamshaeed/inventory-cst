@if($row->status == 0)
    Pending
@elseif($row->status == 1)
    Accepted
@elseif($row->status == 2)
    Rejected
@endif