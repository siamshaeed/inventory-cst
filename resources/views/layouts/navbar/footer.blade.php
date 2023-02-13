<div class="text-dark pb-2 pt-5 my-footer" id="footer">

    <form action="{{route('subscribe')}}" method="POST">
        @csrf

        <div class="subscribe-container d-flex container justify-content-around">
            <div class="text-part">
                <h2 class="text-start">Subscribe To Our Newsletter</h2>
                <p>Join our subscribers to get the latest news, updates and
                    special offers.</p>
            </div>
            <div class="search-box">
                <div class="input-group mb-3 my-input-group">
                    <input type="text" class="py-2" name="email"
                           placeholder="Email" aria-label=""
                           aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="newsletter-button" type="submit">Subscribe Now</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <div class="my-grid container">
        <div class="text-start grid-item">
            <div class="footer-logo">
                <img src="{{ asset('images/logo.svg') }}" alt="" class="d-inline-block align-text-top">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Neque viverra et lectus suspendisse
                    dictumst. </p>
            </div>
            <div class="icon">
                <i class="fab fa-facebook-f"></i>
                <i class="fab fa-twitter"></i>
                <i class="fab fa-google-plus-g"></i>
            </div>
        </div>
        <div class=" text-start grid-item">
            <h3>Quick Link</h3>
            <div class="link-item">
                <a href="/guide" class="text-decoration-none text-dark">
                    <li>Home</li>
                </a>
                <a href="/guide" class="text-decoration-none text-dark">
                    <li>Services</li>
                </a>
                <a href="/guide" class="text-decoration-none text-dark">
                    <li>About Us</li>
                </a>
                <a href="/guide" class="text-decoration-none text-dark">
                    <li>Contact Us</li>
                </a>
            </div>
        </div>
        <div class="text-start grid-item">
            <h3>Services</h3>
            <div class="link-item">
                <a href="/guide" class="text-decoration-none text-dark">
                    <li>Car Servicing</li>
                </a>
                <a href="/guide" class="text-decoration-none text-dark">
                    <li>Bike Servicing</li>
                </a>
                <a href="/guide" class="text-decoration-none text-dark">
                    <li>Engine Works</li>
                </a>
                <a href="/guide" class="text-decoration-none text-dark">
                    <li>Mechanical System</li>
                </a>
            </div>
        </div>
        <div class="text-start grid-item">
            <h3>Contact info</h3>
            <div class="link-item contact-info">

                <div class="d-flex contact-gap"><img src="{{ asset('images/email.svg') }}" alt="">
                    <li>Driverkhuji@info.com</li>
                </div>
                <div class="d-flex contact-gap"><img src="{{ asset('images/call.svg') }}" alt="">
                    <li>01737835825</li>
                </div>
                <div class="d-flex contact-gap"><img src="{{ asset('images/location.svg') }}" alt="">
                    <li>Planners Tower, Bangla Motor,Dhaka</li>
                </div>

            </div>
        </div>
    </div>
    <div class="" style="margin-top: 100px">
        <hr>
        <p class="text-center">&reg; 2021 All rights reserved</p>
    </div>
</div>
