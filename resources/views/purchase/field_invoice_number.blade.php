
{{-- Purchase Invoice Number --}}
<a href="{{ route('purchase.show', $id) }}" data-toggle="tooltip" title="Invoice - History">
    <b>{{ $invoice_number }}</b>
</a>
<br>

{{-- Purchase Items Show --}}
<a href="{{ route('purchase-item.show', $id) }}" data-toggle="tooltip" title="Invoice - History" target="_blank">
    <span class="badge bg-success">Purchase Items</span>
</a>
