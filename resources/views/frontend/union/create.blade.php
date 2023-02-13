
<form class="mt-4" action="{{ route('union.store') }}" method="post" id="addFormData">
    @csrf
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label text-end">Name English</label>
        <div class="col-sm-10">
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control"
                   placeholder="Enter Union  Name English">
            <span class="text-warning">{{ $errors->first('name') }}</span>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="name_bn" class="col-sm-2 col-form-label text-end">Name Bangla</label>
        <div class="col-sm-10">
            <input type="text" id="name_bn" name="name_bn" value="{{ old('name_bn') }}"
                   class="form-control" placeholder="Enter Union Name Bangla">
            <span class="text-warning">{{ $errors->first('name_bn') }}</span>
        </div>
    </div>

    <input type="hidden" name="division_id" value="0">
    <input type="hidden" name="district_id" value="0">

    <div class="mb-3 row">
        <label for="trial_days" class="col-sm-2 col-form-label text-end">Upazila</label>
        <div class="col-sm-10">
            <div class="form-check form-switch p-0">
                <select name="upazila_id" class="form-control">
                    <option value=""> Select Upazila </option>
                    @foreach ($upazilas as $upazila)
                        <option value="{{ $upazila->id }}"> {{ $upazila->name }} </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="trial_days" class="col-sm-2 col-form-label text-end">Status</label>
        <div class="col-sm-10">
            <div class="form-check form-switch">
                <input type="checkbox" id="status" name="status" class="form-check-input input-group-lg"
                       role="switch" checked style="height: 1.5rem; width: 2.7rem;">
            </div>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="submit" class="col-sm-2 col-form-label text-end"></label>
        <div class="col-sm-10">
            <button class="btn btn-secondary btn-submit">Submit</button>
        </div>
    </div>
</form>
