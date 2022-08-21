
<?php $__env->startSection('title', "Company Profile"); ?>
<?php $__env->startSection('pagetitle', "Company Profile"); ?>
<?php $__env->startSection('bodyClass', "has-detached-left"); ?>

<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="sidebar-detached">
        <div class="sidebar sidebar-default sidebar-separate">
            <div class="sidebar-content">
                <div class="content-group">
                    <div class="panel-body bg-indigo-400 border-radius-top text-center" style="background-image: url(http://demo.interface.club/limitless/assets/images/bg.png); background-size: contain;">
                        <div class="content-group-sm">
                            <h6 class="text-semibold no-margin-bottom">
                                <?php echo e(ucfirst($company->companyname)); ?>

                            </h6>
                        </div>

                        <a href="#" class="display-inline-block content-group-sm">
                            <?php if(Auth::user()->company->logo): ?>
                                <a class="navbar-brand no-padding" href="<?php echo e(route('home')); ?>">
                                    <img src="<?php echo e(asset('')); ?>public/logos/<?php echo e(Auth::user()->company->logo); ?>" class=" img-responsive" alt="" style="width: 260px;height: 56px;">
                                </a>
                            <?php endif; ?>
                        </a>
                    </div>

                    <div class="panel no-border-top no-border-radius-top">
                        <ul class="navigation">
                            <li class="navigation-header">Navigation</li>
                            <li class="active"><a href="#profile" data-toggle="tab" class="legitRipple" aria-expanded="false"><i class="icon-chevron-right"></i> Company Details</a></li>
                            <li class=""><a href="#logo" data-toggle="tab" class="legitRipple" aria-expanded="false"><i class="icon-chevron-right"></i> Company Logo</a></li>
                            <li class=""><a href="#news" data-toggle="tab" class="legitRipple" aria-expanded="false"><i class="icon-chevron-right"></i> Company News</a></li>
                            <li class=""><a href="#notice" data-toggle="tab" class="legitRipple" aria-expanded="false"><i class="icon-chevron-right"></i> Company Notice</a></li>
                            <li class=""><a href="#support" data-toggle="tab" class="legitRipple" aria-expanded="false"><i class="icon-chevron-right"></i> Company Support Details</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-detached">
        <div class="content-detached">
            <div class="tab-content">

                <div class="tab-pane fade in active" id="profile">
                    <form id="profileForm" action="<?php echo e(route('resourceupdate')); ?>" method="post">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="id" value="<?php echo e($company->id); ?>">
                        <input type="hidden" name="actiontype" value="company">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Company Information</h3>
                            </div>
                            <div class="panel-body p-b-0">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Company Name</label>
                                        <input type="text" name="companyname" class="form-control" value="<?php echo e($company->companyname); ?>" required="" placeholder="Enter Value">
                                    </div>
                                    <div class="form-group  col-md-4">
                                        <label>Company Website</label>
                                        <input type="text" name="website" class="form-control" value="<?php echo e($company->website); ?>" required="" placeholder="Enter Value">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button class="btn bg-slate btn-raised legitRipple pull-right" type="submit" data-loading-text="<i class='fa fa-spin fa-spinner'></i> Updating...">Update Info</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="logo">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">Company Logo</h4>
                        </div>
                        <div class="panel-body p-5">
                            <form class="dropzone" id="logoupload" action="<?php echo e(route('resourceupdate')); ?>" method="post" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="actiontype" value="company">
                                <input type="hidden" name="id" value="<?php echo e($company->id); ?>">
                            </form>
                            <p>Note : Prefered image size is 260px * 56px</p>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="news">
                    <form id="newsForm" action="<?php echo e(route('resourceupdate')); ?>" method="post">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="id" value="<?php echo e($companydata->id ?? 'new'); ?>">
                        <input type="hidden" name="company_id" value="<?php echo e($company->id); ?>">
                        <input type="hidden" name="actiontype" value="companydata">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Company News</h3>
                            </div>
                            <div class="panel-body p-b-0">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>News</label>
                                        <textarea name="news" class="form-control" cols="30" rows="3" placeholder="Enter News"><?php echo e($companydata->news ?? ""); ?></textarea>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Bill Notice</label>
                                        <textarea name="billnotice" class="form-control" cols="30" rows="3" placeholder="Enter News"><?php echo e($companydata->billnotice ?? ""); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button class="btn bg-slate btn-raised legitRipple pull-right" type="submit" data-loading-text="<i class='fa fa-spin fa-spinner'></i> Updating...">Update Info</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="notice">
                    <form id="noticeForm" action="<?php echo e(route('resourceupdate')); ?>" method="post">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="id" value="<?php echo e($companydata->id ?? 'new'); ?>">
                        <input type="hidden" name="company_id" value="<?php echo e($company->id); ?>">
                        <input type="hidden" name="actiontype" value="companydata">
                        <input type="hidden" name="notice">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Company Notice</h3>
                            </div>
                            <div class="panel-body no-padding">
                                <div class="form-group summernote">
                                    <?php echo nl2br($companydata->notice ?? ''); ?>

                                </div>
                            </div>
                            <div class="panel-footer">
                                <button class="btn bg-slate btn-raised legitRipple pull-right" type="submit" data-loading-text="<i class='fa fa-spin fa-spinner'></i> Updating...">Update Info</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="support">
                    <form id="supportForm" action="<?php echo e(route('resourceupdate')); ?>" method="post">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="company_id" value="<?php echo e($company->id); ?>">
                        <input type="hidden" name="actiontype" value="companydata">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Company Support Information</h3>
                            </div>
                            <div class="panel-body p-b-0">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Contact Number</label>
                                        <textarea name="number" class="form-control" cols="30" rows="3" placeholder="Enter Value" required=""><?php echo e($companydata->number ?? ""); ?></textarea>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Contact Email</label>
                                        <textarea name="email" class="form-control" cols="30" rows="3" placeholder="Enter Value" required=""><?php echo e($companydata->email ?? ""); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button class="btn bg-slate btn-raised legitRipple pull-right" type="submit" data-loading-text="<i class='fa fa-spin fa-spinner'></i> Updating...">Update Info</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .dropzone {
            min-height: 127px;
        }
        .dropzone .dz-default.dz-message:before{
            font-size: 50px;
            top: 60px;
        }
        .dropzone .dz-default.dz-message span{
            font-size: 18px;
            margin-top: 100px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>

<script type="text/javascript" src="<?php echo e(asset('')); ?>assets/js/plugins/editors/summernote/summernote.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $( "#profileForm" ).validate({
            rules: {
                companyname: {
                    required: true,
                }
            },
            messages: {
                companyname: {
                    required: "Please enter name",
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
                var form = $('form#profileForm');
                form.find('span.text-danger').remove();
                $('form#profileForm').ajaxSubmit({
                    dataType:'json',
                    beforeSubmit:function(){
                        form.find('button:submit').button('loading');
                    },
                    complete: function () {
                        form.find('button:submit').button('reset');
                    },
                    success:function(data){
                        if(data.status == "success"){
                            notify("Company Profile Successfully Updated" , 'success');
                        }else{
                            notify(data.status , 'warning');
                        }
                    },
                    error: function(errors) {
                        showError(errors, form.find('.panel-body'));
                    }
                });
            }
        });

        $( "#newsForm" ).validate({
            rules: {
                company_id: {
                    required: true,
                }
            },
            messages: {
                company_id: {
                    required: "Please enter id",
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
                var form = $('form#newsForm');
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
                            notify("Company News Successfully Updated" , 'success');
                        }else{
                            notify(data.status , 'warning');
                        }
                    },
                    error: function(errors) {
                        showError(errors, form.find('.panel-body'));
                    }
                });
            }
        });

        $( "#supportForm" ).validate({
            rules: {
                number: {
                    required: true,
                },
                email: {
                    required: true,
                }
            },
            messages: {
                number: {
                    required: "Number value is required",
                },
                email: {
                    required: "Email value is required",
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
                var form = $('form#supportForm');
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
                            notify("Company Support Details Successfully Updated" , 'success');
                        }else{
                            notify(data.status , 'warning');
                        }
                    },
                    error: function(errors) {
                        showError(errors, form.find('.panel-body'));
                    }
                });
            }
        });

        $( "#noticeForm" ).validate({
            rules: {
                news: {
                    required: true,
                }
            },
            messages: {
                news: {
                    required: "Please enter name",
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
                var form = $('form#noticeForm');
                $('input[name="notice"]').val($('.note-editable').html());
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
                            notify("Company Notice Successfully Updated" , 'success');
                        }else{
                            notify(data.status , 'warning');
                        }
                    },
                    error: function(errors) {
                        showError(errors, form.find('.panel-body'));
                    }
                });
            }
        });

        $('.summernote').summernote({
            height: 350,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false                 // set focus to editable area after initializing summernote
        });

        Dropzone.options.logoupload = {
            paramName: "logos", // The name that will be used to transfer the file
            maxFilesize: .5, // MB
            complete: function(file) {
                this.removeFile(file);
            },
            success : function(file, data){
                console.log(file);
                if(data.status == "success"){
                    notify("Company Logo Successfully Uploaded", 'success');
                }else{
                    notify("Something went wrong, please try again.", 'warning');
                }
            }
        };
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/loginxpresspaysc/public_html/resources/views/resource/companyprofile.blade.php ENDPATH**/ ?>