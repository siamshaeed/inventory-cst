
<form class="mt-4" action="{{ route('district.update', $district->id) }}" method="post" >
    @csrf
    @method('put')
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label text-end">Name English</label>
        <div class="col-sm-10">
            <input type="text" id="name" value="{{$district->name}}" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter Division  Name English">
            <span class="text-warning">{{ $errors->first('name') }}</span>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="name_bn" class="col-sm-2 col-form-label text-end">Name Bangla</label>
        <div class="col-sm-10">
            <input type="text" id="name_bn" value="{{$district->bn_name}}" name="name_bn" value="{{ old('bn_name') }}" class="form-control" placeholder="Enter Division  Name Bangla">
            <span class="text-warning">{{ $errors->first('bn_name') }}</span>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="trial_days" class="col-sm-2 col-form-label text-end">Division</label>
        <div class="col-sm-10">
            <select name="division_id" class="form-control" required>
                @foreach ($divisions as $division)
                    <option value="{{ $division->id }}" @if($division->id == $district->division_id) selected @endif> {{ $division->name }} </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="trial_days" class="col-sm-2 col-form-label text-end">Status</label>
        <div class="col-sm-10">
            <div class="form-check form-switch">
                <input type="checkbox" id="status" name="status" class="form-check-input input-group-lg" role="switch" checked style="height: 1.5rem; width: 2.7rem;">
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
