
{{-- Sale Grand Amount --}}
<a href="{{ route('sale-payment.show', $sale_id) }}" class="text-success" data-toggle="tooltip" title="Payment - History">
    <span class="badge bg-success">&nbsp; {{ $grand_amount }} &nbsp;</span>
</a> <br>

{{-- Sale Items Details --}}
<a href="{{ route('sale-item.show', $sale_id) }}" data-toggle="tooltip" title="Sale Items Details">
    <span class="badge bg-success">&nbsp; Sale Items &nbsp;</span>
</a>
