
<form class="mt-4" action="{{ route('good.update', $good) }}" method="post" id="addFormData">
    @csrf
    {{ method_field('PUT') }}

    <div class="col-md-10">
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Goods Name</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <input type="text" id="name" name="name" value="{{ $good->name }}" class="form-control" placeholder="Enter goods name" required>
                <span class="text-warning">{{ $errors->first('name') }}</span>
            </div>
        </div>


        <div class="mb-3 row">
            <label for="submit" class="col-sm-3 col-form-label text-end"></label>
            <div class="col-sm-9">
                <button class="btn btn-secondary btn-submitc modal_form_submit col-sm-2">Update</button>
            </div>
        </div>
    </div>

</form>
