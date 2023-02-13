$(document).ready(function () {
    let formConfig;
//Scripts for home page auto counter

    jQuery("#myDIV .item-link").click(function() {
        jQuery("#myDIV .item-link").removeClass('new-active');
        jQuery(this).toggleClass('new-active');
    });
    $(document).ready(function() {
        if (!$.browser?.webkit) {
            $('.wrapper').html('<p>Sorry! Non webkit users. :(</p>');
        }
    });



//    form submit


    /*$('form').submit(function (e) {
        e.preventDefault();
        setFormConfig(e.currentTarget)

        axios(formConfig)

        .then(response => {
            iziToast.success({
                title: 'Success',
                message: response?.data?.message ?
                    response.data.message : 'Operation successful',
                position: 'topRight'
            })
        })
        .catch(error => {
            iziToast.error({
                title: 'Error',
                message: error.response?.data?.message ?
                    error.response.data.message : 'Server Error',
                position: 'topRight'
            })
        })

    })*/




    function setFormConfig(form) {
        formConfig = {
            url: form.action,
            method: 'post',
            data: new FormData(form)
        }
    }


    $('.owl-two').owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        //   autoplay: true,
        // autoplayTimeout: 1000,
        // autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            }
        }
    })


})
