<button type="button" class="btn btn-sm btn-secondary show-modal"
        data-route="{{route('service-request-customer.show', $id)}}"
        data-method="get"
        data-action="view"
        data-toggle="tooltip"
        data-modal_title="Request Info"
        title="Details">
    <i class="fa fa-eye"></i>
</button>

@if(!$row->status)
    <button type="button"
            class="btn btn-success btn-sm accept-btn"
            title="Accept"
            data-toggle="tooltip"
            data-id="{{$row->id}}"
            data-status="1">
        <i class="fa fa-check-circle" aria-hidden="true"></i>
    </button>

    <button type="button"
            class="btn btn-warning btn-sm accept-btn"
            title="Reject"
            data-toggle="tooltip"
            data-id="{{$row->id}}"
            data-status="">
        <i class="fa fa-minus-circle" aria-hidden="true"></i>
    </button>
@else
    <button type="button"
            class="btn btn-danger btn-sm action-btn"
            title="Delete"
            data-toggle="tooltip"
            data-route="{{route('service-request-customer.destroy', $row)}}"
            data-method="delete"
            data-alert="">
        <i class="fa fa-trash" aria-hidden="true"></i>
    </button>
@endif