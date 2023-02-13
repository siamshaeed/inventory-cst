const workshopId = document.head.querySelector('meta[name="workshop_id"]').content
const locationDiv = document.getElementById('locationModal')
const modalMapSelector = document.getElementById("modal-map")
const mapLink = document.querySelector('#map-link')


if (workshopId) {
    Echo.private('workshop.' + workshopId)
        .listen('ServiceRequestEvent', function (e) {
            showNotification(e.user, e.serviceRequest)
        });
}


function showNotification(user, serviceRequest) {
    iziToast.show({
        id: 'show',
        title: 'New Request',
        icon: 'icon-drafts',
        displayMode: 0,
        message: user.name + ' has requested',
        position: 'topRight',
        // image: 'img/avatar.jpg',
        balloon: true,
        animateInside: false,
        timeout: 500000,
        color: 'white',

        buttons: [
            ['<button>View</button>', function (instance, toast) {
                showUserLocation(user, serviceRequest)
            }],
            ['<button>Accept</button>', function (instance, toast) {
                acceptRequest(instance, toast, serviceRequest, true)
            }],
            ['<button>Reject</button>', function (instance, toast) {
                acceptRequest(instance, toast, serviceRequest, false)
            }]
        ]
    });

}



function showUserLocation(user, serviceRequest) {
    initializeModalMap(user, serviceRequest)

    const userModal = new bootstrap.Modal(locationDiv, {});
    locationDiv.querySelector('#user-details').innerHTML = `Name: <b>${user?.name}</b>` +
        ` Phone number: <b>${user?.phone_number?user.phone_number:'N/A'}</b>`

    userModal.show()
}







function initializeModalMap(user, serviceRequest) {
    const position = serviceRequest.user_position
    mapLink.href = 'https://www.google.com/maps/search/?api=1&query=' + position.lat + '%2C' + position.lng

    const modalMap = new google.maps.Map(modalMapSelector, {
        center: new google.maps.LatLng(position.lat, position.lng),
        zoom: 18,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    const modalMarker = new google.maps.Marker({
        position: new google.maps.LatLng(position.lat, position.lng)
    });

    return modalMarker.setMap(modalMap);
}



function acceptRequest(instance, toast, serviceRequest, status) {
    const route = '/workshop-accept-request/' + serviceRequest.id
    axios.post(route, {
        status: status
    })
        .then((response) => {
            iziToast.show({
                title: 'Done',
                message: response?.data?.message,
                color: response?.data?.color,
                position: 'topRight'
            });

            instance.hide({ transitionOut: 'fadeOutUp' }, toast);
        })
        .catch((error) => {
            console.log(error)
        })
}
