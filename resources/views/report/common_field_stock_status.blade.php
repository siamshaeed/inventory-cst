
{{-- Common-Use: Purchase Stock Status --}}
@if($purchase_item->isStockAvailable())
    <span class="badge bg-success">&nbsp; Available &nbsp;</span>
@elseif($purchase_item->isStockOut())
    <span class="badge bg-warning">&nbsp; StockOut &nbsp;</span>
@endif



