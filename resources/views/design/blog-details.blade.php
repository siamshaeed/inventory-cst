@extends('layouts.navbar')
@section('content')
    <!-- banner part star -->
    <div class="blog-banner">
        <div class="banner-overlay">
            <div class="container d-flex flex-column">
                <div class="blog-banner-content" style="height: 400px">
                    <h2 class="text-center">Blog Details</h2>
                    <div class="route"><a href="">Home </a><span>/</span><a href="">Blog Details</a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container section-margin">
        <h3 class="section-title" style="font-size: 24px">News and Blogs</h3>
        <div class="row blog-content">
            <div class="col-md-8 blog-left">

                <div class="details-card">
                    <div class="details-blog-img">
                        <img src="{{ asset('images/blog1.jpg') }}" alt="">
                    </div>
                    <div class="blog-details" style="padding: 0px 15px;">
                        <h4 class="my-4">The Best Service for your Dream Car</h4>
                        <div class="blog-author">
                            <img src="{{ asset('images/user2.jpg') }}" alt="" class="user-img">
                            <p class="mb-0">Admin</p>
                            <span>17 Jan 2022</span>
                        </div>
                        <div class="content-center">
                            <div>
                                <img src="{{ asset('images/icon/user.svg') }}" alt="">
                                <span>Isfat Sharik</span>
                            </div>
                            <div>
                                <img src="{{ asset('images/icon/sms.svg') }}" alt="">
                                <span>10 Comments</span>
                            </div>
                            <div>
                                <img src="{{ asset('images/icon/category.svg') }}" alt="">
                                <span>Marketing</span>
                            </div>
                        </div>
                        <p class="blog-details-text">In vehicula tellus diam condimentum amet. Donec lobortis sit interdum
                            mattis vehiculPurus, dui metus, eget faucibus nunc nulla arcu quis nullam. Blandit vel malesuada
                            proineuismod. Id viverra ut fringilla sit sem fames tellus. Tincidunt auctor vel nullam semper
                            dignissim Felis sodales adipiscing quis et porta fermentum.
                            <br> <br>
                            In vehicula tellus diam condimentum amet. Donec lobortis sit interdum mattis vehiculPurus,
                            dui metus, eget faucibus nunc nulla arcu quis nullam. Blandit vel malesuada proineuismod. Id
                            viverra ut fringilla sit sem fames tellus.
                            <br> <br>
                            In vehicula tellus diam condimentum amet. Donec lobortis sit interdum mattis vehiculPurus,
                            dui metus, eget faucibus nunc nulla arcu quis nullam. Blandit vel malesuada proineuismod. Id
                            viverra ut fringilla sit sem fames tellus. Tincidunt auctor vel nullam semper dignissim Felis
                            sodales adipiscing quis et porta fermentum.
                        </p>
                        <img src="{{ asset('images/blog6.jpg') }}" alt="" class="blog-img2">
                        <h5 class="my-3">Secure you home by using CCTV</h5>
                        <p class="blog-details-text">In vehicula tellus diam condimentum amet. Donec lobortis sit interdum
                            mattis vehiculPurus, dui metus, eget faucibus nunc nulla arcu quis nullam. Blandit vel malesuada
                            proineuismod. Id viverra ut fringilla sit sem fames tellus. Tincidunt auctor vel nullam semper
                            dignissim Felis sodales adipiscing quis et porta fermentum.
                        </p>
                        <div class="d-flex gap-4 my-4">
                            <img src="{{ asset('images/blog7.svg') }}" alt="" class="blog-img3">
                            <p class="blog-details-text">In vehicula tellus diam condimentum amet. Donec lobortis sit
                                interdum
                                mattis vehiculPurus, dui metus, eget faucibus nunc nulla arcu quis nullam. Blandit vel
                                malesuada
                                proineuismod. Id viverra ut fringilla sit sem fames tellus. Tincidunt auctor vel nullam
                                semper
                                dignissim Felis sodales adipiscing quis et porta fermentum.
                            </p>
                        </div>
                        <p class="blog-details-text">Et, venenatis et egestas malesuada duis fermentum venenatis
                            pellentesque pulvinarNeque aliquet
                            tristique vitae vitae, pharetra amet, dictum. Vitae quis augue netus orci iacutempor euismod at
                            iaculis. Volutpat risus, dui egestas tempor. Etiam enim a blandit velit velEleifend ac nunc
                            viverra sed porttitor. Cursus nunc egestas enim lacus fermentum sodales. At purus viverra proin.
                            Amet, etiam amet.</p>
                        <hr>
                    </div>

                    <div style="padding: 0px 15px;">
                        <div class="d-flex justify-content-between mt-4">
                            <div class="related-tag gap-2">
                                <a href="">Popular</a>
                                <a href="">Security</a>
                                <a href="">Popular</a>
                                <a href="">Security</a>
                                <a href="">Popular</a>
                                <a href="">Security</a>
                            </div>
                            <div class="social-contact2">
                                <div class="icon-container" style="gap: 10px">
                                    <a href="">
                                        <svg width="12" height="10" viewBox="0 0 20 17" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M20 1.93007C19.2645 2.24734 18.4641 2.47567 17.6397 2.56461C18.4956 2.0561 19.1366 1.25274 19.4424 0.305262C18.6392 0.783063 17.7593 1.11811 16.8417 1.29553C16.4582 0.885544 15.9944 0.558933 15.4792 0.336045C14.9639 0.113158 14.4083 -0.0012301 13.8469 9.97573e-06C11.5755 9.97573e-06 9.74883 1.84114 9.74883 4.10048C9.74883 4.41775 9.78729 4.73502 9.84978 5.04027C6.44874 4.86241 3.41546 3.2376 1.39887 0.74992C1.03143 1.37753 0.838874 2.09213 0.841245 2.81938C0.841245 4.24229 1.56472 5.49695 2.66795 6.23484C2.0178 6.20923 1.38287 6.03053 0.814806 5.71327V5.76374C0.814806 7.75629 2.22329 9.40753 4.10047 9.7873C3.74801 9.87885 3.38543 9.92568 3.02127 9.9267C2.75448 9.9267 2.5021 9.90026 2.24733 9.86421C2.76649 11.489 4.27833 12.6692 6.0786 12.7076C4.67011 13.8109 2.9059 14.4598 0.990266 14.4598C0.646557 14.4598 0.329287 14.4478 0 14.4093C1.81709 15.5751 3.97308 16.2481 6.29492 16.2481C13.8325 16.2481 17.957 10.0036 17.957 4.58359C17.957 4.40573 17.957 4.22787 17.945 4.05C18.7429 3.46594 19.4424 2.74247 20 1.93007Z"
                                                fill="#E6AB3D" />
                                        </svg>
                                    </a>
                                    <a href="">
                                        <svg width="12" height="12" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.1111 20H6.66667V6.66667H11.1111V8.88889C11.579 8.29363 12.1728 7.8093 12.85 7.47062C13.5271 7.13195 14.2708 6.94733 15.0278 6.93C16.3515 6.93735 17.6184 7.46936 18.5505 8.40937C19.4826 9.34938 20.0038 10.6207 20 11.9444V20H15.5556V12.5C15.4696 11.8995 15.1696 11.3503 14.7109 10.9534C14.2521 10.5565 13.6655 10.3387 13.0589 10.34C12.7874 10.3486 12.5204 10.4119 12.274 10.5262C12.0276 10.6405 11.8068 10.8034 11.6249 11.0051C11.443 11.2069 11.3037 11.4433 11.2155 11.7001C11.1272 11.957 11.0917 12.2291 11.1111 12.5V20ZM4.44444 20H0V6.66667H4.44444V20ZM2.22222 4.44444C1.63285 4.44444 1.06762 4.21032 0.650874 3.79357C0.234126 3.37682 0 2.81159 0 2.22222C0 1.63285 0.234126 1.06762 0.650874 0.650874C1.06762 0.234126 1.63285 0 2.22222 0C2.81159 0 3.37682 0.234126 3.79357 0.650874C4.21032 1.06762 4.44444 1.63285 4.44444 2.22222C4.44444 2.81159 4.21032 3.37682 3.79357 3.79357C3.37682 4.21032 2.81159 4.44444 2.22222 4.44444Z"
                                                fill="#E6AB3D" />
                                        </svg>
                                    </a>
                                    <a href="">
                                        <svg width="12" height="12" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M19.9024 5.90309C19.8912 5.06334 19.734 4.23193 19.4379 3.44606C19.181 2.78318 18.7887 2.18117 18.286 1.67849C17.7834 1.17581 17.1813 0.783514 16.5185 0.526666C15.7427 0.235455 14.9231 0.0779923 14.0947 0.0609825C13.0281 0.0133053 12.6899 0 9.98226 0C7.27464 0 6.9276 7.43489e-08 5.86872 0.0609825C5.04065 0.0781174 4.22148 0.235578 3.44606 0.526666C2.78308 0.783335 2.18098 1.17557 1.67827 1.67827C1.17557 2.18097 0.783334 2.78308 0.526666 3.44606C0.234872 4.22124 0.0777505 5.04059 0.0620911 5.86872C0.014414 6.93647 0 7.27464 0 9.98226C0 12.6899 -8.26098e-09 13.0358 0.0620911 14.0958C0.0787227 14.9252 0.235059 15.7434 0.526666 16.5207C0.783765 17.1835 1.17629 17.7853 1.67916 18.2878C2.18203 18.7903 2.78419 19.1824 3.44717 19.439C4.22046 19.7419 5.03977 19.9106 5.86983 19.9379C6.93758 19.9856 7.27575 20 9.98337 20C12.691 20 13.038 20 14.0969 19.9379C14.9253 19.9216 15.7449 19.7645 16.5207 19.4733C17.1834 19.2162 17.7852 18.8238 18.2879 18.3211C18.7905 17.8185 19.1829 17.2166 19.4401 16.5539C19.7317 15.7778 19.888 14.9595 19.9046 14.1291C19.9523 13.0624 19.9667 12.7242 19.9667 10.0155C19.9645 7.30791 19.9645 6.96419 19.9024 5.90309ZM9.97561 15.1026C7.14381 15.1026 4.84976 12.8085 4.84976 9.97672C4.84976 7.14492 7.14381 4.85087 9.97561 4.85087C11.3351 4.85087 12.6388 5.39091 13.6001 6.3522C14.5614 7.31348 15.1015 8.61726 15.1015 9.97672C15.1015 11.3362 14.5614 12.64 13.6001 13.6012C12.6388 14.5625 11.3351 15.1026 9.97561 15.1026ZM15.3055 5.85653C14.6435 5.85653 14.1102 5.3221 14.1102 4.66127C14.1102 4.50438 14.1411 4.34903 14.2012 4.20408C14.2612 4.05913 14.3492 3.92743 14.4601 3.81649C14.5711 3.70555 14.7028 3.61755 14.8477 3.55751C14.9927 3.49747 15.148 3.46657 15.3049 3.46657C15.4618 3.46657 15.6172 3.49747 15.7621 3.55751C15.9071 3.61755 16.0388 3.70555 16.1497 3.81649C16.2606 3.92743 16.3486 4.05913 16.4087 4.20408C16.4687 4.34903 16.4996 4.50438 16.4996 4.66127C16.4996 5.3221 15.9652 5.85653 15.3055 5.85653Z"
                                                fill="#E6AB3D" />
                                            <path
                                                d="M9.97612 13.3058C11.815 13.3058 13.3058 11.815 13.3058 9.97612C13.3058 8.13721 11.815 6.64648 9.97612 6.64648C8.13721 6.64648 6.64648 8.13721 6.64648 9.97612C6.64648 11.815 8.13721 13.3058 9.97612 13.3058Z"
                                                fill="#E6AB3D" />
                                        </svg>
                                    </a>
                                    <a href="">
                                        <svg width="6" height="12" viewBox="0 0 11 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.945 20V11.166H0V7.485H2.945V4.54C2.945 1.497 4.871 0 7.585 0C8.885 0 10.003 0.0970001 10.329 0.14V3.32H8.446C6.97 3.32 6.626 4.023 6.626 5.052V7.485H10.306L9.57 11.165H6.626L6.685 20"
                                                fill="#E6AB3D" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="comment-container">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed accordion-head-button" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            Comments
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="d-flex gap-2 mt-3" style="margin-left: 15px">
                                                <img src="{{ asset('images/images.jpg') }}" alt="">
                                                <div>
                                                    <div class="d-flex review-user gap-3">
                                                        <h4>Isfat Sharik</h4>
                                                        <div id="reply"><img src="{{ asset('images/rep.svg') }}"
                                                                alt=""><span class="ms-2">Reply</span>
                                                        </div>
                                                    </div>
                                                    <a class="review-date" href="#">
                                                        <i class="far fa-calendar-alt me-1"></i>
                                                        March 27, 2022
                                                    </a>
                                                    <p>Et a sed pharetra, arcu. Volutpat aliquam feugiat netus faucibus
                                                        etiam
                                                        enim. Spien sed ut vel arcu faucibus. Posuere tortor tellus quis
                                                        condimentum et. In in et viverra elementum pharetra consectetur sed
                                                        cursus et.</p>
                                                    <div class="d-flex gap-3" id="replyUser">
                                                        <div class="reply-user-img">
                                                            <img src="{{ asset('images/user.jpg') }}" alt="">
                                                        </div>
                                                        <div class="d-flex review-user flex-column">
                                                            <h3 style="font-size: 16px">Isfat Sharik</h3>
                                                            <a class="review-date" href="#">
                                                                <i class="far fa-calendar-alt me-1"></i>
                                                                March 27, 2022
                                                            </a>
                                                            <p>Et a sed pharetra, arcu. Volutpat aliquam feugiat netus
                                                                faucibus
                                                                etiam
                                                                enim. Spien sed ut vel arcu faucibus. Posuere tortor tellus
                                                                quis
                                                                condimentum et. In in et viverra elementum pharetra
                                                                consectetur sed
                                                                cursus et.</p>
                                                        </div>
                                                    </div>
                                                    <div id="replyBox">
                                                        <textarea name="" id="new-comment" cols="50" rows="2" placeholder="Reply"></textarea>
                                                        <br>
                                                        <button id="submit-comment">Reply</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="comment-section mb-4">
                            <h4>Add Comment</h4>
                            <form method="POST" action="">
                                <textarea name="details" id="details" cols="30" rows="10" placeholder="Write your comment here" required></textarea>

                                <button type="submit">Post Comment</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-4 blog-right">
                <div class="search-section" id="search2">
                    <h4 class="mb-3">Search Bar</h4>
                    <div class="input-group">
                        <input type="text" class="" placeholder="Search" aria-label="Search"
                            aria-describedby="basic-addon2">
                        <div class="input-group-append search-btn">
                            <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.7824 13.8354L12.6666 10.7195C12.5259 10.5789 12.3353 10.5008 12.1353 10.5008C11.9283 10.5008 11.8093 10.2601 11.9236 10.0876C12.6051 9.05958 13.001 7.8271 13.001 6.50048C13.001 2.90959 10.0914 0 6.50048 0C2.90959 0 0 2.90959 0 6.50048C0 10.0914 2.90959 13.001 6.50048 13.001C7.8271 13.001 9.05958 12.6051 10.0876 11.9236C10.2601 11.8093 10.5008 11.9283 10.5008 12.1353C10.5008 12.3353 10.5789 12.5259 10.7195 12.6666L13.8354 15.7824C14.1292 16.0762 14.6042 16.0762 14.8948 15.7824L15.7793 14.898C16.0731 14.6042 16.0731 14.1292 15.7824 13.8354ZM6.50048 10.5008C4.29094 10.5008 2.50018 8.71314 2.50018 6.50048C2.50018 4.29094 4.28781 2.50018 6.50048 2.50018C8.71001 2.50018 10.5008 4.28781 10.5008 6.50048C10.5008 8.71001 8.71314 10.5008 6.50048 10.5008Z"
                                    fill="white" />
                            </svg>

                        </div>
                    </div>
                </div>

                <div class="gallery-section">
                    <h4>Photo Gallary</h4>
                    <div class="image-container">
                        <div class="owl-carousel owl-theme owl-three">
                            <div class="item column">
                                <img src="{{ asset('images/blog1.jpg') }}" alt="" onclick="openModal();currentSlide(1)"
                                    class="hover-shadow">
                            </div>
                            <div class="item column">
                                <img src="{{ asset('images/blog2.jpg') }}" alt="" onclick="openModal();currentSlide(2)"
                                    class="hover-shadow">
                            </div>
                            <div class="item column">
                                <img src="{{ asset('images/blog4.jpg') }}" alt="" onclick="openModal();currentSlide(3)"
                                    class="hover-shadow">
                            </div>
                            <div class="item column">
                                <img src="{{ asset('images/blog5.jpg') }}" alt="" onclick="openModal();currentSlide(4)"
                                    class="hover-shadow w-100">
                            </div>
                        </div>
                    </div>
                    <!-- The Modal/Lightbox -->
                    <div id="myModal" class="modal">
                        <span class="close cursor" onclick="closeModal()">&times;</span>
                        <div class="modal-content">

                            <div class="mySlides">
                                <div class="numbertext">1 / 4</div>
                                <img src="{{ asset('images/blog1.jpg') }}">
                            </div>

                            <div class="mySlides">
                                <div class="numbertext">2 / 4</div>
                                <img src="{{ asset('images/blog2.jpg') }}">
                            </div>

                            <div class="mySlides">
                                <div class="numbertext">3 / 4</div>
                                <img src="{{ asset('images/blog4.jpg') }}">
                            </div>

                            <div class="mySlides">
                                <div class="numbertext">4 / 4</div>
                                <img src="{{ asset('images/blog5.jpg') }}">
                            </div>

                            <!-- Next/previous controls -->
                            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                            <a class="next" onclick="plusSlides(1)">&#10095;</a>

                            <!-- Caption text -->
                            <!-- <div class="caption-container">
                                                                            <p id="caption"></p>
                                                                        </div> -->


                        </div>
                        <!-- Thumbnail image controls -->
                        <div class="owl-carousel owl-theme owl-thum">
                            <div class="item column">
                                <img class="demo" src="{{ asset('images/blog1.jpg') }}"
                                    onclick="currentSlide(1)" alt="Nature">
                            </div>

                            <div class="item column">
                                <img class="demo" src="{{ asset('images/blog2.jpg') }}"
                                    onclick="currentSlide(2)" alt="Snow">
                            </div>

                            <div class="item column">
                                <img class="demo" src="{{ asset('images/blog4.jpg') }}"
                                    onclick="currentSlide(3)" alt="Mountains">
                            </div>

                            <div class="item column">
                                <img class="demo w-100" src="{{ asset('images/blog5.jpg') }}"
                                    onclick="currentSlide(4)" alt="Lights">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- gallery part end -->
                <div class="recent-blog">
                    <h4 class="mb-4">Recent News & Blog</h4>
                    <div class="recent-blog-container">
                        <div class="d-flex gap-3 single-post">
                            <div class="post-img">
                                <img src="{{ asset('images/blog4.jpg') }}" alt="">
                            </div>
                            <div>
                                <a href="{{ route('design.blog-details') }}">Get the best car service</a>
                                <div class="date-section">
                                    <span>25 May 2022</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-3 single-post">
                            <div class="post-img">
                                <img src="{{ asset('images/blog4.jpg') }}" alt="">
                            </div>
                            <div>
                                <a href="{{ route('design.blog-details') }}">Get the best car service</a>
                                <div class="date-section">
                                    <span>25 May 2022</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-3 single-post">
                            <div class="post-img">
                                <img src="{{ asset('images/blog4.jpg') }}" alt="">
                            </div>
                            <div>
                                <a href="{{ route('design.blog-details') }}">Get the best car service</a>
                                <div class="date-section">
                                    <span>25 May 2022</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blog-catagory">
                    <h4 class="mb-3">Top Catgories</h4>
                    <div class="catagory-container">
                        <div class="d-flex justify-content-between">
                            <a href="">Business and planing</a> <span>13</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="">Finance and Banking</a> <span>13</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="">Digital Security</a> <span>13</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="">Marketing Policy</a> <span>13</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="">Marketing Policy</a> <span>13</span>
                        </div>
                    </div>
                </div>
                <div class="tags-section">
                    <h4>Tags</h4>
                    <div class="tag-container">
                        <a href="">Learning</a>
                        <a href="">UI Design</a>
                        <a href="">Diploma</a>
                        <a href="">Course</a>
                        <a href="">Diploma</a>
                        <a href="">Video Edit</a>
                        <a href="">Development</a>
                    </div>
                </div>
                <div class="social-contact">
                    <h4 class="mb-3">Follow Us</h4>
                    <div class="icon-container">
                        <a href="">
                            <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20 1.93007C19.2645 2.24734 18.4641 2.47567 17.6397 2.56461C18.4956 2.0561 19.1366 1.25274 19.4424 0.305262C18.6392 0.783063 17.7593 1.11811 16.8417 1.29553C16.4582 0.885544 15.9944 0.558933 15.4792 0.336045C14.9639 0.113158 14.4083 -0.0012301 13.8469 9.97573e-06C11.5755 9.97573e-06 9.74883 1.84114 9.74883 4.10048C9.74883 4.41775 9.78729 4.73502 9.84978 5.04027C6.44874 4.86241 3.41546 3.2376 1.39887 0.74992C1.03143 1.37753 0.838874 2.09213 0.841245 2.81938C0.841245 4.24229 1.56472 5.49695 2.66795 6.23484C2.0178 6.20923 1.38287 6.03053 0.814806 5.71327V5.76374C0.814806 7.75629 2.22329 9.40753 4.10047 9.7873C3.74801 9.87885 3.38543 9.92568 3.02127 9.9267C2.75448 9.9267 2.5021 9.90026 2.24733 9.86421C2.76649 11.489 4.27833 12.6692 6.0786 12.7076C4.67011 13.8109 2.9059 14.4598 0.990266 14.4598C0.646557 14.4598 0.329287 14.4478 0 14.4093C1.81709 15.5751 3.97308 16.2481 6.29492 16.2481C13.8325 16.2481 17.957 10.0036 17.957 4.58359C17.957 4.40573 17.957 4.22787 17.945 4.05C18.7429 3.46594 19.4424 2.74247 20 1.93007Z"
                                    fill="#E6AB3D" />
                            </svg>
                        </a>
                        <a href="">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.1111 20H6.66667V6.66667H11.1111V8.88889C11.579 8.29363 12.1728 7.8093 12.85 7.47062C13.5271 7.13195 14.2708 6.94733 15.0278 6.93C16.3515 6.93735 17.6184 7.46936 18.5505 8.40937C19.4826 9.34938 20.0038 10.6207 20 11.9444V20H15.5556V12.5C15.4696 11.8995 15.1696 11.3503 14.7109 10.9534C14.2521 10.5565 13.6655 10.3387 13.0589 10.34C12.7874 10.3486 12.5204 10.4119 12.274 10.5262C12.0276 10.6405 11.8068 10.8034 11.6249 11.0051C11.443 11.2069 11.3037 11.4433 11.2155 11.7001C11.1272 11.957 11.0917 12.2291 11.1111 12.5V20ZM4.44444 20H0V6.66667H4.44444V20ZM2.22222 4.44444C1.63285 4.44444 1.06762 4.21032 0.650874 3.79357C0.234126 3.37682 0 2.81159 0 2.22222C0 1.63285 0.234126 1.06762 0.650874 0.650874C1.06762 0.234126 1.63285 0 2.22222 0C2.81159 0 3.37682 0.234126 3.79357 0.650874C4.21032 1.06762 4.44444 1.63285 4.44444 2.22222C4.44444 2.81159 4.21032 3.37682 3.79357 3.79357C3.37682 4.21032 2.81159 4.44444 2.22222 4.44444Z"
                                    fill="#E6AB3D" />
                            </svg>
                        </a>
                        <a href="">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M19.9024 5.90309C19.8912 5.06334 19.734 4.23193 19.4379 3.44606C19.181 2.78318 18.7887 2.18117 18.286 1.67849C17.7834 1.17581 17.1813 0.783514 16.5185 0.526666C15.7427 0.235455 14.9231 0.0779923 14.0947 0.0609825C13.0281 0.0133053 12.6899 0 9.98226 0C7.27464 0 6.9276 7.43489e-08 5.86872 0.0609825C5.04065 0.0781174 4.22148 0.235578 3.44606 0.526666C2.78308 0.783335 2.18098 1.17557 1.67827 1.67827C1.17557 2.18097 0.783334 2.78308 0.526666 3.44606C0.234872 4.22124 0.0777505 5.04059 0.0620911 5.86872C0.014414 6.93647 0 7.27464 0 9.98226C0 12.6899 -8.26098e-09 13.0358 0.0620911 14.0958C0.0787227 14.9252 0.235059 15.7434 0.526666 16.5207C0.783765 17.1835 1.17629 17.7853 1.67916 18.2878C2.18203 18.7903 2.78419 19.1824 3.44717 19.439C4.22046 19.7419 5.03977 19.9106 5.86983 19.9379C6.93758 19.9856 7.27575 20 9.98337 20C12.691 20 13.038 20 14.0969 19.9379C14.9253 19.9216 15.7449 19.7645 16.5207 19.4733C17.1834 19.2162 17.7852 18.8238 18.2879 18.3211C18.7905 17.8185 19.1829 17.2166 19.4401 16.5539C19.7317 15.7778 19.888 14.9595 19.9046 14.1291C19.9523 13.0624 19.9667 12.7242 19.9667 10.0155C19.9645 7.30791 19.9645 6.96419 19.9024 5.90309ZM9.97561 15.1026C7.14381 15.1026 4.84976 12.8085 4.84976 9.97672C4.84976 7.14492 7.14381 4.85087 9.97561 4.85087C11.3351 4.85087 12.6388 5.39091 13.6001 6.3522C14.5614 7.31348 15.1015 8.61726 15.1015 9.97672C15.1015 11.3362 14.5614 12.64 13.6001 13.6012C12.6388 14.5625 11.3351 15.1026 9.97561 15.1026ZM15.3055 5.85653C14.6435 5.85653 14.1102 5.3221 14.1102 4.66127C14.1102 4.50438 14.1411 4.34903 14.2012 4.20408C14.2612 4.05913 14.3492 3.92743 14.4601 3.81649C14.5711 3.70555 14.7028 3.61755 14.8477 3.55751C14.9927 3.49747 15.148 3.46657 15.3049 3.46657C15.4618 3.46657 15.6172 3.49747 15.7621 3.55751C15.9071 3.61755 16.0388 3.70555 16.1497 3.81649C16.2606 3.92743 16.3486 4.05913 16.4087 4.20408C16.4687 4.34903 16.4996 4.50438 16.4996 4.66127C16.4996 5.3221 15.9652 5.85653 15.3055 5.85653Z"
                                    fill="#E6AB3D" />
                                <path
                                    d="M9.97612 13.3058C11.815 13.3058 13.3058 11.815 13.3058 9.97612C13.3058 8.13721 11.815 6.64648 9.97612 6.64648C8.13721 6.64648 6.64648 8.13721 6.64648 9.97612C6.64648 11.815 8.13721 13.3058 9.97612 13.3058Z"
                                    fill="#E6AB3D" />
                            </svg>
                        </a>
                        <a href="">
                            <svg width="11" height="20" viewBox="0 0 11 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M2.945 20V11.166H0V7.485H2.945V4.54C2.945 1.497 4.871 0 7.585 0C8.885 0 10.003 0.0970001 10.329 0.14V3.32H8.446C6.97 3.32 6.626 4.023 6.626 5.052V7.485H10.306L9.57 11.165H6.626L6.685 20"
                                    fill="#E6AB3D" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- @include('frontend.workshops.script-search-workshop') --}}
    @include('frontend.workshops.scripts.nearest-workshop-script')
@endpush
