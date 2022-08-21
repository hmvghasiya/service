<?php $__env->startSection('title','Nsdl Pancard Registration List'); ?>
<?php $__env->startSection('pagetitle',  'Nsdl Pancard Registration List'); ?>



<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Nsdl Pancard Registration List</h4>

                    
                        <div class="heading-elements">
                            <a href="<?php echo e(route('nsdl_pancard.create')); ?>"><button type="button" class="btn btn-sm bg-slate btn-raised heading-btn legitRipple">
                                <i class="icon-plus2"></i> Request New
                            </button></a>
                        </div>
                    
                </div>
                <table class="table table-bordered table-striped table-hover" id="datatable">
                    <thead>
                        <tr>
                            <th>Personal Detail</th>
                            <th>Application Detail</th>
                            <th>Status</th>                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




<div id="reasonModal" class="modal " role="dialog" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
                <div class="modal-header bg-slate">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Reson For Changing Status</h4>
            </div>
            <div class="modal-body no-padding modal_res">
               
            </div>
           
        </div>
    </div>
</div><!-- /.modal -->


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

    var oTable = $('#datatable').DataTable({
      processing: true,
      serverSide: true,
      searching:false,
      responsive: true,
      ajax: {
            url:'<?php echo route('nsdl_pancard.user_any_data'); ?>',
            data: function (d) {
                d.name = $('input[name=name]').val();
                d.status = $('select[name=status]').val();
              }
          },
      columns: [
          { data: 'f_name'},
          { data: 'applicagtion_detail'},
          { data: 'status'},
          { data: 'action',name:'action', orderable: false, searchable: false}
      ]
  });
        $('.select').select2();


        
  });

    $(document).on("click",".change_rat_status",function(){
        
      swal({
        title: "Are you Sure to change status",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
              var status = $(this).attr('data-status');
              var id = $(this).attr('data-id');
              var cur =$(this);
              var modal=$('#reasonModal');
              $.ajax({
                type:"POST",
                url:"<?php echo e(route('nsdl_pancard.single_status_change')); ?>",
                data:{"status":status,"id":id,"_token": "<?php echo e(csrf_token()); ?>"},
                success:function(data){
                    $('.modal_res').html(data);
                    modal.modal('show');
                     oTable.draw();    
                  }
              })
          swal("Status Has Been Change Successfully.", {
                      icon: "success",
          });
        } 
      });
    });

     

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\open_aisa\resources\views/nsdl_pancard/user_index.blade.php ENDPATH**/ ?>