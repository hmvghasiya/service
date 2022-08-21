
<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Dashboard'); ?>
<?php $__env->startSection('content'); ?>


<style>

.dmt-img img{
    height: 260px;
}
.img-title{
    border :1px solid darkorchid;
}
.img-title img{
    width:30px;

}
.col{
    flex: 0 0 16.6666666667%;
    max-width: 16.6666666667%;
    border:1px solid red!important;
}

.card {
    margin-bottom: 1.875rem;
    background-color: #fff;
    transition: all .5s ease-in-out;
    position: relative;
    border: 0px solid transparent;
    border-radius: 1.25rem;
    box-shadow: 0px 12px 23px 0px rgb(63 154 224 / 4%);
    height: calc(100% - 30px);
   
}
.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem;
}



.box{
    box-shadow: 0 10px 10px -5px;
}

.wrapper-title{
    position: relative;
}
.box{
    opacity: 1;
    display: block;
    transition: .5s ease;
   backface-visibility: hidden;
}
.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}
.wrapper-title:hover > .box {
  /* opacity: 0.3; */
  background-image:linear-gradient(
#ada996
→ 
#f2f2f2
→ 
#dbdbdb
→ 
#eaeaea)
}

.wrapper-title:hover .middle {
  opacity: 1;
}

.text {
  background-color: #04AA6D;
  color: white;
  font-size: 16px;
  padding: 16px 32px;
}

.box:hover {

background-image: linear-gradient(to right, #d7e1ec, #ffffff);
}
.box h6{
    font-size: 17px;
}

.margin-title{
    margin-top: 1rem;
}



</style>
 <?php if(Myhelper::hasNotRole(['admin','whitelable','statehead','apiuser'])): ?>
 <div class="content">
        <div class="row d-flex ">
                <div class="col-md-9 py-5">
                    <div class="row ">
                          <a href="<?php echo e(route('aeps')); ?>">
                          <div class="col-xl-2 col-xxl-3 col-lg-3 col-md-4 col-sm-6 wrapper-title">
								<div class="card text-center border border-danger box">
									<div class="card-body">
                                        <img src="<?php echo e(asset('assets/images/services/AePS.png')); ?>" style="width:80px; height:80px">
                                            <h6 class="font-w600 fs-16 mb-1"><a href="<?php echo e(route('aeps')); ?>" class="text-black">Aeps</a></h6>
                                            
									</div>
								</div>
							</div>

                          </a>

                          <a href="<?php echo e(route('dmt1')); ?>">
                          <div class="col-xl-2 col-xxl-3 col-lg-3 col-md-4 col-sm-6">
								<div class="card text-center border border-danger box">
									<div class="card-body">
                                    <img src="<?php echo e(asset('assets/images/moneytransfer1.png')); ?>" style="width:80px; height:80px">
                                            <h6 class="font-w600 fs-16 mb-1"><a href="<?php echo e(route('dmt1')); ?>" class="text-black">money transfer</a></h6>
                                            
									</div>
								</div>
							</div>
                          </a>
                          
                          <a href="<?php echo e(route('dmt2')); ?>">
                          <div class="col-xl-2 col-xxl-3 col-lg-3 col-md-4 col-sm-6">
								<div class="card text-center border border-danger box">
									<div class="card-body">
                                    <img src="<?php echo e(asset('assets/images/moneytransfer1.png')); ?>" style="width:80px; height:80px">
                                            <h6 class="font-w600 fs-16 mb-1"><a href="<?php echo e(route('dmt2')); ?>" class="text-black">xpress money transfer</a></h6>
                                            
									</div>
								</div>
							</div>
                          </a>

                          <a href="<?php echo e(route('aeps')); ?>">
                          <div class="col-xl-2 col-xxl-3 col-lg-3 col-md-4 col-sm-6">
								<div class="card text-center border border-danger box">
									<div class="card-body">
                                        <img src="<?php echo e(asset('assets/images/services/FAePS.png')); ?>" style="width:80px; height:80px">
                                            <h6 class="font-w600 fs-16 mb-1"><a href="<?php echo e(route('aeps')); ?>" class="text-black">Adharpay</a></h6>
                                            
									</div>
								</div>
							</div>
                          </a>
                            

                            

                            <a href="<?php echo e(route('pancard' , ['type' => 'uti'])); ?>">
                            <div class="col-xl-2 col-xxl-3 col-lg-3 col-md-4 col-sm-6">
								<div class="card text-center border border-danger box">
									<div class="card-body">
                                    <img src="<?php echo e(asset('assets/images/services/id card.png')); ?>" style="width:80px; height:80px">
                                            <h6 class="font-w600 fs-16 mb-1"><a href="<?php echo e(route('pancard' , ['type' => 'uti'])); ?>" class="text-black">pancard</a></h6>
                                           
									</div>
								</div>
							</div>
                            </a>

                           
                           <div class="col-xl-2 col-xxl-3 col-lg-3 col-md-4 col-sm-6 wrapper-title">
								<div class="card text-center border border-danger box">
									<div class="card-body">
                                        <img src="<?php echo e(asset('assets/images/services/mATM.png')); ?>" style="width:80px; height:80px">
                                        <h6 class="font-w600 fs-16 mb-1"><a href="application.html" class="text-black">Micro atm</a></h6>
                                        <div class="middle">
                                          <div class="text"   data-target="#mymodel" data-toggle="modal">Order Now</div>
                                        </div>
                                            
									</div>
								</div>
							</div>
                        


                           <a href="<?php echo e(route('recharge' , ['type' => 'mobile'])); ?>">
                           <div class="col-xl-2 col-xxl-3 col-lg-3 col-md-4 col-sm-6">
								<div class="card text-center border border-danger box">
									<div class="card-body">
                                        <img src="<?php echo e(asset('assets/images/services/Mobile Recharge.png')); ?>" style="width:80px; height:80px">
                                            <h6 class="font-w600 fs-16 mb-1"><a href="<?php echo e(route('recharge' , ['type' => 'mobile'])); ?>" class="text-black">Mobile recharge</a></h6>
                                            
									</div>
								</div>
							</div>

                           </a>
                           
                           

                           <a href="<?php echo e(route('recharge' , ['type' => 'dth'])); ?>">
                           <div class="col-xl-2 col-xxl-3 col-lg-3 col-md-4 col-sm-6">
								<div class="card text-center border border-danger box">
									<div class="card-body">
                                        <img src="<?php echo e(asset('assets/images/services/DTH Rech.png')); ?>" style="width:80px; height:80px">
                                            <h6 class="font-w600 fs-16 mb-1"><a href="<?php echo e(route('recharge' , ['type' => 'dth'])); ?>" class="text-black">Dth recharge</a></h6>
                                            
									</div>
								</div>
							</div>
                           </a>

                          <a href="<?php echo e(route('bill' , ['type' => 'electricity'])); ?>">
                          <div class="col-xl-2 col-xxl-3 col-lg-3 col-md-4 col-sm-6">
								<div class="card text-center border border-danger box">
									<div class="card-body">
                                        <img src="<?php echo e(asset('assets/images/services/Electricity Bill.png')); ?>" style="width:80px; height:80px">
                                            <h6 class="font-w600 fs-16 mb-1"><a href="<?php echo e(route('bill' , ['type' => 'electricity'])); ?>" class="text-black">electricity</a></h6>
                                            
									</div>
								</div>
							</div>
                          </a>

                            
                          <a href="<?php echo e(route('bill' , ['type' => 'electricity'])); ?>">
                          <div class="col-xl-2 col-xxl-3 col-lg-3 col-md-4 col-sm-6">
								<div class="card text-center border border-danger box">
									<div class="card-body">
                                        <img src="<?php echo e(asset('assets/images/services/Bharat Bill Payment.png')); ?>" style="width:90px; height:80px; object-fit: contain;">
                                            <h6 class="font-w600 fs-16 mb-1"><a href="<?php echo e(route('bill' , ['type' => 'electricity'])); ?>" class="text-black">bharat bill pay</a></h6>
                                            
									</div>
								</div>
							</div>
                          </a>


                           <a href="<?php echo e(route('bill' , ['type' => 'insurance'])); ?>">
                           <div class="col-xl-2 col-xxl-3 col-lg-3 col-md-4 col-sm-6">
								<div class="card text-center border border-danger box">

									<div class="card-body">
                                        <img src="<?php echo e(asset('assets/images/services/life insurance.png')); ?>" style="width:80px; height:80px">
                                            <h6 class="font-w600 fs-16 mb-1"><a href="<?php echo e(route('bill' , ['type' => 'insurance'])); ?>" class="text-black">insurance</a></h6>
                                            
									</div>
								</div>
							</div>
                           </a>

                           
                           
                           <div class="col-xl-2 col-xxl-3 col-lg-3 col-md-4 col-sm-6 wrapper-title">
								<div class="card text-center border border-danger box">
									<div class="card-body">
                                        <img src="<?php echo e(asset('assets/images/services/Flight booking.png')); ?>" style="width:80px; height:80px">
                                            <h6 class="font-w600 fs-16 mb-1"><a href="<?php echo e(route('comingsoon')); ?>" class="text-black">Tour and travel</a></h6>
                                            <!-- <div class="middle">
                                              <div class="text">Order Now</div>
                                            </div> -->
                                            
									</div>
								</div>
							</div>
                           

                           <a href="https://www.agent.irctc.co.in/">
                           <div class="col-xl-2 col-xxl-3 col-lg-3 col-md-4 col-sm-6">
								<div class="card text-center border border-danger box">
									<div class="card-body">
                                        <img src="<?php echo e(asset('assets/images/services/train booking.png')); ?>" style="width:80px; height:80px">
                                            <h6 class="font-w600 fs-16 mb-1"><a href="https://www.agent.irctc.co.in/" class="text-black">Train</a></h6>
                                           
									</div>
								</div>
							</div>
                           </a>

                            <a href="https://drive.google.com/open?id=13FbVSOuplWlJNhwKMjTmKHkyA5CZPkh0">
                            <div class="col-xl-2 col-xxl-3 col-lg-3 col-md-4 col-sm-6">
								<div class="card text-center border border-danger box">
									<div class="card-body">
                                        <img src="<?php echo e(asset('assets/images/services/Morpho.png')); ?>" style="width:80px; height:80px; color:blue;">
                                            <h6 class="font-w600 fs-16 mb-1"><a href="https://drive.google.com/open?id=13FbVSOuplWlJNhwKMjTmKHkyA5CZPkh0" class="text-black">Finger device</a></h6>
                                            
									</div>
								</div>
							</div>
                            </a>
                            <a href="<?php echo e(route('travel' , ['type' => 'bus'])); ?>">
                           <div class="col-xl-2 col-xxl-3 col-lg-3 col-md-4 col-sm-6">
								<div class="card text-center border border-danger box">
									<div class="card-body">
                                        <img src="<?php echo e(asset('assets/images/services/train booking.png')); ?>" style="width:80px; height:80px">
                                            <h6 class="font-w600 fs-16 mb-1"><a href="<?php echo e(route('travel' , ['type' => 'bus'])); ?>" class="text-black">Bus Bookung</a></h6>
                                           
									</div>
								</div>
							</div>
                           </a>
                            <a href="<?php echo e(route('travel' , ['type' => 'hotel'])); ?>">
                           <div class="col-xl-2 col-xxl-3 col-lg-3 col-md-4 col-sm-6">
								<div class="card text-center border border-danger box">
									<div class="card-body">
                                        <img src="<?php echo e(asset('assets/images/services/train booking.png')); ?>" style="width:80px; height:80px">
                                            <h6 class="font-w600 fs-16 mb-1"><a href="<?php echo e(route('travel' , ['type' => 'hotel'])); ?>" class="text-black">Hotel Bookung</a></h6>
                                           
									</div>
								</div>
							</div>
                           </a>
                           
                           <a href="<?php echo e(route('prepaidcard')); ?>">
                            <div class="col-xl-2 col-xxl-3 col-lg-3 col-md-4 col-sm-6">
								<div class="card text-center border border-danger box">
									<div class="card-body">
                                    <img src="<?php echo e(asset('assets/images/services/id card.png')); ?>" style="width:80px; height:80px">
                                            <h6 class="font-w600 fs-16 mb-1"><a href="" class="text-black">Prepaid Card</a></h6>
                                           
									</div>
								</div>
							</div>
                            </a>
                            
                            <a href="<?php echo e(route('cms')); ?>">
                            <div class="col-xl-2 col-xxl-3 col-lg-3 col-md-4 col-sm-6">
								<div class="card text-center border border-danger box">
									<div class="card-body">
                                    <img src="<?php echo e(asset('assets/images/services/id card.png')); ?>" style="width:80px; height:80px">
                                            <h6 class="font-w600 fs-16 mb-1"><a href="" class="text-black">CMS</a></h6>
                                           
									</div>
								</div>
							</div>
                            </a>
                            <a href="<?php echo e(route('qrcode')); ?>">
                            <div class="col-xl-2 col-xxl-3 col-lg-3 col-md-4 col-sm-6">
								<div class="card text-center border border-danger box">
									<div class="card-body">
                                    <img src="<?php echo e(asset('assets/images/services/id card.png')); ?>" style="width:80px; height:80px">
                                            <h6 class="font-w600 fs-16 mb-1"><a href="" class="text-black">QR-Code</a></h6>
                                           
									</div>
								</div>
							</div>
                            </a>
                            <a href="<?php echo e(route('virtualaccount')); ?>">
                            <div class="col-xl-2 col-xxl-3 col-lg-3 col-md-4 col-sm-6">
								<div class="card text-center border border-danger box">
									<div class="card-body">
                                    <img src="<?php echo e(asset('assets/images/services/id card.png')); ?>" style="width:80px; height:80px">
                                            <h6 class="font-w600 fs-16 mb-1"><a href="" class="text-black">Virtual Account</a></h6>
                                           
									</div>
								</div>
							</div>
                            </a>
                            <a href="<?php echo e(route('insurance')); ?>">
                           <div class="col-xl-2 col-xxl-3 col-lg-3 col-md-4 col-sm-6">
								<div class="card text-center border border-danger box">

									<div class="card-body">
                                        <img src="<?php echo e(asset('assets/images/services/life insurance.png')); ?>" style="width:80px; height:80px">
                                            <h6 class="font-w600 fs-16 mb-1"><a href="<?php echo e(route('insurance')); ?>" class="text-black">General Insurance</a></h6>
                                            
									</div>
								</div>
							</div>
                           </a>
                       
                    </div>
                </div>

                <div class="modal" id="mymodel">
                  <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"> &times;</button>
                                
                            </div>
                            <div class="content-group margin-title">
                                   <div class="panel-body bg-teal-300 border-radius-top text-center" style="padding: 10px">
                                        <div class="content-group-sm">
                                            <img src="<?php echo e(asset('assets/helpdesk.png')); ?>" class="img-responsive mb-10" style="margin: auto; width: 200px">
                                        </div>

                                            <a href="#" class="display-inline-block content-group-sm mb-5">
                                                <img src="<?php echo e(asset('assets/support.png')); ?>" class="img-circle img-responsive" alt="" style="width: 80px; height: 80px;">
                                            </a>
                                            <span class="display-block"><b>Timing - 10 AM to 7 PM</b></span>
                                    </div>

                                        <div class="panel panel-body no-border-top no-border-radius-top text-center" style="padding: 10px">
                                            <div class="form-group mt-5 mb-5">
                                                <h5 class="text-semibold"><i class="fa fa-phone"></i> Call Us</h5>
                                                <span><?php echo e($mydata['supportnumber']); ?></span>
                                            </div>

                                            <div class="form-group  mb-5">
                                                <h5 class="text-semibold"><i class="fa fa-envelope"></i>  Email Us:</h5>
                                                <span><?php echo e($mydata['supportemail']); ?></span>
                                            </div>
                                        </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
        <div class="col-md-3">
                <div class="content-group">
                    <div class="panel-body bg-teal-300 border-radius-top text-center" style="padding: 10px">
                        <div class="content-group-sm">
                            <img src="<?php echo e(asset('assets/helpdesk.png')); ?>" class="img-responsive mb-10" style="margin: auto; width: 200px">
                        </div>

                        <a href="#" class="display-inline-block content-group-sm mb-5">
                            <img src="<?php echo e(asset('assets/support.png')); ?>" class="img-circle img-responsive" alt="" style="width: 80px; height: 80px;">
                        </a>
                        <span class="display-block"><b>Timing - 10 AM to 7 PM</b></span>
                    </div>

                    <div class="panel panel-body no-border-top no-border-radius-top text-center" style="padding: 10px">
                        <div class="form-group mt-5 mb-5">
                            <h5 class="text-semibold"><i class="fa fa-phone"></i> Call Us</h5>
                            <span><?php echo e($mydata['supportnumber']); ?></span>
                        </div>

                        <div class="form-group  mb-5">
                            <h5 class="text-semibold"><i class="fa fa-envelope"></i>  Email Us:</h5>
                            <span><?php echo e($mydata['supportemail']); ?></span>
                        </div>
                    </div>
                </div>

                <?php if(in_array(Auth::user()->role->slug, ['whitelable', 'md', 'distributor', 'admin'])): ?>
                    <div class="panel">
                        <div class="panel-heading bg-teal-700">
                            <h6 class="panel-title">User Panel<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body p-0">
                            <table class="table table-bordered" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Member Type</th>
                                        <th>Count</th>
                                        <?php if(Myhelper::hasRole(['admin', 'whitelable', 'md', 'distributor'])): ?>
                                        <th>Stock</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php if(in_array(Auth::user()->role->slug, ['admin'])): ?>
                                        <tr>
                                            <td><i class="icon-users2 icon-2x display-inline-block text-warning"></i></td>
                                            <td>White Label</td>
                                            <td><?php echo e($whitelable); ?></td>
                                            <?php if(Myhelper::hasRole(['admin'])): ?>
                                            <td></td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if(in_array(Auth::user()->role->slug, ['admin', 'whitelable'])): ?>
                                        <tr>
                                            <td><i class="icon-users2 icon-2x display-inline-block text-slate"></i></td>
                                            <td>Master Distributor</td>
                                            <td><?php echo e($md); ?></td>

                                            <?php if(Myhelper::hasRole(['admin', 'whitelable'])): ?>
                                                <td><?php echo e(Auth::user()->mstock); ?></td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if(in_array(Auth::user()->role->slug, ['admin', 'whitelable', 'md'])): ?>
                                        <tr>
                                            <td><i class="icon-users2 icon-2x display-inline-block text-teal"></i></td>
                                            <td>Distributor</td>
                                            <td><?php echo e($distributor); ?></td>
                                            <?php if(Myhelper::hasRole(['admin', 'whitelable', 'md'])): ?>
                                                <td><?php echo e(Auth::user()->dstock); ?></td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if(in_array(Auth::user()->role->slug, ['admin', 'whitelable', 'md', 'distributor'])): ?>
                                        <tr>
                                            <td><i class="icon-users2 icon-2x display-inline-block text-primary"></i></td>
                                            <td>Retailer</td>
                                            <td><?php echo e($retailer); ?></td>
                                            <?php if(Myhelper::hasRole(['admin', 'whitelable', 'md', 'distributor'])): ?>
                                                <td><?php echo e(Auth::user()->rstock); ?></td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if(in_array(Auth::user()->role->slug, ['admin'])): ?>
                                        <tr>
                                            <td><i class="icon-users2 icon-2x display-inline-block text-info"></i></td>
                                            <td>Other User</td>
                                            <td><?php echo e($other); ?></td>
                                            <?php if(Myhelper::hasRole(['admin'])): ?>
                                            <td></td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="panel">
                    
                    
                </div>
            </div>
        </div>
    </div>
 
 
 
    
    <?php else: ?>
    
    <div class="content">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-heading text-center bg-indigo-800">
                                <h5 class="panel-title">AePS Sales Statistics</h5>
                            </div>

                            <!-- Numbers -->
                            <div class="container-fluid panel-body">
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <div class="content-group no-margin">
                                            <h5 class="text-semibold no-margin"><i class="fa fa-inr position-left text-slate-600"></i><?php echo e($aeps['today']); ?></h5>
                                            <span>Today Sale</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="content-group no-margin">
                                            <h5 class="text-semibold no-margin"><i class="fa fa-inr position-left text-slate-600"></i><?php echo e($aeps['month']); ?></h5>
                                            <span>Month Sale</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="content-group no-margin">
                                            <h5 class="text-semibold no-margin"><i class="fa fa-inr position-left text-slate-600"></i><?php echo e($aeps['lastmonth']); ?></h5>
                                            <span>Last Month Sale</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /numbers -->

                            <!-- Tabs -->
                            <ul class="nav nav-lg nav-tabs nav-justified no-margin no-border-radius bg-indigo-400 border-top border-top-indigo-300">
                                <li class="active">
                                    <a href="#aeps-tue" class="text-size-small text-uppercase legitRipple" data-toggle="tab" aria-expanded="false">
                                        Today
                                    </a>
                                </li>

                                <li class="">
                                    <a href="#aeps-mon" class="text-size-small text-uppercase legitRipple" data-toggle="tab" aria-expanded="false">
                                        This Month
                                    </a>
                                </li>

                                <li>
                                    <a href="#aeps-fri" class="text-size-small text-uppercase legitRipple" data-toggle="tab" aria-expanded="true">
                                        Last Month
                                    </a>
                                </li>
                            </ul>
                            <!-- /tabs -->

                            <!-- Tabs content -->
                            <div class="tab-content">
                                <div class="tab-pane fade has-padding active in" id="aeps-tue">
                                    <ul class="media-list">
                                        <li class="media">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="media-left">
                                                        <i class="icon-check position-left text-success" style="font-size: 25px;padding: 10px 0px;"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        
                                                        <h5 class="no-margin">
                                                            <?php echo e($aeps['success']); ?>

                                                        </h5>
                                                        <span class="display-block text-muted" style="font-size:12px">Success</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="media-left">
                                                        <i class="icon-question3 position-left text-warning" style="font-size: 25px;padding: 10px 0px;"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="no-margin">
                                                            <?php echo e($aeps['pending']); ?>

                                                        </h5>
                                                        <span class="display-block text-muted" style="font-size:12px">Pending</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="media-left">
                                                        <i class="icon-x position-left text-danger" style="font-size: 25px;padding: 10px 0px;"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="no-margin">
                                                            <?php echo e($aeps['failed']); ?>

                                                        </h5>
                                                        <span class="display-block text-muted" style="font-size:12px">Failed</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /tabs content -->
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-heading text-center bg-primary-800">
                                <h5 class="panel-title">Bill Payment Sales Statistics</h5>
                            </div>

                            <!-- Numbers -->
                            <div class="container-fluid panel-body">
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <div class="content-group no-margin">
                                            <h5 class="text-semibold no-margin"><i class="fa fa-inr position-left text-slate-600"></i><?php echo e($billpayment['today']); ?></h5>
                                            <span>Today Sale</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="content-group no-margin">
                                            <h5 class="text-semibold no-margin"><i class="fa fa-inr position-left text-slate-600"></i><?php echo e($billpayment['month']); ?></h5>
                                            <span>Month Sale</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="content-group no-margin">
                                            <h5 class="text-semibold no-margin"><i class="fa fa-inr position-left text-slate-600"></i><?php echo e($billpayment['lastmonth']); ?></h5>
                                            <span>Last Month Sale</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /numbers -->

                            <!-- Tabs -->
                            <ul class="nav nav-lg nav-tabs nav-justified no-margin no-border-radius bg-primary-400 border-top border-top-primary-300">
                                <li class="active">
                                    <a href="#billpay-tue" class="text-size-small text-uppercase legitRipple" data-toggle="tab" aria-expanded="false">
                                        Today
                                    </a>
                                </li>

                                <li class="">
                                    <a href="#billpay-mon" class="text-size-small text-uppercase legitRipple" data-toggle="tab" aria-expanded="false">
                                        This Month
                                    </a>
                                </li>

                                <li>
                                    <a href="#billpay-fri" class="text-size-small text-uppercase legitRipple" data-toggle="tab" aria-expanded="true">
                                        Last Month
                                    </a>
                                </li>
                            </ul>
                            <!-- /tabs -->

                            <!-- Tabs content -->
                            <div class="tab-content">
                                <div class="tab-pane fade has-padding active in" id="billpay-tue">
                                    <ul class="media-list">
                                        <li class="media">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="media-left">
                                                        <i class="icon-check position-left text-success" style="font-size: 25px;padding: 10px 0px;"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        
                                                        <h5 class="no-margin">
                                                            <?php echo e($billpayment['success']); ?>

                                                        </h5>
                                                        <span class="display-block text-muted" style="font-size:12px">Success</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="media-left">
                                                        <i class="icon-question3 position-left text-warning" style="font-size: 25px;padding: 10px 0px;"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="no-margin">
                                                            <?php echo e($billpayment['pending']); ?>

                                                        </h5>
                                                        <span class="display-block text-muted" style="font-size:12px">Pending</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="media-left">
                                                        <i class="icon-x position-left text-danger" style="font-size: 25px;padding: 10px 0px;"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="no-margin">
                                                            <?php echo e($billpayment['failed']); ?>

                                                        </h5>
                                                        <span class="display-block text-muted" style="font-size:12px">Failed</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /tabs content -->
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-heading text-center bg-teal-800">
                                <h5 class="panel-title">Money Transfer Sales Statistics</h5>
                            </div>

                            <!-- Numbers -->
                            <div class="container-fluid panel-body">
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <div class="content-group no-margin">
                                            <h5 class="text-semibold no-margin"><i class="fa fa-inr position-left text-slate-600"></i><?php echo e($money['today']); ?></h5>
                                            <span>Today Sale</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="content-group no-margin">
                                            <h5 class="text-semibold no-margin"><i class="fa fa-inr position-left text-slate-600"></i><?php echo e($money['month']); ?></h5>
                                            <span>Month Sale</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="content-group no-margin">
                                            <h5 class="text-semibold no-margin"><i class="fa fa-inr position-left text-slate-600"></i><?php echo e($money['lastmonth']); ?></h5>
                                            <span>Last Month Sale</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /numbers -->

                            <!-- Tabs -->
                            <ul class="nav nav-lg nav-tabs nav-justified no-margin no-border-radius bg-teal-400 border-top border-top-teal-300">
                                <li class="active">
                                    <a href="#dmt-tue" class="text-size-small text-uppercase legitRipple" data-toggle="tab" aria-expanded="false">
                                        Today
                                    </a>
                                </li>

                                <li class="">
                                    <a href="#dmt-mon" class="text-size-small text-uppercase legitRipple" data-toggle="tab" aria-expanded="false">
                                        This Month
                                    </a>
                                </li>

                                <li>
                                    <a href="#dmt-fri" class="text-size-small text-uppercase legitRipple" data-toggle="tab" aria-expanded="true">
                                        Last Month
                                    </a>
                                </li>
                            </ul>
                            <!-- /tabs -->

                            <!-- Tabs content -->
                            <div class="tab-content">
                                <div class="tab-pane fade has-padding active in" id="dmt-tue">
                                    <ul class="media-list">
                                        <li class="media">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="media-left">
                                                        <i class="icon-check position-left text-success" style="font-size: 25px;padding: 10px 0px;"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        
                                                        <h5 class="no-margin">
                                                            <?php echo e($money['success']); ?>

                                                        </h5>
                                                        <span class="display-block text-muted" style="font-size:12px">Success</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="media-left">
                                                        <i class="icon-question3 position-left text-warning" style="font-size: 25px;padding: 10px 0px;"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="no-margin">
                                                            <?php echo e($money['pending']); ?>

                                                        </h5>
                                                        <span class="display-block text-muted" style="font-size:12px">Pending</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="media-left">
                                                        <i class="icon-x position-left text-danger" style="font-size: 25px;padding: 10px 0px;"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="no-margin">
                                                            <?php echo e($money['failed']); ?>

                                                        </h5>
                                                        <span class="display-block text-muted" style="font-size:12px">Failed</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /tabs content -->
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-heading text-center bg-danger-800">
                                <h5 class="panel-title">Recharge Sales Statistics</h5>
                            </div>

                            <!-- Numbers -->
                            <div class="container-fluid panel-body">
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <div class="content-group no-margin">
                                            <h5 class="text-semibold no-margin"><i class="fa fa-inr position-left text-slate-600"></i><?php echo e($recharge['today']); ?></h5>
                                            <span>Today Sale</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="content-group no-margin">
                                            <h5 class="text-semibold no-margin"><i class="fa fa-inr position-left text-slate-600"></i><?php echo e($recharge['month']); ?></h5>
                                            <span>Month Sale</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="content-group no-margin">
                                            <h5 class="text-semibold no-margin"><i class="fa fa-inr position-left text-slate-600"></i><?php echo e($recharge['lastmonth']); ?></h5>
                                            <span>Last Month Sale</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /numbers -->

                            <!-- Tabs -->
                            <ul class="nav nav-lg nav-tabs nav-justified no-margin no-border-radius bg-danger-400 border-top border-top-danger-300">
                                <li class="active">
                                    <a href="#recharge-tue" class="text-size-small text-uppercase legitRipple" data-toggle="tab" aria-expanded="false">
                                        Today
                                    </a>
                                </li>

                                <li class="">
                                    <a href="#recharge-mon" class="text-size-small text-uppercase legitRipple" data-toggle="tab" aria-expanded="false">
                                        This Month
                                    </a>
                                </li>

                                <li>
                                    <a href="#recharge-fri" class="text-size-small text-uppercase legitRipple" data-toggle="tab" aria-expanded="true">
                                        Last Month
                                    </a>
                                </li>
                            </ul>
                            <!-- /tabs -->

                            <!-- Tabs content -->
                            <div class="tab-content">
                                <div class="tab-pane fade has-padding active in" id="recharge-tue">
                                    <ul class="media-list">
                                        <li class="media">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="media-left">
                                                        <i class="icon-check position-left text-success" style="font-size: 25px;padding: 10px 0px;"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        
                                                        <h5 class="no-margin">
                                                            <?php echo e($recharge['success']); ?>

                                                        </h5>
                                                        <span class="display-block text-muted" style="font-size:12px">Success</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="media-left">
                                                        <i class="icon-question3 position-left text-warning" style="font-size: 25px;padding: 10px 0px;"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="no-margin">
                                                            <?php echo e($recharge['pending']); ?>

                                                        </h5>
                                                        <span class="display-block text-muted" style="font-size:12px">Pending</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="media-left">
                                                        <i class="icon-x position-left text-danger" style="font-size: 25px;padding: 10px 0px;"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="no-margin">
                                                            <?php echo e($recharge['failed']); ?>

                                                        </h5>
                                                        <span class="display-block text-muted" style="font-size:12px">Failed</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /tabs content -->
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-heading text-center bg-slate-800">
                                <h5 class="panel-title">Uti Pancard Sales Statistics</h5>
                            </div>

                            <!-- Numbers -->
                            <div class="container-fluid panel-body">
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <div class="content-group no-margin">
                                            <h5 class="text-semibold no-margin"><i class="fa fa-inr position-left text-slate-600"></i><?php echo e($utipancard['today']); ?></h5>
                                            <span>Today Sale</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="content-group no-margin">
                                            <h5 class="text-semibold no-margin"><i class="fa fa-inr position-left text-slate-600"></i><?php echo e($utipancard['month']); ?></h5>
                                            <span>Month Sale</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="content-group no-margin">
                                            <h5 class="text-semibold no-margin"><i class="fa fa-inr position-left text-slate-600"></i><?php echo e($utipancard['lastmonth']); ?></h5>
                                            <span>Last Month Sale</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /numbers -->

                            <!-- Tabs -->
                            <ul class="nav nav-lg nav-tabs nav-justified no-margin no-border-radius bg-slate-400 border-top border-top-slate-300">
                                <li class="active">
                                    <a href="#utipan-tue" class="text-size-small text-uppercase legitRipple" data-toggle="tab" aria-expanded="false">
                                        Today
                                    </a>
                                </li>

                                <li class="">
                                    <a href="#utipan-mon" class="text-size-small text-uppercase legitRipple" data-toggle="tab" aria-expanded="false">
                                        This Month
                                    </a>
                                </li>

                                <li>
                                    <a href="#utipan-fri" class="text-size-small text-uppercase legitRipple" data-toggle="tab" aria-expanded="true">
                                        Last Month
                                    </a>
                                </li>
                            </ul>
                            <!-- /tabs -->

                            <!-- Tabs content -->
                            <div class="tab-content">
                                <div class="tab-pane fade has-padding active in" id="utipan-tue">
                                    <ul class="media-list">
                                        <li class="media">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="media-left">
                                                        <i class="icon-check position-left text-success" style="font-size: 25px;padding: 10px 0px;"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        
                                                        <h5 class="no-margin">
                                                            <?php echo e($utipancard['success']); ?>

                                                        </h5>
                                                        <span class="display-block text-muted" style="font-size:12px">Success</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="media-left">
                                                        <i class="icon-question3 position-left text-warning" style="font-size: 25px;padding: 10px 0px;"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="no-margin">
                                                            <?php echo e($utipancard['pending']); ?>

                                                        </h5>
                                                        <span class="display-block text-muted" style="font-size:12px">Pending</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="media-left">
                                                        <i class="icon-x position-left text-danger" style="font-size: 25px;padding: 10px 0px;"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="no-margin">
                                                            <?php echo e($utipancard['failed']); ?>

                                                        </h5>
                                                        <span class="display-block text-muted" style="font-size:12px">Failed</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /tabs content -->
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-heading text-center bg-indigo-800">
                                <h5 class="panel-title">Matm Sales Statistics</h5>
                            </div>

                            <!-- Numbers -->
                            <div class="container-fluid panel-body">
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <div class="content-group no-margin">
                                            <h5 class="text-semibold no-margin"><i class="fa fa-inr position-left text-slate-600"></i><?php echo e($matm['today']); ?></h5>
                                            <span>Today Sale</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="content-group no-margin">
                                            <h5 class="text-semibold no-margin"><i class="fa fa-inr position-left text-slate-600"></i><?php echo e($matm['month']); ?></h5>
                                            <span>Month Sale</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="content-group no-margin">
                                            <h5 class="text-semibold no-margin"><i class="fa fa-inr position-left text-slate-600"></i><?php echo e($matm['lastmonth']); ?></h5>
                                            <span>Last Month Sale</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /numbers -->

                            <!-- Tabs -->
                            <ul class="nav nav-lg nav-tabs nav-justified no-margin no-border-radius bg-indigo-400 border-top border-top-indigo-300">
                                <li class="active">
                                    <a href="#aeps-tue" class="text-size-small text-uppercase legitRipple" data-toggle="tab" aria-expanded="false">
                                        Today
                                    </a>
                                </li>

                                <li class="">
                                    <a href="#aeps-mon" class="text-size-small text-uppercase legitRipple" data-toggle="tab" aria-expanded="false">
                                        This Month
                                    </a>
                                </li>

                                <li>
                                    <a href="#aeps-fri" class="text-size-small text-uppercase legitRipple" data-toggle="tab" aria-expanded="true">
                                        Last Month
                                    </a>
                                </li>
                            </ul>
                            <!-- /tabs -->

                            <!-- Tabs content -->
                            <div class="tab-content">
                                <div class="tab-pane fade has-padding active in" id="aeps-tue">
                                    <ul class="media-list">
                                        <li class="media">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="media-left">
                                                        <i class="icon-check position-left text-success" style="font-size: 25px;padding: 10px 0px;"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        
                                                        <h5 class="no-margin">
                                                            <?php echo e($matm['success']); ?>

                                                        </h5>
                                                        <span class="display-block text-muted" style="font-size:12px">Success</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="media-left">
                                                        <i class="icon-question3 position-left text-warning" style="font-size: 25px;padding: 10px 0px;"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="no-margin">
                                                            <?php echo e($matm['pending']); ?>

                                                        </h5>
                                                        <span class="display-block text-muted" style="font-size:12px">Pending</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="media-left">
                                                        <i class="icon-x position-left text-danger" style="font-size: 25px;padding: 10px 0px;"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="no-margin">
                                                            <?php echo e($matm['failed']); ?>

                                                        </h5>
                                                        <span class="display-block text-muted" style="font-size:12px">Failed</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /tabs content -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="content-group">
                    <div class="panel-body bg-teal-300 border-radius-top text-center" style="padding: 10px">
                        <div class="content-group-sm">
                            <img src="<?php echo e(asset('assets/helpdesk.png')); ?>" class="img-responsive mb-10" style="margin: auto; width: 200px">
                        </div>

                        <a href="#" class="display-inline-block content-group-sm mb-5">
                            <img src="<?php echo e(asset('assets/support.png')); ?>" class="img-circle img-responsive" alt="" style="width: 80px; height: 80px;">
                        </a>
                        <span class="display-block"><b>Timing - 10 AM to 7 PM</b></span>
                    </div>

                    <div class="panel panel-body no-border-top no-border-radius-top text-center" style="padding: 10px">
                        <div class="form-group mt-5 mb-5">
                            <h5 class="text-semibold"><i class="fa fa-phone"></i> Call Us</h5>
                            <span><?php echo e($mydata['supportnumber']); ?></span>
                        </div>

                        <div class="form-group  mb-5">
                            <h5 class="text-semibold"><i class="fa fa-envelope"></i>  Email Us:</h5>
                            <span><?php echo e($mydata['supportemail']); ?></span>
                        </div>
                    </div>
                </div>

                <?php if(in_array(Auth::user()->role->slug, ['whitelable', 'md', 'distributor', 'admin','statehead'])): ?>
                    <div class="panel">
                        <div class="panel-heading bg-teal-700">
                            <h6 class="panel-title">User Panel<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body p-0">
                            <table class="table table-bordered" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Member Type</th>
                                        <th>Count</th>
                                        <?php if(Myhelper::hasRole(['admin', 'whitelable', 'md', 'distributor','statehead'])): ?>
                                        <th>Stock</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php if(in_array(Auth::user()->role->slug, ['admin','statehead'])): ?>
                                        <tr>
                                            <td><i class="icon-users2 icon-2x display-inline-block text-warning"></i></td>
                                            <td> Admin</td>
                                            <td><?php echo e($whitelable); ?></td>
                                            <?php if(Myhelper::hasRole(['admin'])): ?>
                                            <td></td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if(in_array(Auth::user()->role->slug, ['admin'])): ?>
                                        <tr>
                                            <td><i class="icon-users2 icon-2x display-inline-block text-warning"></i></td>
                                            <td>Sub Admin</td>
                                            <td><?php echo e($statehead); ?></td>
                                            <?php if(Myhelper::hasRole(['admin'])): ?>
                                            <td></td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if(in_array(Auth::user()->role->slug, ['admin', 'whitelable','statehead'])): ?>
                                        <tr>
                                            <td><i class="icon-users2 icon-2x display-inline-block text-slate"></i></td>
                                            <td>Master Distributor</td>
                                            <td><?php echo e($md); ?></td>

                                            <?php if(Myhelper::hasRole(['admin', 'whitelable'])): ?>
                                                <td><?php echo e(Auth::user()->mstock); ?></td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if(in_array(Auth::user()->role->slug, ['admin', 'whitelable', 'md','statehead'])): ?>
                                        <tr>
                                            <td><i class="icon-users2 icon-2x display-inline-block text-teal"></i></td>
                                            <td>Distributor</td>
                                            <td><?php echo e($distributor); ?></td>
                                            <?php if(Myhelper::hasRole(['admin', 'whitelable', 'md','statehead'])): ?>
                                                <td><?php echo e(Auth::user()->dstock); ?></td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if(in_array(Auth::user()->role->slug, ['admin', 'whitelable', 'md', 'distributor','statehead'])): ?>
                                        <tr>
                                            <td><i class="icon-users2 icon-2x display-inline-block text-primary"></i></td>
                                            <td>Agent</td>
                                            <td><?php echo e($retailer); ?></td>
                                            <?php if(Myhelper::hasRole(['admin', 'whitelable', 'md', 'distributor','statehead'])): ?>
                                                <td><?php echo e(Auth::user()->rstock); ?></td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endif; ?>
                                     <?php if(in_array(Auth::user()->role->slug, ['admin', 'whitelable', 'md', 'distributor','statehead'])): ?>
                                        <tr>
                                            <td><i class="icon-users2 icon-2x display-inline-block text-primary"></i></td>
                                            <td>Api User</td>
                                            <td><?php echo e($apiuser); ?></td>
                                            <?php if(Myhelper::hasRole(['admin', 'whitelable', 'md', 'distributor','statehead'])): ?>
                                                <td><?php echo e(Auth::user()->rstock); ?></td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if(in_array(Auth::user()->role->slug, ['admin'])): ?>
                                        <tr>
                                            <td><i class="icon-users2 icon-2x display-inline-block text-info"></i></td>
                                            <td>Other User</td>
                                            <td><?php echo e($other); ?></td>
                                            <?php if(Myhelper::hasRole(['admin'])): ?>
                                            <td></td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                     <div class="panel">
                    <div class="panel-heading bg-primary-800">
                        <h6 class="panel-title">Balances<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body p-0">
                        <table class="table table-bordered" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Wallet Type</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><i class="fa fa-inr icon-2x display-inline-block text-primary" style="font-size: 24px"></i></td>
                                    <td>Balance</td>
                                    <td class="mainwallet"></td>
                                </tr>

                                <!--<tr>-->
                                <!--    <td><i class="fa fa-inr icon-2x display-inline-block text-danger" style="font-size: 24px"></i></td>-->
                                <!--    <td>AePS Balance</td>-->
                                <!--    <td class="aepsbalance"></td>-->
                                <!--</tr>-->

                                <!--<tr>-->
                                <!--    <td><i class="fa fa-inr icon-2x display-inline-block text-danger" style="font-size: 24px"></i></td>-->
                                <!--    <td>MicroAtm Balance</td>-->
                                <!--    <td class="microatmbalance"></td>-->
                                <!--</tr>-->
                                
                                <?php if(in_array(Auth::user()->role->slug, ['admin'])): ?>
                                    <tr>
                                        <td><i class="fa fa-inr icon-2x display-inline-block text-teal" style="font-size: 24px"></i></td>
                                        <td>Downline Balance</td>
                                        <td class="downlinebalance"></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if(in_array(Auth::user()->role->slug, ['admin'])): ?>
                                    <tr>
                                        <td><i class="fa fa-inr icon-2x display-inline-block text-slate" style="font-size: 24px"></i></td>
                                        <td>Nikat Api Balance</td>
                                        <td class="apibalance"></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
                <?php endif; ?>

                
            </div>
        </div>
    </div>
<?php endif; ?>
    <?php if(Myhelper::hasNotRole('admin')): ?>
        <?php if(Auth::user()->kyc == "pending" || Auth::user()->kyc == "rejected"): ?>
            <div id="kycModal" class="modal fade" data-backdrop="false" data-keyboard="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-slate">
                            <h6 class="modal-title">Complete your profile with kyc</h6>
                        </div>
                        <?php if(Auth::user()->kyc == "rejected"): ?>
                            <div class="alert bg-danger alert-styled-left">
                                <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                                <span class="text-semibold">Kyc Rejected!</span> <?php echo e(Auth::user()->remark); ?></a>.
                            </div>
                            <?php endif; ?>
                        <form id="kycForm" action="<?php echo e(route('profileUpdate')); ?>" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?php echo e(Auth::id()); ?>">
                                <input type="hidden" name="type" value="kycdata">
                                <?php echo e(csrf_field()); ?>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Address</label>
                                        <textarea name="address" class="form-control" rows="2" required="" placeholder="Enter Value"><?php echo e(Auth::user()->address); ?></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>State</label>
                                        <select name="state" class="form-control select" required="">
                                            <option value="">Select State</option>
                                            <?php $__currentLoopData = $state; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($state->state); ?>" <?php echo e((Auth::user()->state == $state->state)? 'selected=""': ''); ?>><?php echo e($state->state); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>City</label>
                                        <input type="text" name="city" class="form-control" required="" placeholder="Enter Value" value="<?php echo e(Auth::user()->city); ?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Pincode</label>
                                        <input type="number" name="pincode" value="<?php echo e(Auth::user()->pincode); ?>" class="form-control" value="" required="" maxlength="6" minlength="6" placeholder="Enter Value">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Shop Name</label>
                                        <input type="text" name="shopname" value="<?php echo e(Auth::user()->shopname); ?>"  class="form-control" value="" required="" placeholder="Enter Value">
                                    </div>
        
                                    <div class="form-group col-md-4">
                                        <label>Pancard Number</label>
                                        <input type="text" name="pancard" value="<?php echo e(Auth::user()->pancard); ?>"  class="form-control" value="" required="" placeholder="Enter Value">
                                    </div>
        
                                    <div class="form-group col-md-4">
                                        <label>Adhaarcard Number</label>
                                        <input type="text" name="aadharcard" value="<?php echo e(Auth::user()->aadharcard); ?>"  class="form-control" value="" required="" placeholder="Enter Value" maxlength="12" minlength="12">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Pancard Pic</label>
                                        <input type="file" name="pancardpics" class="form-control" value="" placeholder="Enter Value" required="">
                                    </div>
        
                                    <div class="form-group col-md-6">
                                        <label>Adhaarcard Pic</label>
                                        <input type="file" name="aadharcardpics" class="form-control" value="" placeholder="Enter Value" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn bg-slate btn-raised legitRipple" type="submit" data-loading-text="<i class='fa fa-spin fa-spinner'></i> Submitting">Complete Profile</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        <?php endif; ?>

        <?php if(Auth::user()->resetpwd == "default"): ?>
            <div id="pwdModal" class="modal fade" data-backdrop="false" data-keyboard="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-slate">
                            <h6 class="modal-title">Change Password </h6>
                        </div>
                        <form id="passwordForm" action="<?php echo e(route('profileUpdate')); ?>" method="post">
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?php echo e(Auth::id()); ?>">
                                <input type="hidden" name="actiontype" value="password">
                                <?php echo e(csrf_field()); ?>

                                <?php if(Myhelper::can('password_reset')): ?>
                                    <div class="row">
                                        <div class="form-group col-md-6  ">
                                            <label>Old Password</label>
                                            <input type="password" name="oldpassword" class="form-control" required="" placeholder="Enter Value">
                                        </div>
                                        <div class="form-group col-md-6  ">
                                            <label>New Password</label>
                                            <input type="password" name="password" id="password" class="form-control" required="" placeholder="Enter Value">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6  ">
                                            <label>Confirmed Password</label>
                                            <input type="password" name="password_confirmation" class="form-control" required="" placeholder="Enter Value">
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="modal-footer">
                                <button class="btn bg-slate btn-raised legitRipple" type="submit" data-loading-text="<i class='fa fa-spin fa-spinner'></i> Submitting">Change Password</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        <?php endif; ?>
    <?php endif; ?>

    <div id="noticeModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-slate">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Necessary Notice ( आवश्यक सूचना )</h4>
                </div>
                <div class="modal-body">
                    <?php echo nl2br($mydata['notice']); ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script type="text/javascript" src="<?php echo e(asset('')); ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script>
    $(document).ready(function(){
        $('select').select2();

        <?php if(Myhelper::hasNotRole('admin')): ?>
            <?php if(Auth::user()->kyc == "pending" || Auth::user()->kyc == "rejected"): ?>
                $('#kycModal').modal();
            <?php endif; ?>
        <?php endif; ?>

        <?php if(Myhelper::hasNotRole('admin') && Auth::user()->resetpwd == "default"): ?>
            $('#pwdModal').modal();
        <?php endif; ?>

        <?php if($mydata['notice'] != null && $mydata['notice'] != ''): ?>
            $('#noticeModal').modal();
        <?php endif; ?>

        $( "#kycForm" ).validate({
            rules: {
                state: {
                    required: true,
                },
                city: {
                    required: true,
                },
                pincode: {
                    required: true,
                    minlength: 6,
                    number : true,
                    maxlength: 6
                },
                address: {
                    required: true,
                },
                aadharcard: {
                    required: true,
                    minlength: 12,
                    number : true,
                    maxlength: 12
                },
                pancard: {
                    required: true,
                },
                shopname: {
                    required: true,
                },
                pancardpics: {
                    required: true,
                },
                aadharcardpics: {
                    required: true,
                }
            },
            messages: {
                state: {
                    required: "Please select state",
                },
                city: {
                    required: "Please enter city",
                },
                pincode: {
                    required: "Please enter pincode",
                    number: "Mobile number should be numeric",
                    minlength: "Your mobile number must be 6 digit",
                    maxlength: "Your mobile number must be 6 digit"
                },
                address: {
                    required: "Please enter address",
                },
                aadharcard: {
                    required: "Please enter aadharcard",
                    number: "Mobile number should be numeric",
                    minlength: "Your mobile number must be 12 digit",
                    maxlength: "Your mobile number must be 12 digit"
                },
                pancard: {
                    required: "Please enter pancard",
                },
                shopname: {
                    required: "Please enter shop name",
                },
                pancardpics: {
                    required: "Please upload pancard pic",
                },
                aadharcardpics: {
                    required: "Please upload aadharcard pic",
                }
            },
            errorElement: "p",
            errorPlacement: function ( error, element ) {
                if ( element.prop("tagName").toLowerCase().toLowerCase() === "select" ) {
                    error.insertAfter( element.closest( ".form-group" ).find(".select2") );
                } else {
                    error.insertAfter( element );
                }
            },
            submitHandler: function () {
                var form = $( "#kycForm" );
                form.find('span.text-danger').remove();
                form.ajaxSubmit({
                    dataType:'json',
                    beforeSubmit:function(){
                        form.find('button:submit').button('loading');
                    },
                    complete: function () {
                        form.find('button:submit').button('reset');
                    },
                    success:function(data){
                        if(data.status == "success"){
                            form[0].reset();
                            $('select').val('');
                            $('select').trigger('change');
                            notify("Profile Successfully Updated, wait for kyc approval" , 'success');
                        }else{
                            notify(data.status , 'warning');
                        }
                    },
                    error: function(errors) {
                        showError(errors, form);
                    }
                });
            }
        });

        $( "#passwordForm" ).validate({
            rules: {
                <?php if(!Myhelper::can('member_password_reset')): ?>
                oldpassword: {
                    required: true,
                    minlength: 6,
                },
                password_confirmation: {
                    required: true,
                    minlength: 8,
                    equalTo : "#password"
                },
                <?php endif; ?>
                password: {
                    required: true,
                    minlength: 8
                }
            },
            messages: {
                <?php if(!Myhelper::can('member_password_reset')): ?>
                oldpassword: {
                    required: "Please enter old password",
                    minlength: "Your password lenght should be atleast 6 character",
                },
                password_confirmation: {
                    required: "Please enter confirmed password",
                    minlength: "Your password lenght should be atleast 8 character",
                    equalTo : "New password and confirmed password should be equal"
                },
                <?php endif; ?>
                password: {
                    required: "Please enter new password",
                    minlength: "Your password lenght should be atleast 8 character"
                }
            },
            errorElement: "p",
            errorPlacement: function ( error, element ) {
                if ( element.prop("tagName").toLowerCase().toLowerCase() === "select" ) {
                    error.insertAfter( element.closest( ".form-group" ).find(".select2") );
                } else {
                    error.insertAfter( element );
                }
            },
            submitHandler: function () {
                var form = $('form#passwordForm');
                form.find('span.text-danger').remove();
                form.ajaxSubmit({
                    dataType:'json',
                    beforeSubmit:function(){
                        form.find('button:submit').button('loading');
                    },
                    complete: function () {
                        form.find('button:submit').button('reset');
                    },
                    success:function(data){
                        if(data.status == "success"){
                            form[0].reset();
                            form.closest('.modal').modal('hide');
                            notify("Password Successfully Changed" , 'success');
                        }else{
                            notify(data.status , 'warning');
                        }
                    },
                    error: function(errors) {
                        showError(errors, form.find('.modal-body'));
                    }
                });
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/loginkishalaypay/public_html/resources/views/home.blade.php ENDPATH**/ ?>