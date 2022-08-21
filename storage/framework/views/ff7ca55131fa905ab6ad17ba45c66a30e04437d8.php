<?php $__env->startSection('title', 'Reporting Charges'); ?>
<?php $__env->startSection('pagetitle', 'Reporting Charges'); ?>
<?php $__env->startSection('content'); ?>
<div class="content">
    <form class="FromSubmit" action="<?php echo e(route('reporting_charge.store')); ?>" id="rationform" method="post" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Charges</h3>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Ration card Charge</label>
                                <input type="text" name="ration_card_charge" class="form-control" value="<?php echo e($res->ration_card_charge); ?>"  placeholder="Enter Value">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Esharm Charge</label>
                                <input type="text" name="esharm_charge" class="form-control" value="<?php echo e($res->esharm_charge); ?>"  placeholder="Enter Value">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Digital Signature Charge</label>
                                <input type="text" name="digital_signature_charge" class="form-control" value="<?php echo e($res->digital_signature_charge); ?>"  placeholder="Enter Value">
                            </div>                            
                            <div class="form-group col-md-4">
                                <label>Itr registration Charge</label>
                                <input type="text" name="itr_registration_charge" class="form-control" value="<?php echo e($res->itr_registration_charge); ?>"  placeholder="Enter Value">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Gst registration Charge</label>
                                <input type="text" name="gst_registration_charge" class="form-control" value="<?php echo e($res->gst_registration_charge); ?>"  placeholder="Enter Value">
                            </div> 
                            <div class="form-group col-md-4">
                                <label>Prepaid Kyc Charge</label>
                                <input type="text" name="prepaid_kyc_charge" class="form-control" value="<?php echo e($res->prepaid_kyc_charge); ?>"  placeholder="Enter Value">
                            </div>
                            <div class="form-group col-md-4">
                                <label>PrepaidCard Load Charge</label>
                                <input type="text" name="prepaidcard_load_charge" class="form-control" value="<?php echo e($res->prepaidcard_load_charge); ?>"  placeholder="Enter Value">
                            </div>
                            <div class="form-group col-md-4">
                                <label>NsdlPancard Charge</label>
                                <input type="text" name="nsdlpancard_charge" class="form-control" value="<?php echo e($res->nsdlpancard_charge); ?>"  placeholder="Enter Value">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Loan Charge</label>
                                <input type="text" name="loan_charge" class="form-control" value="<?php echo e($res->loan_charge); ?>"  placeholder="Enter Value">
                            </div>
                          
                           
                            
                        </div>
                        
                    </div>
                </div>
            </div>
           

            <div class="col-md-4 col-md-offset-4">
                <button class="btn bg-slate btn-raised legitRipple btn-lg btn-block" type="submit" data-loading-text="Please Wait...">Submit</button>
            </div>
        </div>
    </form>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <link href="<?php echo e(asset('')); ?>assets/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('')); ?>assets/css/sweetalert2.css">


<style>
    .md-checkbox {
        margin: 5px 0px;
    }
</style>
<?php $__env->stopPush(); ?>


<?php $__env->startSection('script'); ?>

<script type="text/javascript" src="<?php echo e(asset('')); ?>assets/js/plugins/forms/selects/select2.min.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/js/sweet-alert/sweetalert.min.js"></script>

    <script type="text/javascript" src="<?php echo e(asset('')); ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
 <script src="<?php echo e(asset('')); ?>assets/datatable/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/datatable/js/dataTables.bootstrap5.min.js"></script>


<script type="text/javascript">
    $(document).ready(function () {
        $( ".FromSubmit" ).validate({
            rules: {
                f_name: {
                    required: true,
                }
            },
            errorElement: "p",
            errorPlacement: function ( error, element ) {
                if ( element.prop("tagName").toLowerCase() === "select" ) {
                    error.insertAfter( element.closest( ".form-group" ).find(".select2") );
                } else {
                    error.insertAfter( element );
                }
            },
            submitHandler: function () {
                var form = $('form.FromSubmit');
                form.find('span.text-danger').remove();
                $('form.FromSubmit').ajaxSubmit({
                    dataType:'json',
                    beforeSubmit:function(){
                        form.find('button:submit').button('loading');
                    },
                    complete: function () {
                        form.find('button:submit').button('reset');
                    },
                    success:function(data){
                        if(data.status == true){
                            form[0].reset();
                            $('select').val('');
                            $('select').trigger('change');
                            notify(data.msg , 'success');
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
    });

   
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\open_aisa\resources\views/reporting/addedit.blade.php ENDPATH**/ ?>