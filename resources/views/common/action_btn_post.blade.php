
@if(isset($id))
    <form method="POST" action="{{ route($module.'.destroy', $id) }}">
        @csrf
        <a href="{{route($module.'.edit', $id)}}" type="button" class="btn btn-sm btn-primary" title="Edit">
            <i class="fa fa-edit"></i>
        </a>
        <input name="_method" type="hidden" value="DELETE">
        <button type="submit" class="btn btn-sm btn-danger btn-flat- show_confirm-" data-toggle="tooltip" title='Delete'><i class="fa fa-trash"></i></button>
    </form>
@endif

