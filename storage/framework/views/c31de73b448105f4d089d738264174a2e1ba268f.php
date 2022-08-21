<!-- Main sidebar -->
<div class="sidebar sidebar-main sidebar-default sidebar-fixed">
    <div class="sidebar-content">
        <div class="sidebar-user-material">
            <div class="category-content">
                <div class="sidebar-user-material-content">
                    <span style="font-weight: 500; margin-top: 10px">Welcome</span>
                    <h5 class="no-margin-bottom" style="font-weight: 500; color: white; margin-top: 0px">
                        <?php echo e(explode(' ',ucwords(Auth::user()->name))[0]); ?> (Id - <?php echo e(Auth::id()); ?>)
                    </h5>
                    <span style="font-weight: 500">Member Type - <?php echo e(Auth::user()->role->name); ?></span>
                </div>
                                            
                <div class="sidebar-user-material-menu">
                    <a href="#user-nav" data-toggle="collapse"><span>My Account</span> <i class="caret"></i></a>
                </div>
            </div>
            
            <div class="navigation-wrapper collapse" id="user-nav">
                <ul class="navigation">
                    <li><a href="<?php echo e(route('profile')); ?>"><i class="icon-user-plus"></i> <span>My profile</span></a></li>
                    <?php if(Myhelper::hasNotRole('admin') && Myhelper::can('view_commission')): ?>
                        <li><a href="<?php echo e(route('resource', ['type' => 'commission'])); ?>"><i class="icon-coins"></i> <span>My Commission</span></a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo e(route('logout')); ?>"><i class="icon-switch2"></i> <span>Logout</span></a></li>
                </ul>
            </div>
        </div>

        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">
                    <li class="navigation-header" style="border: none;"><span>Navigation</span> <i class="icon-menu" title="" data-original-title="Main pages"></i></li>
                    <li><a href="<?php echo e(route('home')); ?>"><i class="icon-home4"></i> <span>Dashboard</span></a></li>

                    <?php if(Myhelper::hasNotRole('admin')): ?>
                        <?php if(Myhelper::can(['recharge_service', 'billpayment_service'])): ?>
                        <li>
                            <a href="javascript:void(0)"><i class="fa fa-bolt" style="padding:0px 4px"></i> <span>Recharge</span></a>
                            <ul>
                                <?php if(Myhelper::can('recharge_service')): ?>
                                    <li><a href="<?php echo e(route('recharge' , ['type' => 'mobile'])); ?>">Mobile</a></li>
                                    <li><a href="<?php echo e(route('recharge' , ['type' => 'dth'])); ?>">Dth</a></li>
                                    <li><a href="<?php echo e(route('bbps' , ['type' => 'fasttag'])); ?>">FASTag</a></li>
                                    <li><a href="<?php echo e(route('bbps' , ['type' => 'cable'])); ?>">Cable TV</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="fa fa-bolt" style="padding:0px 4px"></i> <span>Billpayment</span></a>
                            <ul>
                                <?php if(Myhelper::can('billpayment_service')): ?>
                                    <li><a href="<?php echo e(route('bill' , ['type' => 'electricity'])); ?>">Electricity</a></li>
                                    <li><a href="<?php echo e(route('bill' , ['type' => 'postpaid'])); ?>">Postpaid</a></li>
                                    <li><a href="<?php echo e(route('bill' , ['type' => 'water'])); ?>">Water</a></li>
                                    <li><a href="<?php echo e(route('bill' , ['type' => 'broadband'])); ?>">Broadband</a></li>
                                    <li><a href="<?php echo e(route('bill' , ['type' => 'lpggas'])); ?>">Lpg Gas </a></li>
                                    <li><a href="<?php echo e(route('bill' , ['type' => 'gasutility'])); ?>">Piped Gas</a></li>
                                    <li><a href="<?php echo e(route('bill' , ['type' => 'landline'])); ?>">Landline</a></li>
                                    <li><a href="<?php echo e(route('bill' , ['type' => 'postpaid'])); ?>">Postpaid</a></li>
                                    <li><a href="<?php echo e(route('bill' , ['type' => 'schoolfees'])); ?>">Education Fees</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="fa fa-bolt" style="padding:0px 4px"></i> <span>Financial Services & Taxes</span></a>
                            <ul>
                                <?php if(Myhelper::can('billpayment_service')): ?>
                                    <li><a href="<?php echo e(route('bill' , ['type' => 'loanrepay'])); ?>">Loan Repayment</a></li>
                                    <li><a href="<?php echo e(route('bill' , ['type' => 'insurance'])); ?>">LIC/Insurance</a></li>
                                    <li><a href="<?php echo e(route('bill' , ['type' => 'muncipal'])); ?>">Municipal Tax</a></li>
                                    <li><a href="<?php echo e(route('bill' , ['type' => 'housing'])); ?>">Housing Tax</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php endif; ?>

                        <?php if(Myhelper::can(['utipancard_service'])): ?>
                        <li>
                            <a href="javascript:void(0)"><i class="fa fa-credit-card"></i> <span>Pancard</span></a>
                            <ul>
                                <?php if(Myhelper::can('utipancard_service')): ?>
                                    <li><a href="<?php echo e(route('pancard' , ['type' => 'uti'])); ?>">Uti</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php endif; ?>

                        <?php if(Myhelper::can(['dmt1_service', 'aeps_service'])): ?>
                            <li>
                                <a href="javascript:void(0)"><i class="fa fa-inr" style="padding:0px 4px"></i> <span>Banking Service</span></a>
                                <ul>
                                    <?php if(Myhelper::can('aeps_service')): ?>
                                        <li><a href="<?php echo e(route('aeps')); ?>">Aeps</a></li>
                                    <?php endif; ?>

                                    <?php if(Myhelper::can('dmt1_service')): ?>
                                        <li><a href="<?php echo e(route('dmt1')); ?>">Money Transfer</a></li>
                                    <?php endif; ?>
                                    <?php if(Myhelper::can('dmt2_service')): ?>
                                        <li><a href="<?php echo e(route('dmt2')); ?>">Xpress-Money Transfer</a></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <li>
                            <a href="javascript:void(0)"><i class="fa fa-credit-card"></i> <span>Travel Service</span></a>
                            <ul>
                                    <li><a href="<?php echo e(route('travel' , ['type' => 'flight'])); ?>">Flight Booking</a></li>
                                    <li><a href="<?php echo e(route('travel' , ['type' => 'bus'])); ?>">Bus Booking</a></li>
                                    <li><a href="<?php echo e(route('travel' , ['type' => 'hotel'])); ?>">Hotel Booking</a></li>
                                    <li><a href="https://www.agent.irctc.co.in/" target="_blank">IRCTC Booking</a></li>
                            </ul>
                        </li>
                            <li><a href="<?php echo e(route('insurance')); ?>"><i class="fa fa-credit-card"></i>General Insurance</a></li>
                            <li><a href="<?php echo e(route('prepaidcard')); ?>"><i class="fa fa-credit-card"></i>Prepaid Card</a></li>

                        <?php if(Myhelper::hasRole('retailer')): ?>
                        <li><a href="<?php echo e(route('ration_card.user_index')); ?>"><i class="icon-cog"></i> Ration Card</a></li>
                        <li><a href="<?php echo e(route('e_sharm.user_index')); ?>"><i class="icon-cog"></i>Esharm</a></li>
                                <li><a href="<?php echo e(route('prepaidcard_load.user_index')); ?>"> <i class="icon-cog"></i> Prepaidcard Loads</a></li>
                                <li><a href="<?php echo e(route('loan.user_index')); ?>"><i class="icon-cog"></i> Loan</a></li>
                                <li><a href="<?php echo e(route('digital_signature.user_index')); ?>"><i class="icon-cog"></i>Digital Signature</a></li>
                                <li><a href="<?php echo e(route('gst_reg.user_index')); ?>"><i class="icon-cog"></i>Gst Registration</a></li>
                                <li><a href="<?php echo e(route('itr_reg.user_index')); ?>"><i class="icon-cog"></i>Itr Registration</a></li>
                                <li><a href="<?php echo e(route('prepaidcard_kyc.user_index')); ?>"><i class="icon-cog"></i>Prepaidcard Kyc</a></li>
                                <li><a href="<?php echo e(route('nsdl_pancard.user_index')); ?>"><i class="icon-cog"></i> Nsdl PanCard</a></li>
                        <?php endif; ?>
                            <li><a href="<?php echo e(route('cms')); ?>"><i class="fa fa-credit-card"></i> CMS</a></li>
                            <li><a href="<?php echo e(route('qrcode')); ?>"><i class="fa fa-credit-card"></i> QR Code</a></li>
                            <li><a href="<?php echo e(route('virtualaccount')); ?>"><i class="fa fa-credit-card"></i> Virtual Account</a></li>
                    
                        <li>
                            <a href="javascript:void(0);"><i class="fa fa-cog" style="padding:0px 2px"></i> <span>Service Links</span></a>
                            <ul>
                                <?php if(sizeof($mydata['links']) > 0): ?>
                                    <?php $__currentLoopData = $mydata['links']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e($link->value); ?>" target="_blank"><?php echo e($link->name); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                    

                    <?php if(Myhelper::hasNotRole('retailer')): ?>
                    <li>
                        <a href="javascript:void(0)"><i class="icon-wrench"></i> <span>Resources</span></a>
                        <ul>
                            <?php if(Myhelper::hasNotRole('retailer')): ?>
                                <li><a href="<?php echo e(route('resource', ['type' => 'scheme'])); ?>">Scheme Manager</a></li>
                            <?php endif; ?>

                            <?php if(Myhelper::can('company_manager')): ?>
                                <li><a href="<?php echo e(route('resource', ['type' => 'company'])); ?>">Company Manager</a></li>
                            <?php endif; ?>

                            <?php if(Myhelper::can('change_company_profile')): ?>
                                <li><a href="<?php echo e(route('resource', ['type' => 'companyprofile'])); ?>">Company Profile</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>

                   
                    <?php endif; ?>

                    <?php if(Myhelper::can(['view_whitelable','view_statehead', 'view_md', 'view_distributor', 'view_retailer', 'view_apiuser', 'view_other', 'view_kycpending', 'view_kycsubmitted', 'view_kycrejected'])): ?>
                    <li>
                        <a href="javascript:void(0)"><i class="icon-user"></i> <span>Member</span></a>
                        <ul>
                            <?php if(Myhelper::can(['view_whitelable'])): ?>
                            <li><a href="<?php echo e(route('member', ['type' => 'whitelable'])); ?>">Admin</a></li>
                            <?php endif; ?>
                            <?php if(Myhelper::can(['view_statehead'])): ?>
                            <li><a href="<?php echo e(route('member', ['type' => 'statehead'])); ?>">Sub Admin</a></li>
                            <?php endif; ?>
                            <?php if(Myhelper::can(['view_md'])): ?>
                            <li><a href="<?php echo e(route('member', ['type' => 'md'])); ?>">Master Distributor</a></li>
                            <?php endif; ?>
                            <?php if(Myhelper::can(['view_distributor'])): ?>
                            <li><a href="<?php echo e(route('member', ['type' => 'distributor'])); ?>">Distributor</a></li>
                            <?php endif; ?>
                            <?php if(Myhelper::can(['view_retailer'])): ?>
                            <li><a href="<?php echo e(route('member', ['type' => 'retailer'])); ?>">Agent</a></li>
                            <?php endif; ?>
                            <?php if(Myhelper::can(['view_apiuser'])): ?>
                            <li><a href="<?php echo e(route('member', ['type' => 'web'])); ?>">Register User</a></li>
                            <?php endif; ?>
                            <?php if(Myhelper::can(['view_other'])): ?>
                            <li><a href="<?php echo e(route('member', ['type' => 'other'])); ?>">Other User</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if(Myhelper::can(['fund_transfer', 'fund_return', 'fund_request_view', 'fund_report', 'fund_request'])): ?>
                    <li>
                        <a href="javascript:void(0)"><i class="icon-wallet"></i> <span>Fund</span>
                        <span class="label bg-danger fundCount <?php echo e(Myhelper::hasRole('admin')?'' : 'hide'); ?>" >0</span></a>
                        <ul>
                            <?php if(Myhelper::can(['fund_transfer', 'fund_return'])): ?>
                            <li><a href="<?php echo e(route('fund', ['type' => 'tr'])); ?>">Transfer/Return</a></li>
                            <?php endif; ?>
                            <?php if(Myhelper::can(['setup_bank'])): ?>
                            <li><a href="<?php echo e(route('fund', ['type' => 'requestview'])); ?>">Request 
                                <span class="label bg-blue fundCount <?php echo e(Myhelper::hasRole('admin')?'' : 'hide'); ?>">0</span></a>
                            </li>
                            <?php endif; ?>
                            <?php if(Myhelper::hasNotRole('admin') && Myhelper::can('fund_request')): ?>
                            <li><a href="<?php echo e(route('fund', ['type' => 'request'])); ?>">Load Wallet</a></li>
                            <?php endif; ?>
                            <?php if(Myhelper::can(['fund_report'])): ?>
                            <li><a href="<?php echo e(route('fund', ['type' => 'requestviewall'])); ?>">Request Report</a></li>
                            <li><a href="<?php echo e(route('fund', ['type' => 'statement'])); ?>">All Fund Report</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if(Myhelper::can(['aeps_fund_request', 'aeps_fund_view', 'aeps_fund_report'])): ?>
                    <li>
                        <a href="javascript:void(0)"><i class="icon-wallet"></i> <span>Aeps Fund</span>
                        <span class="label bg-danger aepsfundCount <?php echo e(Myhelper::hasRole('admin')?'' : 'hide'); ?>">0</span></a>
                        <ul>
                            <?php if(Myhelper::can(['aeps_fund_request'])): ?>
                            <li><a href="<?php echo e(route('fund', ['type' => 'aeps'])); ?>">Request</a></li>
                            <?php endif; ?>

                            <?php if(Myhelper::can(['aeps_fund_view'])): ?>
                            <li><a href="<?php echo e(route('fund', ['type' => 'aepsrequest'])); ?>">Pending Manual Req.
                                <span class="label bg-blue aepsfundCount <?php echo e(Myhelper::hasRole('admin')?'' : 'hide'); ?>">0</span></a>
                            </li>
                            <li><a href="<?php echo e(route('fund', ['type' => 'aepsrequest'])); ?>">Pending Payout Req.
                                <span class="label bg-blue aepspayoutfundCount <?php echo e(Myhelper::hasRole('admin')?'' : 'hide'); ?>">0</span></a>
                            </li>
                            <?php endif; ?>

                            <?php if(Myhelper::can(['aeps_fund_report'])): ?>
                            <li><a href="<?php echo e(route('fund', ['type' => 'aepsrequestall'])); ?>">Request Report</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if(Myhelper::can(['utiid_statement', 'aepsid_statement'])): ?>
                    <li>
                        <a href="javascript:void(0)"><i class="icon-user"></i> <span>Agent List</span></a>
                        <ul>
                            <?php if(Myhelper::can('aepsid_statement')): ?>
                                <li><a href="<?php echo e(route('statement', ['type' => 'ekoaeps'])); ?>">Aeps </a></li>
                            <?php endif; ?>

                            <?php if(Myhelper::can('utiid_statement')): ?>
                                <li><a href="<?php echo e(route('statement', ['type' => 'utiid'])); ?>">Uti</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if(Myhelper::can(['account_statement', 'utiid_statement', 'utipancard_statement', 'recharge_statement', 'billpayment_statement'])): ?>
                    <li>
                        <a href="javascript:void(0)"><i class="icon-history"></i> <span>Transaction History</span></a>
                        <ul>
                            <?php if(Myhelper::can('aeps_statement')): ?>
                                <li><a href="<?php echo e(route('statement', ['type' => 'aeps'])); ?>">Aeps Statement</a></li>
                            <?php endif; ?>

                            <?php if(Myhelper::can('billpayment_statement')): ?>
                                <li><a href="<?php echo e(route('statement', ['type' => 'billpay'])); ?>">Billpay Statement</a></li>
                            <?php endif; ?>

                            <?php if(Myhelper::can('money_statement')): ?>
                                <li><a href="<?php echo e(route('statement', ['type' => 'money'])); ?>">Money Transfer Statement</a></li>
                            <?php endif; ?>
                            <?php if(Myhelper::can('payout_statement')): ?>
                                <li><a href="<?php echo e(route('statement', ['type' => 'payout'])); ?>">Payout Statement</a></li>
                            <?php endif; ?>
                            <?php if(Myhelper::can('xpressmoney_statement')): ?>
                                <li><a href="<?php echo e(route('statement', ['type' => 'xpressmoney'])); ?>">Xpress Money Transfer Statement</a></li>
                            <?php endif; ?>

                            <?php if(Myhelper::can('recharge_statement')): ?>
                                <li><a href="<?php echo e(route('statement', ['type' => 'recharge'])); ?>">Recharge Statement</a></li>
                            <?php endif; ?>

                            <?php if(Myhelper::can('utipancard_statement')): ?>
                                <li><a href="<?php echo e(route('statement', ['type' => 'utipancard'])); ?>">Uti Pancard Statement</a></li>
                            <?php endif; ?>
                            <?php if(Myhelper::hasNotRole('retailer')): ?>
                             <li><a href="<?php echo e(route('ration_card.index')); ?>">Ration Card</a></li>
                                <li><a href="<?php echo e(route('e_sharm.index')); ?>">Esharm</a></li>
                                <li><a href="<?php echo e(route('gst_reg.index')); ?>">Gst Registration</a></li>
                                <li><a href="<?php echo e(route('itr_reg.index')); ?>">Itr Registration</a></li>
                                <li><a href="<?php echo e(route('digital_signature.index')); ?>">Digital Signature</a></li>
                                <li><a href="<?php echo e(route('loan.index')); ?>">Loan</a></li>
                                <li><a href="<?php echo e(route('nsdl_pancard.index')); ?>">Nsdl PanCard Offline</a></li>
                                <li><a href="<?php echo e(route('prepaidcard_kyc.index')); ?>">Prepaidcard Kyc</a></li>
                                <li><a href="<?php echo e(route('prepaidcard_load.index')); ?>">Prepaidcard Loads</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                      <?php if(Myhelper::hasNotRole('retailer')): ?>
                       


                        <?php endif; ?>


                    <?php if(Myhelper::can(['account_statement', 'awallet_statement'])): ?>
                        <li>
                            <a href="javascript:void(0)"><i class="icon-menu6"></i> <span>Account Statement</span></a>
                            <ul>
                                <?php if(Myhelper::can('account_statement')): ?>
                                    <li><a href="<?php echo e(route('statement', ['type' => 'account'])); ?>">Main Wallet</a></li>
                                <?php endif; ?>
                                <!--<?php if(Myhelper::can('awallet_statement')): ?>-->
                                <!--<li><a href="<?php echo e(route('statement', ['type' => 'awallet'])); ?>">Aeps Wallet</a></li>-->
                                <!--<?php endif; ?>-->
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php endif; ?>

                    <?php if(Myhelper::can('complaint')): ?>
                        <li><a href="<?php echo e(route('complaint')); ?>"><i class="icon-cog"></i> <span>Complaints</span></a></li>
                    <?php endif; ?>

                    <?php if(Myhelper::can(['setup_bank', 'api_manager', 'setup_operator'])): ?>
                    <li>
                        <a href="javascript:void(0)"><i class="icon-cog3"></i> <span>Setup Tools</span></a>
                        <ul>
                            <?php if(Myhelper::can('api_manager')): ?>
                            <li><a href="<?php echo e(route('setup', ['type' => 'api'])); ?>">Api Manager</a></li>
                            <?php endif; ?>
                            <?php if(Myhelper::can('setup_bank')): ?>
                            <li><a href="<?php echo e(route('setup', ['type' => 'bank'])); ?>">Bank Account</a></li>
                            <?php endif; ?>
                            <?php if(Myhelper::can('complaint_subject')): ?>
                            <li><a href="<?php echo e(route('setup', ['type' => 'complaintsub'])); ?>">Complaint Subject</a></li>
                            <?php endif; ?>
                            <?php if(Myhelper::can('setup_operator')): ?>
                            <li><a href="<?php echo e(route('setup', ['type' => 'operator'])); ?>">Operator Manager</a></li>
                            <?php endif; ?>
                            <?php if(Myhelper::hasRole('admin')): ?>
                            <li><a href="<?php echo e(route('setup', ['type' => 'portalsetting'])); ?>">Portal Setting</a></li>
                            <li><a href="<?php echo e(route('setup', ['type' => 'links'])); ?>">Quick Links</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <li>
                        <a href="javascript:void(0)"><i class="icon-cog2"></i> <span>Account Settings</span></a>
                        <ul>
                            <li><a href="<?php echo e(route('profile')); ?>">Profile Setting</a></li>
                            <li><a href="<?php echo e(route('certificate')); ?>">Certificate</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="javascript:void(0)"><i class="icon-cog2"></i> <span>Driver Links</span></a>
                        <ul>
                            <li><a href="https://drive.google.com/open?id=1xUzyXny4W_W7S4R44GZ5JgNms4sIylPK" target="_blank">Mantra</a></li>
                            <li><a href="https://drive.google.com/open?id=13FbVSOuplWlJNhwKMjTmKHkyA5CZPkh0" target="_blank">Morpho</a></li>
                            <li><a href="https://drive.google.com/open?id=19FZWSM3-vMdyd-_CpggvpyBPLaTSZcZa" target="_blank">Startek</a></li>
                            <li><a href="https://drive.google.com/open?id=1-LJfFXIvgE3ZLIm5fmYGjz95IvUnQYk4" target="_blank">Tatvik TMF20</a></li>
                        </ul>
                    </li>

                    <?php if(Myhelper::hasRole('admin')): ?>
                    <li>
                        <a href="javascript:void(0)"><i class="icon-lock"></i> <span>Roles & Permissions</span></a>
                        <ul>
                            <li><a href="<?php echo e(route('tools' , ['type' => 'roles'])); ?>">Roles</a></li>
                            <li><a href="<?php echo e(route('tools' , ['type' => 'permissions'])); ?>">Permission</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <li>
                        <a class="navbar-text" href="<?php echo e(route('logout')); ?>"><i class="icon-switch2"></i> <span>Logout</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /main navigation -->
    </div>
</div>
<!-- /main sidebar -->

<div id="profilePic" class="modal fade" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-slate">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Profile Upload</h6>
            </div>
            <div class="modal-body">
                <form class="dropzone" id="profileupload" action="<?php echo e(route('profileUpdate')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="id" value="<?php echo e(Auth::id()); ?>">
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --><?php /**PATH E:\laragon\www\open_aisa\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>