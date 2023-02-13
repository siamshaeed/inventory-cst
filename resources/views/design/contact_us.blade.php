@extends('layouts.navbar')
@section('content')
    <!-- banner part star -->
    <div class="blog-banner">
        <div class="banner-overlay blog-banner-content" style="height: 400px">
            <h2 class="text-center">Contact US</h2>
        </div>
    </div>
    <div class="container section-margin" style="margin-bottom: 100px">
        <div class="row" style="gap:30px;">
            <div class="col-md-4">
                <div class="contact-card-container">
                    <div class="contact-card">
                        <div class="d-flex gap-3">
                            <div class="contact-img">
                                <img src="{{ asset('images/call.svg') }}" alt="">
                            </div>
                            <div>
                                <h3>Call Now</h3>
                                <p>908-836-8652</p>
                            </div>
                        </div>
                    </div>
                    <div class="contact-card">
                        <div class="d-flex gap-3">
                            <div class="contact-img">
                                <img src="{{ asset('images/email.svg') }}" alt="">
                            </div>
                            <div>
                                <h3>Drop Mail</h3>
                                <p>info@hms.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="contact-card">
                        <div class="d-flex gap-3">
                            <div class="contact-img" style="width: 56px">
                                <img src="{{ asset('images/glob.svg') }}" alt="">
                            </div>
                            <div>
                                <h3>Find Us</h3>
                                <p>4065 Beechwood Avenue,
                                Belleville, USA.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-8 details-left" style="width:64% ;">
                <div class="comment-section message-section">
                    <h2 class="mt-0 mb-4">Send Message</h2>
                    <form action="" class="message-form">
                        <div class="d-flex user-info gap-3 mini-card-container">
                            <div class="w-100">
                                <label for="">First Name</label>
                                <input type="text" class="mt-3" name="" id="" placeholder="Enter your first name">
                            </div>
                            <div class="w-100">
                                <label for="">Last Name</label>
                                <input type="text" class="mt-3" name="" id="" placeholder="Enter your last name">
                            </div>
                        </div>
                        <div class="user-info">
                            <label for="" class="d-block">Email</label>
                            <input type="email" class="mt-3" name="" id="" placeholder="Enter your email">
                        </div>
                        <div>
                            <label for="">Message</label>
                            <textarea name="" id="" cols="30" rows="10" class="mb-0" placeholder="Write your message here"></textarea>
                        </div>
                       <div>
                           <input type="checkbox" name="" id="">
                           <label for="">Save my name, email in this browser for the next time</label>
                       </div>
                        <button class="mt-4">Send Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="mapouter">
        <div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas"
               src="https://maps.google.com/maps?q=bangladesh&t=&z=13&ie=UTF8&iwloc=&output=embed"
                frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a
                href="https://2piratebay.org">pirate bay</a><br>
            <style>
                .mapouter {
                    position: relative;
                    text-align: right;
                    height: 500px;
                    width: 100%;
                }
            </style><a href="https://www.embedgooglemap.net">create custom map free</a>
            <style>
                .gmap_canvas {
                    overflow: hidden;
                    background: none !important;
                    height: 500px;
                    width:100%;
                }
            </style>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- @include('frontend.workshops.script-search-workshop') --}}
    @include('frontend.workshops.scripts.nearest-workshop-script')
@endpush

