const userId = document.head.querySelector('meta[name="user_id"]').content
const modalSelector = document.getElementById('locationModal')


if (userId) {
    Echo.private('user.' + userId)
        .listen('ServiceResponseEvent', function (e) {
            showNotification(e.serviceRequest)
            updateButtons(e.serviceRequest)
        });
}


function showNotification(serviceRequest) {
    const isAccepted = serviceRequest.status == 1

    iziToast.show({
        title: isAccepted ? 'Accepted' : 'Rejected',
        message: isAccepted ? "Your request has been accepted" : "Workshop didn't accept your request",
        position: 'topRight',
        timeout: 500000,
        color: isAccepted ? 'white' : 'red',
        buttons: [
            [`<button>${isAccepted?'SHOW':'OK'}</button>`, function (instance, toast) {
                !isAccepted ? instance.hide({ transitionOut: 'fadeOutUp' }, toast)
                    : showDirection(serviceRequest, instance, toast)

            }],
        ]
    });

}




function updateButtons(serviceRequest) {
    const requestButton = document.querySelectorAll('.send-request-btn')

    requestButton.forEach(x => {
        if (!x.dataset.workshop_id) return

        if (serviceRequest.status == 1) {
            x.disabled = true

            if (x.dataset.workshop_id == serviceRequest.workshop_id) {
                x.style.backgroundColor = '#3de652'
                x.innerHTML = 'Accepted'
                return;
            }

            x.style.backgroundColor = '#FFF5E3'
            x.innerHTML = 'Send Request'

        }



        if (serviceRequest.status == 2) {
            if (x.dataset.workshop_id == serviceRequest.workshop_id) {
                x.disabled = true
                x.style.backgroundColor = '#dc3545'
                x.innerHTML = 'Rejected'
                return;
            }


            x.disabled = false
            x.style.backgroundColor = '#E6AB3D'
            x.innerHTML = 'Send Request'
        }


    })
}




function showDirection(s, i, t) {
    i.hide({ transitionOut: 'fadeOutUp' }, t)
    window.open('/workshop-details?sid=' + s.id, '_blank')
}