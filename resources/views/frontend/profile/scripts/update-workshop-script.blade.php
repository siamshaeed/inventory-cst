<script>
    $(document).ready(function(){
        const currentForm = document.getElementById('current-form')

        currentForm.addEventListener('submit', submitForm)

        function submitForm() {
            event.preventDefault()
            const route = "{{route('workshop.info')}}"
            const formData = new FormData(event.currentTarget)
            const errorsDiv = document.querySelectorAll(".errors")


            axios.post(route, formData)
                .then(response => {
                    showErrors()

                    iziToast.success({
                        message: response.data.message,
                        position: 'topRight'
                    })
                })
                .catch(error => {
                    iziToast.error({
                        message: 'Please check all required fields',
                        position: 'topRight'
                    })
                    showErrors(error.response.data?.errors)
                })


            function showErrors(formErrors = []) {
                errorsDiv.forEach(function (item) {
                    item.innerHTML = formErrors?.[item.dataset.name] ? formErrors[item.dataset.name].pop() : ''
                })
            }

        }


    });

    function profileImage(event) {
        var src = URL.createObjectURL(event.target.files[0]);
        var ProfleImage = "<img style='height: 80px; width: 80px;'  src='"+ src +"'>";
        $("#ProfleImage").html(ProfleImage);
    }
</script>