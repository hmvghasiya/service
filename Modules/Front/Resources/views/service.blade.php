@extends("front::layouts.master")
@section("content")
  <!--====== Page title area Start ======-->
    <section class="page-title-area">
        <div class="container">
            <div class="page-title-content text-center">
                <h1 class="page-title">Services</h1>
                <ul class="breadcrumb-nav">
                    <li><a href="{{route('front.home')}}">Home</a></li>
                    <li class="active">Services</li>
                </ul>
            </div>
        </div>
        <div class="page-title-effect d-none d-md-block"> <img class="particle-1 animate-zoom-fade" src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/particle/particle-1.png" alt="particle One"> <img class="particle-2 animate-rotate-me" src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/particle/particle-2.png" alt="particle Two"> <img class="particle-3 animate-float-bob-x"
                src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/particle/particle-3.png" alt="particle Three"> <img class="particle-4 animate-float-bob-y" src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/particle/particle-4.png" alt="particle Four"> <img class="particle-5 animate-float-bob-y" src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/particle/particle-5.png"
                alt="particle Five"> </div>
    </section>
    <!--====== Page title area End ======-->

    <section class="main_wrapper all-service-section position-relative">
        <div class="container">
            <div class="section-title text-center pb-5">
                <div class="sec-title">
                    <div class="sec-tagline"> <span class="sec-line-left"></span> Our Services <span class="sec-line-right"></span> </div>
                    <h2>Work with us to get the<br>
                        <strong>best experience.</strong></h2>
                    <p> We offer an opportunity to add to your income and growth of your business with highest commission or margin on services. So, if you want to build your business this earning option is just fit for you.</p>
                </div>
            </div>
        </div>
        <div class="container-fluid service-container">
            <div class="inner-service-wrapper">
                <div class="service-detail-block">
                    <article class="block-detail-info left">
                        <div class="detail-block">
                            <figure class="image-block"> <a href="#"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/service-page/aeps.png" alt=""> </a> </figure>
                            <span class="small-heading">Aadhar Service</span>
                            <div class="content-detail">
                                <div class="pointer"></div>
                                <h4 class="title-sub">Common Service Centers</h4>
                                <h2 class="heading-title">Aadhar Service</h2>
                                <p>Aadhaar enabled Payment System is a safe, secure payment method provided by the NPCI that allows customers to withdraw cash and avail other basic banking benefits such as balance enquiry. AEPS is a new payment service offered
                                    by the National Payments Corporation of India to banks, financial institutions using 'AADHAAR'. AEPS stands for 'AADHAAR Enabled Payment System'. AEPS is a bank led model, which allows online financial inclusion transaction
                                    at Micro-ATM through the Business correspondent of any bank using the AADHAAR authentication. </p>
                                <div class="button_center"> <a href="#" class="template-btn primary-bg-2">Read More <i class="far fa-arrow-right"></i></a></div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="service-detail-block">
                    <article class="block-detail-info right">
                        <div class="detail-block">
                            <figure class="image-block"> <a href="#"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/service-page/dmt.png" alt=""> </a> </figure>
                            <span class="small-heading">Money Transfer</span>
                            <div class="content-detail">
                                <div class="pointer"></div>
                                <h4 class="title-sub">Common Service Centers</h4>
                                <h2 class="heading-title">Money Transfer</h2>
                                <p>CSC Launched Instant Domestic Money Transfer (DMT) Services. CSC DMT brings you the convenience of transferring money from your place of residence to any Bank account across the country. CSC, Money Transfer enables domestic
                                    money transfer through a very safe channel to almost all banks across India. The money transfer service is available at our all retailers' mobile apps and on website login. It enables walk -in customers even without
                                    a bank account from place of transfer, to transfer funds to any bank account anywhere in India. The DMT platform support dual transfer mode, IMPS (Immediate Payment Service) & NEFT (National Electronic Fund Transfer).
                                    Thank to National Payment Corporation of India (NPCI), IMPS works 24 X 7 & the recipient receive the amount in the account within few seconds</p>
                                <div class="button_center"> <a href="#" class="template-btn primary-bg-2">Read More <i class="far fa-arrow-right"></i></a> </div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="service-detail-block">
                    <article class="block-detail-info left">
                        <div class="detail-block">
                            <figure class="image-block"> <a href="#"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/service-page/bbps.png" alt=""> </a> </figure>
                            <span class="small-heading">Bill Payment</span>
                            <div class="content-detail">
                                <div class="pointer"></div>
                                <h4 class="title-sub">Common Service Centers</h4>
                                <h2 class="heading-title">Bill Payment</h2>
                                <p>Bharat Bill Payment System (BBPS) Simplifies bills payment process also enhances the security & speed of bill payment process. The service is available in multiple payment modes, online and through a network of agents.
                                    An instant confirmation is generated for the bill payments. The BBPS will transform the society from cash to electronic payment system, making it less dependent on cash. Currently you can pay bill for Utility (Gas,
                                    electricity, water, DTH) and Telecom billers.</p>
                                <div class="button_center"><a href="#" class="template-btn primary-bg-2">Read More <i class="far fa-arrow-right"></i></a> </div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="service-detail-block">
                    <article class="block-detail-info right">
                        <div class="detail-block">
                            <figure class="image-block"> <a href="#"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/service-page/pan-card.png" alt=""> </a> </figure>
                            <span class="small-heading">Pan Card</span>
                            <div class="content-detail">
                                <div class="pointer"></div>
                                <h4 class="title-sub">Common Service Centers</h4>
                                <h2 class="heading-title">Pan Card</h2>
                                <p>PAN (Permanent account number) cards are a necessity for all taxpayers in the country. The 10-digit alphanumeric number is linked to the income tax details of every taxpayer. To file for taxes, the Government of India has
                                    made it mandatory for all taxpayers to have a PAN card. For those applying for a new PAN card, or require a replacement or reprint, or have any grievances, they can contact two government service providers namely -
                                    NSDL (Income Tax PAN services unit) or the UTI Infrastructure Technology Services Limited (UTIITSL). Income Tax Department (ITD) has appointed these two entities for the purpose of getting and processing PAN application
                                    form and checking pan card status. For customers having queries or grievances relating to their PAN card, they can contact the below listed toll-free numbers of both the NSDL (Income Tax PAN services unit) or the UTI
                                    Infrastructure Technology Services Limited (UTIITSL). </p>
                                <div class="button_center"> <a href="#" class="template-btn primary-bg-2">Read More <i class="far fa-arrow-right"></i></a></div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="service-detail-block">
                    <article class="block-detail-info left">
                        <div class="detail-block">
                            <figure class="image-block"> <a href="#"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/service-page/recharge.png" alt=""> </a> </figure>
                            <span class="small-heading">Recharges</span>
                            <div class="content-detail">
                                <div class="pointer"></div>
                                <h4 class="title-sub">Common Service Centers</h4>
                                <h2 class="heading-title">Recharges</h2>
                                <p>Recharging Mobile, Dth & Data Cards are now easier than ever. Retailers can quickly recharge Mobile and Data Cards of all operators through the CSC portal. This facility provides customers with ease of access as they need
                                    to visit their nearest CC retail outlet instead of searching for their operator’s official store. CSC’s integration with all major operators allows the recharges to happen on a real time basis.</p>
                                <div class="button_center"> <a href="#" class="template-btn primary-bg-2">Read More <i class="far fa-arrow-right"></i></a></div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="service-detail-block">
                    <article class="block-detail-info right">
                        <div class="detail-block">
                            <figure class="image-block"> <a href="#"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/service-page/other_service-img.png" alt=""> </a> </figure>
                            <span class="add">GST Services</span>
                            <div class="content-detail">
                                <div class="pointer"></div>
                                <h4 class="title-sub">Common Service Centers</h4>
                                <h2 class="heading-title">GST Services</h2>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to
                                    make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                                <div class="button_center"><a href="#" class="template-btn primary-bg-2">Read More <i class="far fa-arrow-right"></i></a> </div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="service-detail-block">
                    <article class="block-detail-info left">
                        <div class="detail-block">
                            <figure class="image-block"> <a href="#"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/service-page/other_service-img.png" alt=""> </a> </figure>
                            <span class="small-heading">Fixed Deposit </span>
                            <div class="content-detail">
                                <div class="pointer"></div>
                                <h4 class="title-sub">Common Service Centers</h4>
                                <h2 class="heading-title">Fixed Deposit </h2>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to
                                    make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                                <div class="button_center"> <a href="#" class="template-btn primary-bg-2">Read More <i class="far fa-arrow-right"></i></a> </div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="service-detail-block">
                    <article class="block-detail-info right">
                        <div class="detail-block">
                            <figure class="image-block"> <a href="#"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/service-page/other_service-img.png" alt=""> </a> </figure>
                            <span class="small-heading">CSC Ayurvedic Clinic</span>
                            <div class="content-detail">
                                <div class="pointer"></div>
                                <h4 class="title-sub">Common Service Centers</h4>
                                <h2 class="heading-title">CSC Ayurvedic Clinic</h2>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to
                                    make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                                <div class="button_center"> <a href="#" class="template-btn primary-bg-2">Read More <i class="far fa-arrow-right"></i></a> </div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="service-detail-block">
                    <article class="block-detail-info left">
                        <div class="detail-block ">
                            <figure class="image-block"> <a href="#"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/service-page/other_service-img.png" alt=""> </a> </figure>
                            <span class="small-heading">Company Registration</span>
                            <div class="content-detail">
                                <div class="pointer"></div>
                                <h4 class="title-sub">Common Service Centers</h4>
                                <h2 class="heading-title">Company Registration</h2>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to
                                    make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                                <div class="button_center"> <a href="#" class="template-btn primary-bg-2">Read More <i class="far fa-arrow-right"></i></a> </div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="service-detail-block">
                    <article class="block-detail-info right">
                        <div class="detail-block">
                            <figure class="image-block"> <a href="#"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/service-page/other_service-img.png" alt=""> </a> </figure>
                            <span class="small-heading">Government to Customer</span>
                            <div class="content-detail">
                                <div class="pointer"></div>
                                <h4 class="title-sub">Common Service Centers</h4>
                                <h2 class="heading-title">Government to Customer</h2>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to
                                    make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                                <div class="button_center"><a href="#" class="template-btn primary-bg-2">Read More <i class="far fa-arrow-right"></i></a> </div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="service-detail-block">
                    <article class="block-detail-info left">
                        <div class="detail-block ">
                            <figure class="image-block"> <a href="#"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/service-page/other_service-img.png" alt=""> </a> </figure>
                            <span class="small-heading">ITR Filing</span>
                            <div class="content-detail">
                                <div class="pointer"></div>
                                <h4 class="title-sub">Common Service Centers</h4>
                                <h2 class="heading-title">ITR Filing</h2>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to
                                    make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                                <div class="button_center"> <a href="#" class="template-btn primary-bg-2">Read More <i class="far fa-arrow-right"></i></a> </div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="service-detail-block">
                    <article class="block-detail-info right">
                        <div class="detail-block">
                            <figure class="image-block"> <a href="#"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/service-page/other_service-img.png" alt=""> </a> </figure>
                            <span class="small-heading">ISO Certification</span>
                            <div class="content-detail">
                                <div class="pointer"></div>
                                <h4 class="title-sub">Common Service Centers</h4>
                                <h2 class="heading-title">ISO Certification</h2>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to
                                    make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                                <div class="button_center"> <a href="#" class="template-btn primary-bg-2">Read More <i class="far fa-arrow-right"></i></a></div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="service-detail-block">
                    <article class="block-detail-info left">
                        <div class="detail-block ">
                            <figure class="image-block"> <a href="#"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/service-page/other_service-img.png" alt=""> </a> </figure>
                            <span class="small-heading">Trade India (Google by Business)</span>
                            <div class="content-detail">
                                <div class="pointer"></div>
                                <h4 class="title-sub">Common Service Centers</h4>
                                <h2 class="heading-title">Trade India (Google by Business)</h2>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to
                                    make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                                <div class="button_center"> <a href="#" class="template-btn primary-bg-2">Read More <i class="far fa-arrow-right"></i></a> </div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="service-detail-block">
                    <article class="block-detail-info right">
                        <div class="detail-block">
                            <figure class="image-block"> <a href="#"> <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}assets/front/assets/img/services/service-page/other_service-img.png" alt=""> </a> </figure>
                            <span class="small-heading">Amazon Store </span>
                            <div class="content-detail">
                                <div class="pointer"></div>
                                <h4 class="title-sub">Common Service Centers</h4>
                                <h2 class="heading-title">Amazon Store </h2>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to
                                    make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                                <div class="button_center"> <a href="#" class="template-btn primary-bg-2">Read More <i class="far fa-arrow-right"></i></a> </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection