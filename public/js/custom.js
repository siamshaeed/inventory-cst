$(document).ready(function () {
    const modalDiv = document.getElementById('base-modal')
    const bootstrapModal = new bootstrap.Modal(modalDiv, {});

    let method, route, data, config;
    let modal = {title: '', body: '', saveBtn: '', closeBtn: '', view: true}



    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    /*Start Sweetalert Script*/
    $('.show_confirm').click(function(event) {
        var form =  $(this).closest("form");
        var name = $(this).data("name");
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
                    form.submit();
                }
            });
    });
    /*End Sweetalert Script*/


    jQuery("#myDiv .main-link").click(function() {
        jQuery("#myDiv .main-link").removeClass('bar-active');
        jQuery(this).toggleClass('bar-active');
    });



    //For delete, status update or other actions without having any view

    $(document).on('click', '.action-btn', function (e) {
        if (e.currentTarget.dataset?.alert) {
            callMethodWithAlert(e.currentTarget)
            return
        }

        callActionMethod(e.currentTarget)
    })



    function callMethodWithAlert(element) {
        const alertTitle = element.dataset?.alert_title ? element.dataset?.alert_title : 'Are you sure?'

        const title = element?.title ? element.title : element.dataset?.bsOriginalTitle

        const alertMsg = element.dataset?.alert_msg ? element.dataset.alert_msg
            : 'Do you want to ' + title.toLowerCase() + ' this record?'

        Swal.fire({
            title: alertTitle,
            text: alertMsg,
            showDenyButton: true,
            confirmButtonText: 'Yes',
        }).then(response => {
            if (response.isConfirmed) {
                callActionMethod(element)
            }
        })

    }



    function setConfig(target) {
        method = target.dataset?.method ? target.dataset.method : 'post'
        route = target.dataset.route
        data = target.dataset

        config = {method: method, url: route, data: data}

        if (method === 'get') {
            config.params = data
        }
    }



    function callActionMethod(element) {
        setConfig(element)

        axios(config)
            .then(response => {
                successResponse(response)
            })
            .catch(error => {
                errorResponse(error.response)
            })
    }


    function successResponse(response) {
        console.log(response.data)

        iziToast.success({
            title: 'Success',
            message: response?.data?.message ? response?.data?.message : 'Operation successful',
            position: 'topRight'
        })

        $.modalCallBackOnAnyChange()
    }


    function errorResponse(response) {
        console.log(response)

        iziToast.error({
            title: 'Error',
            message: response?.data?.message ? response?.data?.message : 'Server Error',
            position: 'topRight'
        })
    }

    //Action buttons end --/>



    //For showing details/form in modal
    $(document).on('click', '.show-modal', function (e) {
        setConfig(e.currentTarget)

        axios(config)
            .then(response => {
                showModal(response.data, e.currentTarget)
            })
            .catch(error => {
                errorResponse(error)
            })

    })



    function showModal(body, target) {
        modalDiv.querySelector('.modal-body').innerHTML = body
        modalDiv.querySelector('.modal-title').innerHTML = target.dataset?.modal_title ? target.dataset?.modal_title : 'Details'
        //modalDiv.querySelector('.modal-btn-save').hidden = target.dataset?.action == 'view'

        //alert(body)
        //alert(target.dataset.modal_title)

        bootstrapModal.show()
    }


    $(document).on('click', '.modal-btn-close', function (e) {
        bootstrapModal.hide()
    })


    /*Start Form Submit - Define By Nasim*/
    /*$('.modal_form_submit').click(function(e) {
        var form = $('#addFormData');
        e.preventDefault();
        form.submit();
    });*/
    /*End Form Submit*/


})




