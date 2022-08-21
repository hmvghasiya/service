<?php
    $name = explode(" ", Auth::user()->name);
?>


<?php $__env->startSection('title', "Aeps Service"); ?>
<?php $__env->startSection('pagetitle', "Aeps Service"); ?>
<?php
    $table = "yes";
?>

<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            
            <?php if(!$agent): ?>
                <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Aeps Service Registration</h4>
                </div>
                <div class="panel-body">
                    <form action="<?php echo e(route('aepstransaction')); ?>" method="post" id="transactionForm" enctype="multipart/form-data"> 
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="transactionType" value="kyc">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Firstname </label>
                                <input type="text" class="form-control" autocomplete="off" name="bc_f_name" placeholder="Enter Your Firstame" value="<?php echo e(isset($name[0]) ? $name[0] : ''); ?>" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Lastname </label>
                                <input type="text" class="form-control" name="bc_l_name" autocomplete="off" placeholder="Enter Your Lastname" value="<?php echo e(isset($name[1]) ? $name[1] : ''); ?>" required>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label>Email </label>
                                <input type="email" class="form-control" autocomplete="off" name="emailid" placeholder="Enter Your Email" value="<?php echo e(Auth::user()->email); ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Mobile</label>
                                <input type="text" pattern="[0-9]*" maxlength="10" minlength="10" class="form-control" name="phone1" autocomplete="off" placeholder="Enter Your Mobile" value="<?php echo e(Auth::user()->mobile); ?>" required>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label>DOB </label>
                                <input type="text" class="form-control mydatepic" autocomplete="off" name="bc_dob" placeholder="Enter Your DOB (DD-MM-YYYY)" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label>State</label>
                                <select name="bc_state" class="form-control select" required>
                                    <option value="">Select State</option>
                                    <?php $__currentLoopData = $mahastate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($state->statename); ?>"><?php echo e($state->statename); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>City</label>
                                <input type="text" class="form-control" autocomplete="off" name="bc_city"  value="<?php echo e(Auth::user()->city); ?>" placeholder="Enter Your City" required>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label>Pincode </label>
                                <input type="text" class="form-control" autocomplete="off" name="bc_pincode" placeholder="Enter Your Pincode" pattern="[0-9]*" value="<?php echo e(Auth::user()->pincode); ?>" maxlength="6" minlength="6" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Shopname</label>
                                <input type="text" class="form-control" autocomplete="off" name="shopname" value="<?php echo e(Auth::user()->shopname); ?>" placeholder="Enter Your Shopname" required>
                            </div>
                        </div>
                        
                        <div class="row">
                               <div class="form-group col-md-4">
                                    <label>Pancard Image </label>
                                    <input type="file" class="form-control" autocomplete="off" accept="image/x-png,image/gif,image/jpeg" name="pancardimg" placeholder="" required>
                                </div>
                                 <div class="form-group col-md-4">
                                    <label>Aadhaarcard Front Image </label>
                                    <input type="file" class="form-control" accept="image/x-png,image/gif,image/jpeg" autocomplete="off" name="aadhafront" placeholder="" required>
                                </div>
                                 <div class="form-group col-md-4">
                                    <label>Aadhaarcard Back Image </label>
                                    <input type="file" class="form-control" accept="image/x-png,image/gif,image/jpeg" autocomplete="off" name="aadharback" placeholder="" required>
                                </div>
                            </div>
                        
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Pancard</label>
                                <input type="text" class="form-control" name="bc_pan" autocomplete="off" placeholder="Enter Your Pancard" value="<?php echo e(Auth::user()->pancard); ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group text-center">
                            <button type="submit" class="btn bg-teal-400 btn-labeled btn-rounded legitRipple btn-lg" data-loading-text="<b><i class='fa fa-spin fa-spinner'></i></b> Submitting"><b><i class=" icon-paperplane"></i></b> Submit</button>
                        </div>
                    </form>
                </div> 
            </div>
            <?php elseif($agent->bbps_id == 'notactivated'): ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Service Activate</h4>
                    </div>
                    <div class="panel-body">
                        <form action="<?php echo e(route('aepstransaction')); ?>" method="post" id="transactionForm" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="transactionType" value="service">
                            
                             <div class="row">
                               <div class="form-group col-md-4">
                                    <label>Pancard Image </label>
                                    <input type="file" class="form-control" autocomplete="off" accept="image/x-png,image/gif,image/jpeg" name="pancardimg" placeholder="" required>
                                </div>
                                 <div class="form-group col-md-4">
                                    <label>Aadhaarcard Front Image </label>
                                    <input type="file" class="form-control" accept="image/x-png,image/gif,image/jpeg" autocomplete="off" name="aadhafront" placeholder="" required>
                                </div>
                                 <div class="form-group col-md-4">
                                    <label>Aadhaarcard Back Image </label>
                                    <input type="file" class="form-control" accept="image/x-png,image/gif,image/jpeg" autocomplete="off" name="aadharback" placeholder="" required>
                                </div>
                            </div>
                                <div class="form-group text-center">
                                <button type="submit" class="btn bg-teal-400 btn-labeled btn-rounded legitRipple btn-lg" data-loading-text="<b><i class='fa fa-spin fa-spinner'></i></b> Submitting"><b><i class=" icon-paperplane"></i></b> Activate</button>
                                </div>
                        </form>
                        
                    </div>
                </div>
            <?php else: ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Aeps</h4>
                    </div>
                    <div class="panel-body p-0">
                        <table class="table table-bordered">
                            <tr><td>User ID</td><td><?php echo e($agent->bc_id); ?></td></tr>
                            <tr><td>Phone Number</td><td><?php echo e($agent->phone1); ?></td></tr>
                        </tbody></table>
                    </div>
                    <form action="<?php echo e(route('aepstransaction')); ?>" method="get" target="_blank">
                        <input type="hidden" name="transactionType" value="initiate">
                        <div class="panel-footer text-center">
                            <?php if($agent->status == "pending"): ?>
                            <div class="panel-footer text-center text-danger">
                            Status Pending
                        </div>
                            <?php endif; ?>
                            <button type="submit" class="btn bg-teal-400 btn-labeled btn-rounded legitRipple btn-lg" data-loading-text="<b><i class='fa fa-spin fa-spinner'></i></b> Paying"><b><i class=" icon-paperplane"></i></b> Initiate Transaction</button>
                        </div>
                    </form>
                    <?php if(isset($error)): ?>
                        <div class="panel-footer text-center text-danger">
                            Error - <?php echo e($error); ?>

                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script type="text/javascript">
    $(document).ready(function () {

        $('.mydatepic').datepicker({
            'autoclose':true,
            'clearBtn':true,
            'todayHighlight':true,
            'format':'dd-mm-yyyy',
        });

        $('form#transactionForm').submit(function() {
            var form= $(this);
            var type = form.find('[name="type"]');
            $(this).ajaxSubmit({
                dataType:'json',
                beforeSubmit:function(){
                    swal({
                        title: 'Wait!',
                        text: 'We are working on request.',
                        onOpen: () => {
                            swal.showLoading()
                        },
                        allowOutsideClick: () => !swal.isLoading()
                    });
                },
                success:function(data){
                    swal.close();
                    console.log(type);
                    switch(data.statuscode){
                        case 'TXN':
                            swal({
                                title:'Suceess', 
                                text : data.message, 
                                type : 'success',
                                onClose: () => {
                                    window.location.reload();
                                }
                            });
                            break;
                        
                        default:
                            notify(data.message, 'danger');
                            break;
                    }
                },
                error: function(errors) {
                    swal.close();
                    if(errors.status == '400'){
                        notify(errors.responseJSON.message, 'danger');
                    }else{
                        swal(
                          'Oops!',
                          'Something went wrong, try again later.',
                          'error'
                        );
                    }
                }
            });
            return false;
        });
    });

    function getDistrict(ele){
        $.ajax({
            url:  "<?php echo e(route('dmt1pay')); ?>",
            type: "POST",
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend:function(){
                swal({
                    title: 'Wait!',
                    text: 'We are fetching district.',
                    allowOutsideClick: () => !swal.isLoading(),
                    onOpen: () => {
                        swal.showLoading()
                    }
                });
            },
            data: {'type':"getdistrict", 'stateid':$(ele).val()},
            success: function(data){
                swal.close();
                var out = `<option value="">Select District</option>`;
                $.each(data.message, function(index, value){
                    out += `<option value="`+value.districtid+`">`+value.districtname+`</option>`;
                });

                $('[name="bc_district"]').html(out);
            }
        });
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/finoviti/public_html/Reseller/login.salairecharge.online/resources/views/service/aeps.blade.php ENDPATH**/ ?>