@if(!auth()->check())
    <div itemscope="">


        <!-- Main Footer Start -->
        <footer class="main-footer bg-section dark-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Footer Header Start -->
                        <div class="footer-header">
                            <!-- Footer Logo Start -->
                            <div class="footer-logo">
                                <img src="{{ asset('public/assets/images/footer-logo.png') }}" alt="">
                            </div>
                            <!-- Footer Logo End -->

                            <!-- Footer Contact Form Start  -->
                            <div class="footer-contact-form">
                                <h2>Subscribe Our Newsletter's</h2>
                                <div class="footer-newsletter-form">
                                    <form id="newsletterForm">
                                        @csrf
                                        <div class="form-group mc-field-group">
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Enter Email Address...." id="mce-EMAIL"
                                                class="required email LoNotSensitive">
                                            <button type="submit" class="newsletter-btn bg-white"><i
                                                    class="fa-solid fa-paper-plane"></i></button>
                                        </div>

                                        <div id="mce-responses" class="clear">
                                            <div class="response text-danger" id="mce-error-response" style="display:none">
                                            </div>
                                            <div class="response text-success" id="mce-success-response"
                                                style="display:none"></div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <!-- Footer Contact Form End  -->
                        </div>
                        <!-- Footer Header End -->
                    </div>

                    <div class="col-xl-4">
                        <!-- About Footer Start -->
                        <div class="about-footer">
                            <!-- Section Title Start -->
                            <div class="section-title mb-2">
                                <h2 data-cursor="-opaque">Let's Build Smarter Industries Together</h2>
                            </div>
                            <!-- Section Title End -->
                            <div class="client-rating">
                                <div class="footer-icons">
                                    <p class="mb-2">Follow, like, tweet or post. We would love to interact with you</p>
                                    <div class="footer-social-links">
                                        <ul>
                                            <li><a href="https://www.linkedin.com/company/predictormt/" target="_blank"
                                                    rel="noopener"><i class="fa-brands fa-linkedin"></i></a></li>
                                            <li><a href="https://www.facebook.com/predictormt" target="_blank"
                                                    rel="noopener"><i class="fa-brands fa-facebook-f"></i></a></li>
                                            <li><a href="https://www.instagram.com/predictormt" target="_blank"
                                                    rel="noopener"><i class="fa-brands fa-instagram"></i></a></li>
                                        </ul>
                                    </div>



                                </div>
                                <p class="mb-2">We're happy to share our rating!</p>
                                <div class="client-rating-box">
                                    <span>Client Rating</span>
                                    <span class="rating-icon">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </span>
                                </div>

                                <div itemprop="aggregateRating" itemscope="" itemtype="#" class="ratig-2-footer">
                                    <span itemprop="ratingValue">Rated 4.9</span>/5 based on <span
                                        itemprop="reviewCount">49</span> reviews
                                    across the world.
                                </div>
                            </div>

                            <!-- About Footer Button Start -->
                            <div class="about-footer-btn mt-2">
                                <a href="{{route('contact')}}" class="btn-default">Get In Touch</a>
                            </div>
                            <!-- About Footer Button End -->
                        </div>
                        <!-- About Footer End -->
                    </div>

                    <div class="col-xl-8">
                        <!-- Footer Links Box Start -->
                        <div class="footer-links-box">
                            <!-- Footer Links Start -->
                            <div class="footer-links">
                                <h2>Quick Links</h2>

                                <ul>
                                    <li><a href="{{ route('about') }}">About Us</a></li>
                                    <li><a href="{{ route('product') }}">Product</a></li>
                                    <li><a href="https://techiedom.in/predictorMT/pricing">Subscription</a></li>
                                    <li><a href="{{ route('service') }}">Services</a></li>
                                    <li><a href="{{ route('signup') }}">OEM</a></li>
                                    <li><a href="{{route('contact')}}">Contact Us</a></li>


                                </ul>
                            </div>
                            <!-- Footer Links End -->

                            <!-- Footer Links Start -->
                            <div class="footer-links">
                                <h2>Industries</h2>
                                <ul>
                                    <li><a href="{{ route('industries') }}">Mining Exploration</a></li>
                                    <li><a href="{{ route('industries') }}">Trucking Companies</a></li>
                                    <li><a href="{{ route('industries') }}">Our Manufacturers</a></li>
                                    <li><a href="{{ route('industries') }}">Agriculture Equipment</a></li>
                                    <li><a href="{{ route('industries') }}">Our Warehousing</a></li>
                                </ul>
                                </ul>
                            </div>
                            <!-- Footer Links End -->

                            <!-- Footer Contact Info List Start -->
                            <div class="footer-links footer-contact-info-list">
                                <h2>Contact Information</h2>
                                <ul>


                                    <li>
                                        <i class="fa-solid fa-envelope"></i>
                                        <a href="mailto:ceo@predictormt.ca">ceo@predictormt.ca</a>
                                    </li>

                                    <li>
                                        <i class="fa-solid fa-location-dot"></i>
                                        PREDICTOTMT TECH SOLUTIONS INC.<br>
                                        304 – 8920 Woodbine Avenue,<br>
                                        Markham, ON, L3R 9W9
                                    </li>
                                </ul>
                            </div>
                            <!-- Footer Contact Info List End -->
                        </div>
                        <!-- Footer Links Box End -->
                    </div>

                    <div class="col-lg-12">
                        <!-- Footer Copyright Start -->
                        <div class="footer-copyright">
                            <!-- Footer Copyright Text Start -->
                            <div class="footer-copyright-text">
                                <p><i class="fa fa-copyright" aria-hidden="true"></i> {{ date('Y') }}. All Rights Reserved
                                    <span itemprop="name">Predictor MT</span> Inc.
                                </p>
                            </div>
                            <!-- Footer Copyright Text End -->

                            <!-- Footer Social Links Start -->
                            <div class="copyright-links">
                                <ul class="d-flex align-items-center gap-2">
                                    <li><a href="{{route('privacy.policy')}}">Privacy Policy</a></li>
                                    <span class="text-white">|</span>
                                    <li><a href="{{route('term.condition')}}">Terms &amp; Conditions</a></li>
                                </ul>
                            </div>
                            <!-- Footer Social Links End -->
                        </div>
                        <!-- Footer Copyright End -->
                    </div>
                </div>
            </div>
        </footer>

