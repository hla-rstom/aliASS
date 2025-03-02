@extends('theme.app')

@section('content')
      <!-- Start hero #1-->
      <section class="hero bg-gradient" id="hero">
        <div class="bg-section"><img src="assets_/images/background/bg-gradient.svg" alt="background"/></div>
        <div class="container">
          <div class="hero-cotainer text--center">
            <div class="row">
              <div class="col-12 col-md-8 offset-md-2 col-lg-8 offset-lg-2">
                <div class="hero-content">
                  <div class="hero-headline">Flexible Retail Leasing, Anytime, Anywhere</div>
                  <div class="hero-bio">Maximize Your Retail Space or Find Affordable Leasing Options with No Long-Term Commitments</div>
                  <div class="hero-action text-center">
                    <!-- Find your space button -->
                    <form method="GET" action="{{ route('search.results') }}">
                        <div class="input-group-append">
                            <input type="text" name="search" id="searchQuery" class="form-control rounded-05 text-dark" style="background:white; padding-left: 10px; border-radius: 25px" placeholder="Search for spaces..." aria-label="Search for spaces">
                            
                            <button class="btn  text-white btn--primary btn--arrows mx-auto" type="submit">
                              <span>Find Your Space <i class="icon-right-arrow"></i></span>
                            </button>
                        </div>
                    </form>


                  </div>
                </div>
              </div>
            </div>
            <!-- End .row-->
          </div>
          <!-- End .hero-content-->
        </div>
        <!-- End .container	-->
        <div class="mockup">
          <div class="container">
            <div class="row">
              <div class="col"><img class="img-fluid" src="assets_/images/landing/main.png" alt="illustration vector"/></div>
            </div>
          </div>
        </div>
      </section>
      <!-- End #hero   -->
      <!-- Start Clients-->
      <section class="clients" id="clients">
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-6 offset-md-3 col-lg-6 offset-lg-3">
              <div class="heading text--center">
                <p class="heading-desc"> Few of the that we have helped </p>
              </div>
            </div>
            <!-- End .col-lg-6 -->
          </div>
          <!-- End .row  -->
          <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
              <div class="owl-carousel " data-slide="5" data-slide-res="3" data-autoplay="true" data-nav="false" data-dots="false" data-space="30" data-loop="true" data-speed="800">
                <!--  Client #1   -->
                <div class="client"><img src="assets_/images/logo/logo1.png" alt="logopic"/></div>
                <!--  Client #2   -->
                <div class="client"><img src="assets_/images/logo/logo2.webp" alt="logopic"/></div>
                <!--  Client #3-->
                <div class="client"><img src="assets_/images/logo/logo3.jpeg" alt="logopic"/></div>
                <!--  Client #4-->
                <div class="client"><img src="assets_/images/logo/logo4.png" alt="logopic"/></div>
                
              </div>
            </div>
            <!-- End .row-->
          </div>
          <div class="divider-2"></div>
        </div>
        <!-- End .container-->
      </section>
      <!-- End #clients-->
      <!-- Start Feature #1-->
      <section class="features text-center" id="feature">
        <div class="container">
          <div class="row clearfix">
            <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
              <div class="heading heading-1 text--center">
                <h2 class="heading-title">Retail Leasing, Simplified for Everyone</h2>
                <p class="heading-desc">Simplified platform for brands and retail space owners.
</p>
              </div>
            </div>
            <!-- End .col-lg-6 -->
          </div>
          <!-- End .row  -->
          <div class="row">
            <!-- Panel #1  -->
            <div class="col-12 col-md-12 col-lg-4 ">
              <div class="feature-panel">
                <div class="feature-icon"><i class="flaticon-archive-3"></i></div>
                <div class="feature-content">
                  <h3>Flexible Leasing</h3>
                  <p>Lease your space by day, week, or month, tailored to your needs.</p>
                </div>
              </div>
              <!-- .feature-panel end  -->
            </div>
            <!-- .col-md-12 end  -->
            <!-- Panel #2  -->
            <div class="col-12 col-md-12 col-lg-4 ">
              <div class="feature-panel active">
                <div class="feature-icon"><i class="flaticon-albums"></i></div>
                <div class="feature-content">
                 
                   <h3>Test and Grow</h3>
                  <p>Perfect for brands to test products or expand into new markets without long-term commitments.</p>
                </div>
              </div>
              <!-- .feature-panel end  -->
            </div>
            <!-- .col-md-12 end  -->
            <!-- Panel #3  -->
            <div class="col-12 col-md-12 col-lg-4 ">
              <div class="feature-panel">
                <div class="feature-icon"><i class="flaticon-fingerprint"></i></div>
                <div class="feature-content">
                  <h3>Secured Payment</h3>
                  <p>Guaranteed payments with our escrow-secured system for both parties.</p>
                </div>
              </div>
              <!-- .feature-panel end  -->
            </div>
            <!-- .col-md-12 end  -->
          </div>
          <!-- End .row  -->
        </div>
        <!-- End .container  -->
      </section>
      <section class="services bg-gray" id="brands">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-6">
        <div class="service-card pt-40">
          <div class="heading heading-2">
            <h2 class="heading-title">Expand Your Brand’s Reach <br/>With Short-Term Leases</h2>
            <p class="heading-desc">Take your online store offline without the commitment of long-term contracts. Test your products in real-world environments and engage with customers directly.</p>
          </div>
          <div class="counters-card">
            <div class="counters"><i class="flaticon-settings-6"></i>
              <div class="counters-content"><span class="counting">22</span><span class="type">leases</span></div>
            </div>
            <div class="counters"><i class="flaticon-user-3"></i>
              <div class="counters-content"><span class="counting">35</span><span class="type">brand clients</span></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6">
        <img class="img-fluid service-img" src="assets_/images/illustration/illustration-2.png" alt="vector"/>
      </div>
    </div>
  </div>
