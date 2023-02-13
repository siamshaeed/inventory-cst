
{{--Destroy Submit Form--}}
@csrf
<input type="hidden" name="_method" value="POST">
<input type="hidden" name="tbl_id" value="{{ $id }}">
<input type="hidden" name="tbl_name" value="{{ $tbl_name }}">
<input type="hidden" name="tbl_foreign_id" value="{{ $tbl_foreign_id }}">
<input type="hidden" name="tbl_foreign_tbl_name" value="{{ $tbl_foreign_tbl_name }}">

{{--Destroy Button--}}
<button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title='Delete'>
    <i class="fa fa-trash"></i>
</button>
