<div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
    <div
            class="modal-dialog modal-dialog modal-dialog-centered modal-width  modal-xl modal-fullscreen-lg-down">
        <div class="modal-content my-modal-content pb-4">
            <div class="modal-header">
                <div id="user-details"></div>
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


<div class="modal" tabindex="-1" role="dialog" id="base-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close modal-btn-close btn-close" data-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer justify-content-between-">
                {{--<button type="button" class="btn btn-primary modal-btn-save modal_form_submit"><i class="fa fa-save"></i> Save Changes</button>--}}
                <div>
                    <button type="button" class="btn btn-secondary modal-btn-close" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
