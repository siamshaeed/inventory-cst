
{{-- workshop logo show --}}
@if(is_null($logo_check))
    <img src="{{ asset('images/workshop/logo/workshop_logo.png') }}" alt="Logo" class="img-thumbnail" width="50" height="50">
@else
    <img src="{{ $logo }}" alt="Logo" class="img-thumbnail" width="50" height="50">
@endif
