
{{--Edit Button--}}
<button type="button" class="btn btn-sm btn-primary show-modal"
        data-route="{{route($module.'.edit', $id)}}"
        data-method="get"
        data-action="view"
        data-toggle="tooltip"
        data-modal_title="Edit"
        title="Edit">
    <i class="fa fa-edit"></i>
</button>

{{--Destroy Button--}}
@include('destroy.destroy')

