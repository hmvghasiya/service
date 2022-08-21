
<?php $__env->startSection('title', "Coming Soon"); ?>
<?php $__env->startSection('pagetitle',  "Coming Soon"); ?>

<?php $__env->startSection('content'); ?>
<style>

.container .btn {
  position: absolute;
  top: 75%;
  left: 35%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  background-color: blue;
  color: white;
  font-size: 16px;
  padding: 12px 24px;
  border: none;
  cursor: pointer;
  border-radius: 30px;
  text-align: center;
}

.container .btn:hover {
  background-color: black;
}
</style>
    <div class="container" style="max-width: fit-content !important;">
        <img src="<?php echo e(asset('assets/images/commingsoon.png')); ?>" class="img-responsive" style="width: 100%;border-radius: 30px; ">
        <!--<a href="<?php echo e(route('home')); ?>"><button type="button" class="btn"><strong>GO To Dashboard</strong></button></a>-->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xpresspay/public_html/resources/views/travel/hotel.blade.php ENDPATH**/ ?>