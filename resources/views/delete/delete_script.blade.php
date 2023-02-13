
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
    function deleteConfirm() {
        //alert('yes delete boss');
        //var name = $(this).data("name");

        event.preventDefault();
        swal({
            title: `Are you sure to delete this record?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                document.querySelector('#form_submit').submit()
            }
        });
    }
</script>