</section>
<div class="bg-gray">
  <div class="container">
    <div class="divider-1"></div>
  </div>
</div>
<section class="services bg-gray" id="retail-owners">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-6">
        <img class="img-fluid service-img" src="assets_/images/illustration/illustration-3.png" alt="vector"/>
      </div>
      <div class="col-12 col-md-6">
        <div class="service-card pt-30">
          <div class="heading heading-2">
            <h2 class="heading-title">Maximize Your Retail Space <br/>Without Long-Term Commitments</h2>
            <p class="heading-desc">Lease out unused areas like shelf racks or booths by the day, week, or month. Increase your revenue by allowing brands to showcase their products in your space.</p>
          </div>
          <ul class="list-unstyled service-list pr-60">
            <li><span class="icon-tick-inside-circle"></span> Flexible leasing options for retail spaces.</li>
            <li><span class="icon-tick-inside-circle"></span> Attract top brands to fill unused areas quickly.</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

   
      <!-- Start Testimonials-->
<section class="testimonials bg-gray" id="testimonials">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="owl-carousel carousel-dots carousel-navs " data-slide="1" data-slide-res="1" data-autoplay="false" data-nav="true" data-dots="true" data-space="0" data-loop="true" data-speed="800">
          
          <!-- Testimonial #1 -->
          <div class="testimonial-panel">
            <div class="testimonial-body">
              <div class="testimonial-icon"><span class="icon-left-quotes-sign"></span></div>
              <p>"I had no idea renting out our empty retail spaces could be this easy. Our shelves are always filled now! Highly recommend!"</p>
              <div class="testimonial-author">
                <div class="testimonial-img"><img src="assets_/images/testimonials/avatar-1.png" alt="avatar author"/></div>
                <p>Siti Nur Aisyah @Retail Hub KL</p>
              </div>
            </div>
          </div>
          
          <!-- Testimonial #2 -->
          <div class="testimonial-panel">
            <div class="testimonial-body">
              <div class="testimonial-icon"><span class="icon-left-quotes-sign"></span></div>
              <p>"I tested my products in a pop-up for a week, and it was an amazing experience. My sales went up and I learned so much!"</p>
              <div class="testimonial-author">
                <div class="testimonial-img"><img src="assets_/images/testimonials/avatar-2.png" alt="author"/></div>
                <p>Ahmad Syafiq @Local Goods MY</p>
              </div>
            </div>
          </div>
          
          <!-- Testimonial #3 -->
          <div class="testimonial-panel">
            <div class="testimonial-body">
              <div class="testimonial-icon"><span class="icon-left-quotes-sign"></span></div>
              <p>"Such a great way to bring my online store into a real space without the long-term commitment. The team was super helpful too!"</p>
              <div class="testimonial-author">
                <div class="testimonial-img"><img src="assets_/images/testimonials/avatar-3.png" alt="author"/></div>
                <p>Nadia Kamal @Style Street KL</p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- End .container  -->
</section>
      <!-- End #testimonials -->
      <!-- 
      CTA #1
      =============================================  
      -->
      <section class="cta text-center" id="cta">
  <div class="bg-section"><img src="assets_/images/background/bg-gradient-2.svg" alt="background"/></div>
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-8 offset-md-2 col-lg-8 offset-lg-2 text-center">
        <h3>Ready to Start?</h3>
        {{--  <p>Register: Sign up as a retail owner or brand. List or Lease: Retail owners list their spaces. Brands choose available spaces. Secure Payment: Transactions are escrow-secured for both parties. Move-In & Start: Brands move in, and retail owners start earning.</p>  --}}
        <a href="https://forms.gle/DSyU1rWPnaRGdJjq8" class="btn text-white btn--primary btn--arrows mx-auto">
          <span>Lease Space <i class="icon-right-arrow"></i></span>
        </a>
        <a href="https://forms.gle/7Q2KcoeH8iAZpWW78" class="btn  text-white btn--primary btn--arrows mx-auto">
          <span>Find Your Space <i class="icon-right-arrow"></i></span>
        </a>
      </div>
      <!-- End .col-md-12-->
    </div>
    <!-- End .row-->
  </div>
  <!-- End .container-->
</section>
  @endsection
  @section('script')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFmDPs9yBFzKNC6o0ozgOP5c_Rmrz7F1k&callback=initMap" async defer></script>
    <script src="assets_/js/vendor/jquery-3.4.1.min.js"></script>
    <script src="assets_/js/vendor.js"></script>
    <script src="assets_/js/functions.js"></script>
@endsection