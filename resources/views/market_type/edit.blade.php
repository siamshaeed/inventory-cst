
<form class="mt-4" action="{{ route('market-type.update', $marketType) }}" method="post" id="addFormData">
    @csrf
    {{ method_field('PUT') }}

    <div class="col-md-10">
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Market Type Name</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <input type="text" id="name" name="name" value="{{ old('name', $marketType->name) }}" class="form-control" placeholder="Enter market type name" required>
                <span class="text-warning">{{ $errors->first('name') }}</span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Title</b></label>
            <div class="col-sm-9">
                <input type="text" id="title" name="title" value="{{ old('title', $marketType->title) }}" class="form-control" placeholder="Enter title name">
                <span class="text-warning">{{ $errors->first('title') }}</span>
            </div>
        </div>


        <div class="mb-3 row">
            <label for="submit" class="col-sm-3 col-form-label text-end"></label>
            <div class="col-sm-9">
                <button class="btn btn-secondary btn-submitc modal_form_submit">Update</button>
            </div>
        </div>
    </div>

</form>
