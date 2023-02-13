<form method="POST" action="{{ route('destroy') }}">

    @if(($tbl_name != 'purchase_dues') && ($tbl_name != 'sale_payments') && ($tbl_name != 'purchase_items'))
        {{--Edit Button--}}
        @include('action.edit_button')
    @endif

    @if(($tbl_name != 'purchases') && ($tbl_name != 'orders'))
        {{--Destroy Button--}}
        @include('action.destroy_button')
    @endif

</form>
