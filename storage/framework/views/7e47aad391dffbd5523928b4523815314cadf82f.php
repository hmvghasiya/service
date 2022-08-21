
<?php $__env->startSection('title', "Certificate"); ?>
<?php $__env->startSection('pagetitle',  "Certificate"); ?>

<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Complaints</h4>
                    <div class="heading-elements">
                        <button class="btn bg-slate btn-raised legitRipple" type="button" id="print"><i class="fa fa-print"></i></button>
                    </div>
                </div>

                <div class="panel-body" id="printable">
                    <table style="background-image:url('<?php echo e(asset('assets/')); ?>/bcg.jpg');width:600px!important;height:424px;text-align: center;position: relative;">
                    <tr style="width: 100%">
                        <td colspan="2" style="position: relative;top:180px;width: 100%"><?php echo e(Auth::user()->shopname); ?></td>
                    </tr>
                    <tr><td colspan="2" style="padding:0px 50px;position: relative;top: 80px;">This is to certify that the above mentioned company/person is our authorized 
                    Business Correspondent Agent</td></tr>
                    <tr style="width: 100%">
                        <td style="position: relative;top:5px;width:45%;text-align:center;padding-left:100px"><?php echo e(\Carbon\Carbon::createFromFormat('d M y - h:i A', Auth::user()->created_at)->format('d M Y')); ?></td>
                        <td style="position: relative;top:5px;width: 55%;text-align: left;"><?php echo e(Auth::user()->company->companyname); ?></td>
                    </tr>
                    </table>
                </div>      
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#print').click(function(){
            openWin();
        });
    });

</script>
<script type="text/javascript">
  function openWin()
  {
    var body = $('#printable').html();
    var myWindow = window.open('','', 'width=800,height=600');

    myWindow.document.write(body);

    myWindow.document.close();
    myWindow.focus();
    myWindow.print();
    myWindow.close();

 }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/finoviti/public_html/Reseller/nikatby.co.in/Reseller/login.kishalaypay.com/resources/views/certificate.blade.php ENDPATH**/ ?>