@endif

    <!-- Jquery Library File -->
    <script src="{{ asset('public/assets/js/jquery-3.7.1.min.js') }}"></script>
    <!-- Bootstrap js file -->
    <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Validator js file -->
    <script src="{{ asset('public/assets/js/validator.min.js') }}"></script>
    <!-- SlickNav js file -->
    <script src="{{ asset('public/assets/js/jquery.slicknav.js') }}"></script>
    <!-- Swiper js file -->
    <script src="{{ asset('public/assets/js/swiper-bundle.min.js') }}"></script>
    <!-- Counter js file -->
    <script src="{{ asset('public/assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/jquery.counterup.min.js') }}"></script>
    <!-- Magnific js file -->
    <script src="{{ asset('public/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- SmoothScroll -->
    <script src="{{ asset('public/assets/js/SmoothScroll.js') }}"></script>
    <!-- Parallax js -->
    <script src="{{ asset('public/assets/js/parallaxie.js') }}"></script>
    <!-- MagicCursor js file -->
    <script src="{{ asset('public/assets/js/gsap.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/magiccursor.js') }}"></script>
    <!-- Text Effect js file -->
    <script src="{{ asset('public/assets/js/SplitText.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/ScrollTrigger.min.js') }}"></script>
    <!-- YTPlayer js File -->
    <script src="{{ asset('public/assets/js/jquery.mb.YTPlayer.min.js') }}"></script>
    <!-- Wow js file -->
    <script src="{{ asset('public/assets/js/wow.min.js') }}"></script>
    <!-- Main Custom js file -->
    <script src="{{ asset('public/assets/js/function.js') }}"></script>


    <script>
        $('#newsletterForm').submit(function (e) {
            e.preventDefault();

            let email = $('#mce-EMAIL').val();

            $.ajax({
                url: "{{ route('newsletter.subscribe') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    email: email
                },
                success: function (res) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Subscribed Successfully 🎉',
                        text: res.message,
                        confirmButtonColor: '#ff6600'
                    });

                    $('#mce-EMAIL').val('');
                },
                error: function (xhr) {

                    let err = xhr.responseJSON?.message || 'Something went wrong';

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops 😢',
                        text: err,
                        confirmButtonColor: '#dc3545'
                    });

                }
            });
        });
    </script>

    </body>

    </html>