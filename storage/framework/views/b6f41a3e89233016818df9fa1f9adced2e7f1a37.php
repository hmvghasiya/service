<!DOCTYPE html>
<html lang="en">

<?php echo $__env->make("front::layouts.head", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<body>

   <?php echo $__env->make("front::layouts.header", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent("content"); ?>

    <?php echo $__env->make("front::layouts.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make("front::layouts.javascript", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html><?php /**PATH D:\laragon\www\open_aisa\Modules/Front\Resources/views/layouts/master.blade.php ENDPATH**/ ?>