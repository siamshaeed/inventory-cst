
{{-- Common-Use: Pdf Download Button --}}
@if(!$all_date)
    {{--For StartDate and EndDate--}}
    <input type="hidden" name="start_date" value="{{ $start_date }}">
    <input type="hidden" name="end_date" value="{{ $end_date }}">
@endif

@if($all_date)
    {{--For All Time--}}
    <input type="hidden" name="date" value="{{ $all_date }}">
@endif

{{--For Pdf Download--}}
<input type="hidden" name="pdf" value="download">

<button class="ms-1 btn btn-sm btn-danger text-white" data-bs-toggle="tooltip" title="PDF Download">
    <i class="fa fa-file-pdf"></i> PDF
</button>



