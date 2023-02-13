
{{-- Product Name --}}
@if($stock==0)
    <span><b>{{ $name }}</b></span>
@else
    <span class="text-success"><b>{{ $name }}</b></span>
@endif

