<script type="text/javascript">
    function update_service_status(id, tbl_name) {
        const check_id = document.getElementById("check"+id);

        check_value = (check_id.checked == true) ? 1 : 0 ;

        //console.log(check_value);
        //console.log(id);

        $.ajax({
            type: 'GET',
            url: "{{ url('status') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                'check_value': check_value,
                'data_id': id,
                'tbl_name': tbl_name,
            },

            success: function(response) {
                if(response.status == 400){
                    //alert(response.error);
                    "use strict";
                    iziToast.error({
                        message: response.error,
                        position: 'topRight'
                    });

                }else{
                    //alert(response.success);
                    "use strict";
                    iziToast.success({
                        message: response.success,
                        position: 'topRight'
                    });
                }
            }

        });
    }
</script>
