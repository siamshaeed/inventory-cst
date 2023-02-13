<div class="workshop-card" id="sample-card" hidden>
    <div class="row row-gutter">
        <div class="col-md-4 img-wrapper">
            <img class="wk-image" src="{{ asset('images/shop-logo.png') }}" alt="">
        </div>
        <div class="col-md-8 p-4">
            <div class="d-flex justify-content-between">
                <h2 class="wk-name">Workshop Name</h2>
                <div>
                    <svg xmlns="//www.w3.org/2000/svg" width="16" height="16" fill="#FFCB45"
                         class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                    </svg>
                    <span class="wk-rating">(4.5)</span>
                </div>
            </div>
            <div class="d-flex icon-img">
                <img src="{{ asset('images/location.svg') }}" alt="" class="location-modal"
                     data-bs-toggle="modal" data-bs-target="#locationModal">
                <p class="location-modal" data-bs-toggle="modal" data-bs-target="#locationModal">
                    Location
                </p>
                {{--                    <img src="{{ asset('images/call.svg') }}" alt="">--}}
                {{--                    <p class="wk-phone_number"></p>--}}

                <input type="hidden" class="location-lat-lng">
            </div>
            <div class="bottom-text">
                <button class="send-request-btn">Send Request</button> <span class="ms-2 wk-distance"></span>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel"
     aria-hidden="true">
    <div
            class="modal-dialog modal-dialog modal-dialog-centered modal-width  modal-xl modal-fullscreen-lg-down">
        <div class="modal-content my-modal-content pb-4">
            <div class="modal-header">
                <div class="my-modal-header">
                    <a href="#" target="_blank" class="me-2" id="map-link">Open in Google map</a>
                    <button type="button" class="btn-close close-button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
            </div>

            <div class="modal-body">
                <div id="modal-map" style="height: 400px; width: 100%;"></div>
            </div>
        </div>
    </div>
</div>