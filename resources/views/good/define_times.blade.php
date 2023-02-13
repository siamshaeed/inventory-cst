
{{-- times: how many use into products --}}
@if($times_product == 0)
    <span><b>{{ $times_product }}</b></span>
@else
    <span class="text-success" title="{{ $times_product }} Times Used"><b>{{ $times_product }}</b></span>
@endif
