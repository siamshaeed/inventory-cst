
<div class="form-check form-switch">
    @if($status)
        <input type="checkbox" id="check{{$id}}" onclick="update_service_status({{$id}}, '{{$tbl_name}}')" class="form-check-input app-checkbox" role="switch" checked>
    @else
        <input type="checkbox" id="check{{$id}}" onclick="update_service_status({{$id}}, '{{$tbl_name}}')" class="form-check-input app-checkbox" role="switch" unchecked>
    @endif
</div>

