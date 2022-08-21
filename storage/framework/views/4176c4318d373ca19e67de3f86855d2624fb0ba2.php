 <!-- Disclaimer Modal -->
    <div class="modal fade" id="modal-subscribe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog disclaimer-modal" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 class="text-left pb-4 text-uppercase">Disclaimer:</h4>
                    <div class="row">
                        <div class="col-sm-12 col-sm-offset-1">
                            <p class="text-muted small text-left">The rules of the Common Service Centers, privately held by Hashwares Services Pvt. Ltd. should be followed by all the customers subscribing to it. By clicking on 'I AGREE', the user acknowledges that: <br>
                                <br> The user wishes to gain more information about Common Service Centers, its service areas and its details, for his/her own information and use; <br>
                                <br> The information is made available/provided to the user only on his/her specific request and any information obtained or material downloaded from this website is completely at the user's volition and any transmission,
                                receipt, or use of this site is not intended to, and will not, create any Business-Customer relationship; and <br>
                                <br> None of the information contained on the website is in the nature of a wrong opinion or otherwise, amounts to any advice. <br>
                                <br> Common Service Centers (Hashwares Services Pvt. Ltd.) is not liable for any consequence of any action taken by the user relying on material/information provided under this website. In cases where the user has any legal
                                issues, he/she in all cases must seek independent advice.</p>
                        </div>
                    </div>
                </div>
                <button type="button" class="close agree-text" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">I AGREE</span></button>
            </div>
        </div>
    </div>
    <!-- Disclaimer Modal End-->
    <div class="modal fade" id="Qr_code-model" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog qr-model-deilog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                </div>
                <div class="modal-body">
                    <div class="qr-code-area">
                        <img src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>assets/front/assets/img/resource/qr-code.JPG" alt="">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== Start Header ======-->
    <header class="header-section navbar-center absolute-header nav-white-color submenu-seconday-color nav-border-bottom sticky-header">
        <div class="header-top-bar">
            <div class="container-fluid container-1430">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="header-info">
                            <div class="contact-detail mail-box"> <span><i class="fa fa-envelope-open-text"></i></span> <span><a href="#">support@commonservicecenters.in</a></span> </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-4 col-md-6">
                        <div class="header-contacr-info">
                            <div class="contact-detail call-box"> <span><i class="fa fa-phone-volume"></i></span> <span><a href="#">9205483376</a></span> </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-5">
                        <div class="header-info">
                            <div class="contact-detail -boxenquiry"> <span><i class="fa fa-user-clock"></i></span> <span>
              <p>Enquiry Time (10AM -7 PM) </p>
              </span> </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12 col-md-7">
                        <div class="header-info">
                            <div class="contact-detail header-appointment-box"> <a href="#"> <i aria-hidden="true" class="far fa-bell"></i> <span>Make an Appointment For Support (10AM – 7 PM)</span> </a> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-header">
            <div class="container-fluid container-1430">
                <div class="row header-inner">
                    <div class="col-lg-3 col-md-4 col-sm-4 logo-area">
                        <div class="header-left">
                            <div class="brand-logo"> <a href="<?php echo e(route('front.home')); ?>"> <img src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>assets/front/assets/img/logo.png" alt="logo" class="main-logo"> <img src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>assets/front/assets/img/logo.png" alt="logo" class="sticky-logo"> </a> </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-8 nav-area">
                        <div class="header-center">
                            <nav class="nav-menu d-none d-xl-block d-lg-block">
                                <ul>
                                    <li class="active"> <a href="<?php echo e(route('front.home')); ?>">Home</a> </li>
                                    <li> <a href="<?php echo e(route('front.about')); ?>">About Us</a></li>
                                    <li> <a href="<?php echo e(route('front.service')); ?>">Services</a></li>
                                    <!-- <li> <a href="#">Services</a>
                  <ul class="sub-menu">
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Services</a></li>
                  </ul>
                </li> -->
                                    <li><a href="<?php echo e(route('mylogin')); ?>" class="user-login"> <i class="far fa-user-circle"></i> Agent Login </a> </li>
                                    <li> <a class="template-btn secondary-bg paynow-btn" href="<?php echo e(route('mylogin')); ?>">Apply Now</a> </li>
                                   
                                </ul>

                            </nav>
                            <div class="d-xl-none d-lg-none"> <a href="#" class="navbar-toggler"> <span></span> <span></span> <span></span> </a></div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Start Mobile Slide Menu -->
        <div class="mobile-slide-panel">
            <div class="panel-overlay"></div>
            <div class="panel-inner">
                <div class="mobile-logo"> <a href="<?php echo e(route('front.home')); ?>"> <img src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>assets/front/assets/img/logo.png" alt="Common Servicecenters"> </a> </div>
                <nav class="mobile-menu">
                    <ul>
                        <li> <a href="<?php echo e(route('front.home')); ?>">Home</a> </li>
                        <li> <a href="<?php echo e(route('front.about')); ?>">About Us</a></li>
                        <li> <a href="<?php echo e(route('front.service')); ?>">Services</a>
                            <!-- <ul class="sub-menu">
              <li><a href="#">Services</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">Services</a></li>
            </ul> -->
                        </li>
                        <li><a href="<?php echo e(route('mylogin')); ?>" class="user-login"> <i class="far fa-user-circle"></i> Agent Login </a> </li>
                        <li> <a class="template-btn secondary-bg paynow-btn" href="<?php echo e(route('mylogin')); ?>">Apply Now</a> </li>
                        
                    </ul>
                    <div class="mobile-social-icon">
                        <ul>
                            <li><a href="https://www.facebook.com/commonservicecenters1" class="Facebook mobile-icon" target="_blank"><i class="fab fa-facebook-f"> </i> </a></li>
                            <li><a href="https://twitter.com/CServicecenters" class="Twitter mobile-icon" target="_blank"><i class="fab fa-twitter"> </i> </a></li>
                            <li><a href="https://www.instagram.com/commonservicecenters" class="Instagram mobile-icon" target="_blank"><i class="fab fa-instagram"></i> </a></li>
                            <li><a href="https://www.youtube.com/channel/UCm30Ju2_pcYgy0WaE6Q-NlQ" class="Youtube mobile-icon" target="_blank"><i class="fab fa-youtube"></i> </a></li>
                            <li><a href="https://www.linkedin.com/company/commonservicecenters" class="Google mobile-icon" target="_blank"><i class="fab fa-linkedin"> </i> </a></li>
                            <li><a href="https://in.pinterest.com/commonservicecenters/" class="Google mobile-icon" target="_blank"><i class="fab fa-pinterest-p"> </i> </a></li>
                        </ul>
                    </div>
                </nav>
                <a href="#" class="panel-close"> <i class="fal fa-times"></i> </a> </div>
        </div>
        <!-- End Mobile Slide Menu -->


        <div class="header-fixed-social  desktop-social-icon">
            <a href="https://www.facebook.com/commonservicecenters1" class="Facebook facebook-icon" target="_blank"><i class="fab fa-facebook-f"> </i> Facebook </a>
            <a href="https://twitter.com/CServicecenters" class="Twitter twitter-icon" target="_blank"><i class="fab fa-twitter"> </i> Twitter </a>
            <a href="https://www.instagram.com/commonservicecenters" class="Instagram instagram-icon" target="_blank"><i class="fab fa-instagram"></i> Instagram </a>
            <a href="https://www.youtube.com/channel/UCm30Ju2_pcYgy0WaE6Q-NlQ" class="Youtube youtube-icon" target="_blank"><i class="fab fa-youtube"></i> Youtube </a>
            <a href="https://www.linkedin.com/company/commonservicecenters" class="Google linkedin-icon" target="_blank"><i class="fab fa-linkedin"> </i> Linked In </a>
            <a href="https://in.pinterest.com/commonservicecenters/" class="Google pinterest-icon" target="_blank"><i class="fab fa-pinterest-p"> </i> Pinterest </a>
        </div>

    </header>
    <!--====== End Header ======--><?php /**PATH D:\laragon\www\open_aisa\Modules/Front\Resources/views/layouts/header.blade.php ENDPATH**/ ?>