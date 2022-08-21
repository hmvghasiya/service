<?php $__env->startSection('title','Digital Signature Registration List'); ?>
<?php $__env->startSection('pagetitle',  'Digital Signature Registration List'); ?>



<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Digital Signature Registration List</h4>

                    
                        
                    
                </div>
                <table class="table table-bordered table-striped table-hover" id="datatable">
                    <thead>
                        <tr>
                            <th>Personal Detail</th>
                            <th>Loan Detail</th>
                            <th>Address</th>                            
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
            url:'<?php echo route('digital_signature.any_data'); ?>',
            data: function (d) {
                   d.start_date =  $('#searchForm').find('input[name="from_date"]').val();
                 d.end_date =  $('#searchForm').find('input[name="to_date"]').val();
                 d.searchtext =  $('#searchForm').find('input[name="searchtext"]').val();
              }
          },
      columns: [
          { data: 'f_name'},
          { data: 'loan_detail'},
          { data: 'address'},
          { data: 'status'},
          { data: 'action',name:'action', orderable: false, searchable: false}
      ]
  });
        $('.select').select2();


        
  $(document).on("click",".search_text",function(){
      oTable.draw();
      return false;
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
                url:"<?php echo e(route('digital_signature.single_status_change')); ?>",
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
    })
    });

     

    // function transfer(id){
    //     $('#transferForm').find('[name="user_id"]').val(id);
    //     $('#transferModal').modal();
    // }

    // function getPermission(id) {
    //     if(id.length != ''){
    //         $.ajax({
    //             url: '<?php echo e(url('tools/get/permission')); ?>/'+id,
    //             type: 'post',
    //             dataType: 'json',
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //         })
    //         .done(function(data) {
    //             $('#permissionForm').find('[name="user_id"]').val(id);
    //             $('.case').each(function() {
    //                this.checked = false;
    //             });
    //             $.each(data, function(index, val) {
    //                 $('#permissionForm').find('input[value='+val.permission_id+']').prop('checked', true);
    //             });
    //             $('#permissionModal').modal();
    //         })
    //         .fail(function() {
    //             notify('Somthing went wrong', 'warning');
    //         });
    //     }
    // }

    // function kycManage(id, kyc, remark){
    //     $('#kycUpdateForm').find('[name="id"]').val(id);
    //     $('#kycUpdateForm').find('[name="kyc"]').select2().val(kyc).trigger('change');
    //     $('#kycUpdateForm').find('[name="remark"]').val(remark);
    //     $('#kycUpdateModal').modal();
    // }

    // function scheme(id, scheme){
    //     $.ajax({
    //         url: '<?php echo e(route("getScheme")); ?>',
    //         type: 'post',
    //         dataType: 'json',
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         data : {"id" : id, 'scheme_id': scheme},
    //         beforeSend : function(){
    //             swal({
    //                 title: 'Wait!',
    //                 text: 'Please wait, we are fetching commission details',
    //                 onOpen: () => {
    //                     swal.showLoading()
    //                 },
    //                 allowOutsideClick: () => !swal.isLoading()
    //             });
    //         }
    //     })
    //     .success(function(data) {
    //         swal.close();
    //         $('#schemeForm').find('[name="id"]').val(id);

    //         var output = "<option value='0'>Select Scheme</option>";
    //         $.each(data.data, function(index, val) {
    //             output += `<option value='`+val.id+`'>`+val.name+`</option>`;
    //         });
    //         $('#commissionModal').find('select[name="scheme_id"]').html(output);
    //         $('#commissionModal').find('select[name="scheme_id"]').select2().val(scheme).trigger('change');

    //         if(scheme != '' && scheme != null && scheme != 'null'){
    //             $('#schemeForm').find('[name="scheme_id"]').select2().val(scheme).trigger('change');
    //         }
    //         $('#commissionModal').modal();
    //     })
    // }

    // function addStock(id) {
    //     $('#idModal').find('input[name="id"]').val(id);
    //     $('#idModal').modal();
    // }

    // function viewCommission(element) {
    //     var scheme_id = $(element).val();
    //     if(scheme_id && scheme_id != 0){
    //         $.ajax({
    //             url: '<?php echo e(route("getMemberCommission")); ?>',
    //             type: 'post',
    //             dataType: 'json',
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //             data : {"scheme_id" : scheme_id},
    //             beforeSend : function(){
    //                 swal({
    //                     title: 'Wait!',
    //                     text: 'Please wait, we are fetching commission details',
    //                     onOpen: () => {
    //                         swal.showLoading()
    //                     },
    //                     allowOutsideClick: () => !swal.isLoading()
    //                 });
    //             }
    //         })
    //         .success(function(data) {
    //             swal.close();
    //             $('#commissionModal').find('.commissioData').html(data);
    //         })
    //         .fail(function() {
    //             swal.close();
    //             notify('Somthing went wrong', 'warning');
    //         });
    //     }
    // }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\open_aisa\resources\views/digital_signature/index.blade.php ENDPATH**/ ?>