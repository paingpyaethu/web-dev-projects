<?php include('template/front_panel/header.php'); ?>

<div class="container-fluid bg-light shadow-sm">
   <div class="row">
      <div class="col-12">
         <div class="container">
            <div class="row">
               <div class="col-12">
                  <div class="card border-0 bg-light" style="padding: 1.3rem 0">
                     <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 fw-semi-bold">
                           <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                           <li class="breadcrumb-item active">Contact Us</li>
                        </ol>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="contact-us-area py-5 py-lg-2">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="container">
               <div class="row">
                  <div class="col-12 col-md-6 col-lg-4">
                     <div class="contact-info shadow-sm text-center">
                        <div class="contact-info-icon"><i class="fas fa-location-arrow"></i></div>
                        <h3 class="text-capitalize">Our Location</h3>
                        <p>2441 Counts Lane Hartford, CT 06103</p>
                        <p><a href="#">info@example.com</a></p>
                     </div>
                  </div>
                  <div class="col-12 col-md-6 col-lg-4">
                     <div class="contact-info shadow-sm text-center">
                        <div class="contact-info-icon"><i class="fas fa-phone"></i></div>
                        <h3 class="text-capitalize">Contact us Anytime</h3>
                        <p>Mobile: 012 345 678</p>
                        <p>Fax: 123 456 789</p>
                     </div>
                  </div>
                  <div class="col-12 col-md-6 col-lg-4">
                     <div class="contact-info shadow-sm text-center">
                        <div class="contact-info-icon"><i class="fas fa-envelope-open-text"></i></div>
                        <h3 class="text-capitalize">Write Some Words</h3>
                        <p><a href="#">Support24/7@example.com </a></p>
                        <p><a href="#">info@example.com</a></p>
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-12">
                     <h4 class="text-uppercase fw-semi-bold mb-3 mt-4 mt-lg-0">Get In Touch</h4>
                     <p class="form-message"></p>
                     <form id="contact-form" class="row g-3 mb-3 mb-lg-5" action="contact_us_submit.php" method="post" >
                        <div class="col-md-4">
                           <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                        </div>
                        <div class="col-md-4">
                           <input type="email" class="form-control" name="email" placeholder="Email Address">
                        </div>
                        <div class="col-md-4">
                           <input type="text" class="form-control" name="mobile" placeholder="Mobile">
                        </div>
                        <div class="col-12">
                           <input type="text" class="form-control" name="subject" placeholder="Subject">
                        </div>
                        <div class="col-12">
                           <textarea class="form-control" rows="8" name="message" placeholder="Message"></textarea>
                        </div>
                        <div class="col-12">
                           <button type="submit" name="submit" class="btn btn-main" id="submit">Send Message</button>
                        </div>
                     </form>
                  </div>
               </div>

            </div>

         </div>
      </div>
   </div>
</div>

<?php include('template/front_panel/footer.php'); ?>