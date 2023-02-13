
{{-- Product Image Show --}}
@if($logo_check == 'blank_product.jpg')
    <img src="{{ asset('images/product/logo/blank_product.jpg') }}" alt="Logo" class="img-thumbnail" width="50" height="50">
@else
    <img src="{{ $logo }}" alt="Logo" class="img-thumbnail" width="50" height="50">
@endif



