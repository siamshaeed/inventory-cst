
<form class="mt-4" action="{{ route('category.update', $category->id) }}" method="post" >
    @csrf
    @method('put')

    <div class="col-md-10">
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Category Name</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <input type="text" id="name" value="{{$category->name}}" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter category name" required>
                <span class="text-warning">{{ $errors->first('name') }}</span>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="trial_days" class="col-sm-3 col-form-label text-end">Status</label>
            <div class="col-sm-9">
                <div class="form-check form-switch">
                    <input type="checkbox" id="status" name="status" class="form-check-input input-group-lg" role="switch" {{ ($category->status == 1) ? 'checked' : '' }} style="height: 1.5rem; width: 2.7rem;">
                </div>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="submit" class="col-sm-3 col-form-label text-end"></label>
            <div class="col-sm-9">
                <button class="btn btn-secondary btn-submit">Update</button>
            </div>
        </div>
    </div>

</form>

