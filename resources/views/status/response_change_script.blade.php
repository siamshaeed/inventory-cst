
<script>

    $(document).ready(function () {
        $(document).on('click', '.accept-btn', function () {
            acceptRequestFromTable(this)
        })

    })



    function acceptRequestFromTable(instance) {
        const route = '/workshop-accept-request/' + instance.dataset.id

        axios.post(route, {
            status: instance.dataset.status
        })
            .then((response) => {
                iziToast.show({
                    title: 'Done',
                    message: response?.data?.message,
                    color: response?.data?.color,
                    position: 'topRight'
                });

                $('#datatable').DataTable().draw(false);
            })
            .catch((error) => {
                console.log(error)
            })
    }
</script>
