@extends('front::layouts.master')

@section('content')
    <!--====== Start Hero Area ======-->
    <section class="hero-area-v2">
        <div class="hero-content-wrapper">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12">
                        <div class="hero-content"> <span class="title-tag wow fadeInDown" data-wow-delay="0.2s"> #Hashwares Services Pvt. Ltd.</span>
                            <h1 class="hero-title wow fadeInUp" data-wow-delay="0.3s"> Discover New Ideas To Build Your Business </h1>
                            <p>We are professional & Experienced B2b Sofware Company!</p>
                            <ul class="hero-btns d-flex align-items-center">
                                <li class="wow fadeInUp" data-wow-delay="0.4s"> <a href="/MemberSignup.aspx" class="template-btn bordered-btn"> Start Apply Now <i class="fas fa-arrow-right"></i> </a> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6 col-md-6 col-sm-12">
                        <div class="hero-img preview-blob-image with-floating-icon text-center wow fadeInUp" data-wow-delay="0.4s"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/slider/home_banner.png" class="animate-float-bob-y" alt="Image"> </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Hero Area ======-->

    <!--====== Info Boxes ======-->
    <section class="top-box-section">
        <div class="container">
            <div class="info-boxes-wrapper wow fadeInUp" data-wow-delay="0.4s">
                <div class="info-boxes">
                    <div class="box-item">
                        <div class="box-icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/infobox-icon-1.png" alt="info icon one"> </div>
                        <div class="box-content">
                            <h4 class="box-title">Enquiry</h4>
                        </div>
                    </div>
                    <div class="box-item">
                        <div class="box-icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/infobox-icon-2.png" alt="info icon two"> </div>
                        <div class="box-content">
                            <h4 class="box-title">How To Earn Money</h4>
                        </div>
                    </div>
                    <div class="box-item">
                        <div class="box-icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/infobox-icon-2.png" alt="info icon two"> </div>
                        <div class="box-content">
                            <a href='CSC_Booklet__(1) (3).pdf'>
                                <h4 class="box-title">Download Brocher</h4>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Info Boxes ======-->

    <!--====== Start Brands Slider Area ======-->
    <section class="brands-section">
        <div class="container pt-5 pb-5 border-bottom-primary">
            <div class="row justify-content-lg-between">
                <div class="col-lg-12 col-md-12">
                    <div class="brand-items brand-effect-one row brand-slider-one-active">
                        <div class="col">
                            <div class="brand-item"> <a href="#"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/brand-logo/logo-1.png" alt="Brand"> </a> </div>
                        </div>
                        <div class="col">
                            <div class="brand-item"> <a href="#"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/brand-logo/logo-2.png" alt="Brand"> </a> </div>
                        </div>
                        <div class="col">
                            <div class="brand-item"> <a href="#"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/brand-logo/logo-3.png" alt="Brand"> </a> </div>
                        </div>
                        <div class="col">
                            <div class="brand-item"> <a href="#"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/brand-logo/logo-4.png" alt="Brand"> </a> </div>
                        </div>
                        <div class="col">
                            <div class="brand-item"> <a href="#"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/brand-logo/logo-5.png" alt="Brand"> </a> </div>
                        </div>
                        <div class="col">
                            <div class="brand-item"> <a href="#"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/brand-logo/logo-6.png" alt="Brand"> </a> </div>
                        </div>
                        <div class="col">
                            <div class="brand-item"> <a href="#"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/brand-logo/logo-7.png" alt="Brand"> </a> </div>
                        </div>
                        <div class="col">
                            <div class="brand-item"> <a href="#"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/brand-logo/logo-8.png" alt="Brand"> </a> </div>
                        </div>
                        <div class="col">
                            <div class="brand-item"> <a href="#"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/brand-logo/logo-9.png" alt="Brand"> </a> </div>
                        </div>
                        <div class="col">
                            <div class="brand-item"> <a href="#"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/brand-logo/logo-10.png" alt="Brand"> </a> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Brands Slider Area ======-->

    <!--====== Start About Section ======-->
    <section class="about-section p-t-130 p-b-130">
        <div class="container">
            <div class="row justify-content-lg-between justify-content-center align-items-center">
                <div class="col-xl-6 col-lg-6 col-md-10">
                    <div class="about-text">
                        <div class="section-title">
                            <div class="sec-title">
                                <div class="sec-tagline"> A brief introduction <span class="sec-line-right"></span> </div>
                                <h2>Build Your Business With <strong>Common Service Centers</strong></h2>
                            </div>
                        </div>
                        <p class="text-pullquote pullquote-secondary-color m-b-35">We, HASHWARES SERVICES Pvt. Ltd. is incorporated under the companies Act, 2013[18 of 2013] and authorized by GSTN GSPs GST suvidha provider facilitate to open of COMMON SERVICE CENTERS (CSC) franchise in India by providing the
                            best jan seva kendra franchise business support of Trained GST Experts with advanced technology. CSC will provide the solutions all gst related problem in all over India with gst franchise model.</p>
                        <p>In a short period with true leadership qualities, we have become the India’s largest and best GST Suvidha Kendra Franchise Provider for GST Consultant and GST Services with more than 14 lakh happy customers and 15,000+ active GST
                            Franchise in all over India. It provides 300+ services that are financially beneficial for everyone with added services for banking services, loan, insurance, travel, and G2C services.</p>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-10 home-about-area">
                    <div class="preview-blob-image with-floating-icon m-b-md-100"> <img class="home-aboutus-img" src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/resource/home-about.jpg" alt="Image">
                        <div class="floating-icons"> <span class="dott-shape"><img class=" animate-float-bob-x" src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/shape/shape_pattern-long.png" alt=""></span> <span class="rectangle-shape"><img class=" animate-float-bob-y" src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/shape/rectangle-shape.png" alt=""></span>                            </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 home-about-more-content">
                    <div class="home-about-content">
                        <p>When it comes to supporting, it gives Top-Notch assistance with highly updated Applications at each level like CSC mobile app facility and a supporting team that includes experienced relationship manager and 170+ knowledgeable
                            members of the backend team.<br> Our mission is to use technology for a better process of CSC Franchise in order to increase communication at the creative level and uplift growth at every step. From maintaining the balanced
                            relationship between existing and new clients to continue growing our services we have never failed to show the progress results and come up as Best GST Service Provider. We are targeting to open 50000 (Fifty thousands) CSC
                            in 2020 to help franchise business owners in GST returns filing and provide best GST related services on time<br> Our strong communication with our clients is based on the continuous efforts of our company that gets reflected
                            in the progress chart and because of this; we have come up with great reviews and feedback through the support of our clients. Our GST Experts carry the experience of the professionals with a great touch of knowledge. The ability
                            to provide highly personalized solutions is the key to our in-demand service.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End About Section ======-->

    <!--====== Start Service ======-->
    <section class="service-section p-t-100 p-b-60">
        <div class="container">
            <div class="section-title text-center pb-5">
                <div class="sec-title">
                    <div class="sec-tagline"> <span class="sec-line-left"></span> Our Services <span class="sec-line-right"></span> </div>
                    <h2>Provide awesome service<br>
                        <strong>for our customer</strong></h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="service-box">
                        <div class="service-icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/home/aadhar-card.png" alt=""> </div>
                        <div class="services-content pt-3">
                            <h4><a href="#">Aadhar Service</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="service-box">
                        <div class="service-icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/home/money-transfer.png" alt=""> </div>
                        <div class="services-content pt-3">
                            <h4><a href="#">Money Transfer</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="service-box">
                        <div class="service-icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/home/bill-payment.png" alt=""> </div>
                        <div class="services-content pt-3">
                            <h4><a href="#">Bill Payment & Recharge</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="service-box">
                        <div class="service-icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/home/pancard.png" alt=""> </div>
                        <div class="services-content pt-3">
                            <h4><a href="#">Pan Card</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="service-box">
                        <div class="service-icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/home/gst.png" alt=""> </div>
                        <div class="services-content pt-3">
                            <h4><a href="#">GST Services</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="service-box">
                        <div class="service-icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/home/store.png" alt=""> </div>
                        <div class="services-content pt-3">
                            <h4><a href="#">Amazon Store</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="service-box">
                        <div class="service-icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/home/fixed-deposit.png" alt=""> </div>
                        <div class="services-content pt-3">
                            <h4><a href="#">Fixed Deposit </a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="service-box">
                        <div class="service-icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/home/ayurvedic-clinic.png" alt=""> </div>
                        <div class="services-content pt-3">
                            <h4><a href="#">CSC Ayurvedic Clinic</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="service-box">
                        <div class="service-icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/home/registration.png" alt=""> </div>
                        <div class="services-content pt-3">
                            <h4><a href="#">Company Registration</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="service-box">
                        <div class="service-icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/home/government-customer.png" alt=""> </div>
                        <div class="services-content pt-3">
                            <h4><a href="#">Government to Customer</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="service-box">
                        <div class="service-icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/home/itr-filing.png" alt=""> </div>
                        <div class="services-content pt-3">
                            <h4><a href="#">ITR Filing</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="service-box">
                        <div class="service-icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/home/certification.png" alt=""> </div>
                        <div class="services-content pt-3">
                            <h4><a href="#">ISO Certification</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-12">
                    <div class="service-box">
                        <div class="service-icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/home/google-business.png" alt=""> </div>
                        <div class="services-content pt-3">
                            <h4><a href="#">Trade India (Google by Business)</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="service-box">
                        <div class="service-icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/home/irtct.png" alt=""> </div>
                        <div class="services-content pt-3">
                            <h4><a href="#">IRCTC</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="service-box">
                        <div class="service-icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/home/ayushman-card.png" alt=""> </div>
                        <div class="services-content pt-3">
                            <h4><a href="#">Ayushmann card</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="service-box">
                        <div class="service-icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/home/esharm-card.png" alt=""> </div>
                        <div class="services-content pt-3">
                            <h4><a href="#"> e-SHRAM</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="service-box">
                        <div class="service-icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/home/license.png" alt=""> </div>
                        <div class="services-content pt-3">
                            <h4><a href="#">Driving Licence</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-sm-12">
                    <div class="service-box">
                        <div class="service-icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/home/loan.png" alt=""> </div>
                        <div class="services-content pt-3">
                            <h4><a href="#">Loans</a></h4>
                        </div>
                    </div>
                </div>




            </div>
        </div>
    </section>
    <!--====== Service Section End ======-->

    <!--====== Agent Panel Section Start ======-->
    <section class="p-t-100 p-b-50 agent-panel-section" style="background-image:url({{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/shape/bg_shape_1.png);">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="section-title">
                        <div class="sec-title">
                            <div class="sec-tagline"> Common Service Centers <span class="sec-line-right"></span> </div>
                            <h2>Build Your Business With <strong>Common Service Centers</strong></h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row position-relative mt-50 mt-lg-0">
                        <div class="col-md-6">
                            <div class="agent-box text-center box-shadow mb-4 blue-bg">
                                <div class="agent-watermark-icon"><img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/retail.png" alt=""></div>
                                <div class="agent-icon mb-4"><img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/retail_white.png" alt=""></div>
                                <div class="agent-detail">
                                    <h3 class="text-white">Retailer</h3>
                                    <p class="text-white">Any individual can apply for Retailer who would be selling the services and earning commissions only. </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="agent-box text-center box-shadow mb-4 orange-bg">
                                <div class="agent-watermark-icon"><img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/distributor.png" alt=""></div>
                                <div class="agent-icon mb-4"><img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/distributor_white.png" alt=""></div>
                                <div class="agent-detail">
                                    <h3 class="text-white">Distributor </h3>
                                    <p class="text-white">Any individual can apply for Distributor who would be selling the services and create retailers and earning commissions. </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="agent-box text-center box-shadow  mb-4 orange-bg">
                                <div class="agent-watermark-icon"><img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/master-distritutor.png" alt=""></div>
                                <div class="agent-icon mb-4"><img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/master-distritutor_white.png" alt=""></div>
                                <div class="agent-detail">
                                    <h3 class="text-white">Master Distributor </h3>
                                    <p class="text-white">Any individual can apply for Master Distributor who would be selling the services, creating Retailers and Distributors and earning commissions. </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="agent-box text-center box-shadow mb-4 blue-bg">
                                <div class="agent-watermark-icon"><img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/api_white.png" alt=""></div>
                                <div class="agent-icon mb-4"><img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/api_white.png" alt=""></div>
                                <div class="agent-detail">
                                    <h3 class="text-white">API</h3>
                                    <p class="text-white">Any company who is looking to sell with the own API Panel and the White Label Features and can earn commissions with the business name. </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== Agent Panel Section End ======-->

    <section class="p-t-100 p-b-100 overflow-hidden">
        <div class="container">
            <div class="row">
                <div class="col-lg-3" dir="rtl">
                    <div class="subscribe-image d-none d-lg-block"><img class="radius-5" src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/resource/benefits-img.png" alt=""></div>
                </div>
                <div class="col-lg-9 d-flex align-items-center">
                    <div class="newsletter-bg-img bg-img" style="background-image:url({{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/bg/subscribe-bg.png);"></div>
                    <div class="pl-lg-50 pt-100 pb-100 w-100">
                        <div class="row no-gutters justify-content-end">
                            <div class="col-lg-10 benefits-right">
                                <div class="section-title">
                                    <div class="sec-title">
                                        <div class="sec-tagline"> Common Service Centers <span class="sec-line-right"></span> </div>
                                        <h2>Benefits of Using <strong class="d-block">CSC Services</strong></h2>
                                    </div>
                                </div>
                                <div class="benefits-wrapper">
                                    <div class="benefits--box">
                                        <div class="inner--benefits">
                                            <div class="icon-benefits"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/benefits_icon1.png" alt=""> </div>
                                            <div class="content-benefits">
                                                <h3>One Stop Services</h3>
                                                <p>We are happy to inform you that you have reached an ideal place where you can get all types of services at one place.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="benefits--box">
                                        <div class="inner--benefits">
                                            <div class="icon-benefits"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/benefits_icon2.png" alt=""> </div>
                                            <div class="content-benefits">
                                                <h3>Attract More Customers</h3>
                                                <p>You can attract more customers to your shop & Business by providing fast and secure services.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="benefits--box">
                                        <div class="inner--benefits">
                                            <div class="icon-benefits"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/benefits_icon3.png" alt=""> </div>
                                            <div class="content-benefits">
                                                <h3>Earn Extra Profit</h3>
                                                <p>Whether you're hoping to make some extra pocket money, Okay let’s Join Our Service to earn extra money.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== Start Counter Section ======-->
    <section class="counter-section counter-section-bordered bordered-secondary-bg p-t-130" style="background-image:url({{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/shape/bg_shape_2.png);">
        <div class="container">
            <div class="counter-section-inner">
                <div class="row counter-items-v2">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="section-title">
                            <div class="sec-title">
                                <div class="sec-tagline"> Our awesome funfact <span class="sec-line-right"></span> </div>
                                <h2>Our <strong>Achievement</strong></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12 col-sm-12 ml-auto">
                        <div class="counter-inner-wrapper">
                            <div class="counter-box box1">
                                <div class="counter-item white-color counter-left">
                                    <div class="counter-icon-box animate-float-bob-y pb-4"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/resource/counter_clients-satisfaction.png" alt=""> </div>
                                    <div class="counter-wrap"> <span class="counter">15000</span> <span class="suffix"><i class="far fa-plus"></i></span> </div>
                                    <p class="title"> Happy Clients </p>
                                </div>
                            </div>
                            <div class="counter-box box2">
                                <div class="counter-item white-color counter-left">
                                    <div class="counter-icon-box animate-float-bob-x pb-4"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/home/store.png" alt=""> </div>
                                    <div class="counter-wrap"> <span class="counter">9000</span> <span class="suffix"><i class="far fa-plus"></i></span> </div>
                                    <p class="title"> CSC Centers </p>
                                </div>
                                <div class="counter-item white-color counter-left">
                                    <div class="counter-icon-box animate-float-bob-y pb-4"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/count_service.png" alt=""> </div>
                                    <div class="counter-wrap"> <span class="counter">300</span> <span class="suffix"><i class="far fa-plus"></i></span> </div>
                                    <p class="title"> Services </p>
                                </div>
                            </div>
                            <div class="counter-box box3">
                                <div class="counter-item white-color counter-left">
                                    <div class="counter-icon-box animate-float-bob-y pb-4"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/home/registration.png" alt=""> </div>
                                    <div class="counter-wrap"> <span class="counter">2000</span> <span class="suffix"><i class="far fa-plus"></i></span> </div>
                                    <p class="title"> New Registrations </p>
                                </div>
                                <div class="counter-item white-color counter-left">
                                    <div class="counter-icon-box animate-float-bob-x pb-4"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/count_application.png" alt=""> </div>
                                    <div class="counter-wrap"> <span class="counter">1000</span> <span class="suffix"><i class="far fa-plus"></i></span> </div>
                                    <p class="title"> New Applications </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Counter Section ======-->

    <section class="business-model-section p-t-130 p-b-60">
        <div class="container-fluid container-1470">
            <div class="section-title text-center pb-5">
                <div class="sec-title">
                    <div class="sec-tagline"> <span class="sec-line-left"></span> CSC <span class="sec-line-right"></span> </div>
                    <h2>Features of<br>
                        <strong>Common Service Centers</strong></h2>
                </div>
            </div>
            <div class="row model-inner-wrapper">
                <div class="model-group1">
                    <div class="col-block-1">
                        <div class="model-block">
                            <div class="model-box model-inner-block1"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/modal_icon1.png" alt="" class="img-responsive model-icon">
                                <h4>Key Partners</h4>
                                <p>We have a tie up with ICICI & YES BANK Partners API hassle free experience during transactions</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-block-2">
                        <div class=" model-block">
                            <div class="model-box model-inner-block2">
                                <div class="business-flip">
                                    <div class="flip-box-inner">
                                        <div class="flip-box-front"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/modal_icon2.png" alt="" class="img-responsive model-icon">
                                            <h4>Key Activities</h4>
                                        </div>
                                        <div class="flip-box-back">
                                            <h4>Key Activities</h4>
                                            <p>A mission statement is a literal quote stating what a brand or company is setting out to do. This lets the customer know the product and service it provides, who it makes it for, and why it’s doing it. </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="model-box model-inner-block3">
                                <div class="business-flip">
                                    <div class="flip-box-inner">
                                        <div class="flip-box-front"><img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/modal_icon3.png" alt="" class="img-responsive model-icon">
                                            <h4>Key Resources</h4>
                                        </div>
                                        <div class="flip-box-back">
                                            <h4>Key Resources</h4>
                                            <p>The resources that are necessary to create value for the customer. They are considered {{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets to a company that are needed to sustain and support the business.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-block-3">
                        <div class=" model-block">
                            <div class="model-box model-inner-block4"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/modal_icon4.png" alt="" class="img-responsive model-icon">
                                <h4> Value</h4>
                                <p>We value every customer who come with a dream to start a SME Business with us</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-block-4">
                        <div class="model-block">
                            <div class="model-box model-inner-block5">
                                <div class="business-flip">
                                    <div class="flip-box-inner">
                                        <div class="flip-box-front"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/modal_icon5.png" alt="" class="img-responsive model-icon">
                                            <h4>Relationship Manager</h4>
                                        </div>
                                        <div class="flip-box-back">
                                            <h4>Relationship Manager</h4>
                                            <p>The customer relationship manager has a challenging and ever-evolving role to play when it comes to optimizing the customer experience.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="model-box model-inner-block6">
                                <div class="business-flip">
                                    <div class="flip-box-inner">
                                        <div class="flip-box-front"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/modal_icon6.png" alt="" class="img-responsive model-icon">
                                            <h4>Channels</h4>
                                        </div>
                                        <div class="flip-box-back">
                                            <h4>Channels</h4>
                                            <p>A company can deliver its value proposition to its targeted customers through different channels. Effective channels will distribute a company's value proposition in ways that are fast, efficient and cost-effective.
                                                </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-block-5">
                        <div class=" model-block">
                            <div class="model-box model-inner-block7"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/modal_icon7.png" alt="" class="img-responsive model-icon">
                                <h4>Segments</h4>
                                <p>We offer Retailers, Distributors, Marster Distributors, White Label Partners and API Channel Partners</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-block-6 col-lg-6">
                    <div class=" model-block">
                        <div class="model-box model-inner-block8"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/modal_icon8.png" alt="" class="img-responsive model-icon">
                            <h4>Cost Structures</h4>
                            <p>We have kept the Pricing in a very easy manner for every Franchise Owner to make it work</p>
                        </div>
                    </div>
                </div>
                <div class="col-block-7 col-lg-6">
                    <div class=" model-block">
                        <div class="model-box model-inner-block9"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/modal_icon9.png" alt="" class="img-responsive model-icon">
                            <h4>Renenue Strems</h4>
                            <p>We build the commission structure for every Franchise Owner to earn good revenue</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== Start Choose Section ======-->
    <section class="why-choose-section">
        <div class="container">
            <div class="section-title text-center pb-5">
                <div class="sec-title">
                    <div class="sec-tagline"> <span class="sec-line-left"></span> Why Choose Us<span class="sec-line-right"></span> </div>
                    <h2> Why People Trust <br>
                        <strong>Hisfull Your Company?</strong></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="why-choose-block">
                        <div class="choose-inner-box" style="background-image: url({{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/images/background/pattern-4.png)">
                            <div class="choose-detail">
                                <div class="upper-box">
                                    <div class="icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/choose_fast.png" alt="Fast Response"> </div>
                                    <h4>Fast Response</h4>
                                </div>
                                <div class="text">We use Restfull API's which deliver fastest response over requests made from web or mobile devices. </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="why-choose-block">
                        <div class="choose-inner-box" style="background-image: url({{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/images/background/pattern-4.png)">
                            <div class="choose-detail">
                                <div class="upper-box">
                                    <div class="icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/choose_support.png" alt="24/7 Support"> </div>
                                    <h4>24/7 Support</h4>
                                </div>
                                <div class="text">Our customer service is best in class and commited to serve you 24x7 for your queries and questions. </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="why-choose-block">
                        <div class="choose-inner-box" style="background-image: url({{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/images/background/pattern-4.png)">
                            <div class="choose-detail">
                                <div class="upper-box">
                                    <div class="icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/choose_commission.png" alt="High Commission & Margins"> </div>
                                    <h4>High Commission & Margins</h4>
                                </div>
                                <div class="text">We are Provide Heights commission and Margins for all Agents in over india. </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="why-choose-block">
                        <div class="choose-inner-box" style="background-image: url({{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/images/background/pattern-4.png)">
                            <div class="choose-detail">
                                <div class="upper-box">
                                    <div class="icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/choose_safe.png" alt="Safe And Secure"> </div>
                                    <h4>Safe And Secure</h4>
                                </div>
                                <div class="text">Our Company is Recognition in startup India program by Govt. of India so it’s Safe and Secure. </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="why-choose-block">
                        <div class="choose-inner-box" style="background-image: url({{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/images/background/pattern-4.png)">
                            <div class="choose-detail">
                                <div class="upper-box">
                                    <div class="icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/choose_integration.png" alt="Esay Integration"> </div>
                                    <h4>Esay Integration</h4>
                                </div>
                                <div class="text">Singup and go with easy integration feature for your web and mobile applications. </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="why-choose-block">
                        <div class="choose-inner-box" style="background-image: url({{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/images/background/pattern-4.png)">
                            <div class="choose-detail">
                                <div class="upper-box">
                                    <div class="icon"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/icon/choose_platform.png" alt="All Platform"> </div>
                                    <h4>All Platform</h4>
                                </div>
                                <div class="text">No worries of technology or platform your application is built on we support all of them. </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Choose Section ======-->
@endsection
