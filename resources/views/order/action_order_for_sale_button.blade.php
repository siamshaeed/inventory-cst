
{{-- Order For Sell Button --}}
@if($sale_status == true)
    <button type="button" class="btn btn-sm btn-success" data-toggle="tooltip" title="Sale Completed">
        <i class="fa fa-check"></i> Done
    </button>
@else
    <a href="{{ route('sale-order-create', $order_id) }}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Click To Sale">
        <i class="fa fa-arrow-right"></i> Sale
    </a>
@endif
