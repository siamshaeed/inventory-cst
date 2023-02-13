
{{-- Product Stock --}}
@if($stock==0)
    <span><b>{{ $stock }}</b></span>
@else
    <span class="text-success"><b>{{ $stock }}</b></span>
@endif

