
{{-- Order Number and Order Items--}}
<a href="{{ route('order.show', $id) }}" data-toggle="tooltip" title="Order - History"><b>{{ $order_number }}</b></a>
<br>
<a href="{{ route('order-item.show', $order_id) }}" class="text-success" data-toggle="tooltip" title="Order - Items">
    <span class="badge bg-success">&nbsp; Order Items &nbsp;</span>
</a>
