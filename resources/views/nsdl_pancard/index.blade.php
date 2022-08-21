@extends('layouts.app')
@section('title','Nsdl Pancard Registration List')
@section('pagetitle',  'Nsdl Pancard Registration List')



@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Nsdl Pancard Registration List</h4>

                    {{-- @if ($role || sizeOf($roles) > 0) --}}
                       {{--  <div class="heading-elements">
                            <a href="{{route('nsdl_pancard.create')}}"><button type="button" class="btn btn-sm bg-slate btn-raised heading-btn legitRipple">
                                <i class="icon-plus2"></i> Add New
                            </button></a>
                        </div> --}}
                    {{-- @endif --}}
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
           {{--  <div class="modal-footer">
                <button type="button" class="btn btn-default btn-raised legitRipple" data-dismiss="modal" aria-hidden="true">Close</button>
            </div> --}}
        </div>
    </div>
</div><!-- /.modal -->


@endsection

@push('style')
    <link href="{{asset('')}}assets/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('')}}assets/css/sweetalert2.css">


<style>
    .md-checkbox {
        margin: 5px 0px;
    }
</style>
@endpush

@section('script')
<script type="text/javascript" src="{{asset('')}}assets/js/plugins/forms/selects/select2.min.js"></script>
    <script src="{{asset('')}}assets/js/sweet-alert/sweetalert.min.js"></script>

    <script type="text/javascript" src="{{asset('')}}assets/js/plugins/tables/datatables/datatables.min.js"></script>
 <script src="{{asset('')}}assets/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('')}}assets/datatable/js/dataTables.bootstrap5.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {

    var oTable = $('#datatable').DataTable({
      processing: true,
      serverSide: true,
      searching:false,
      responsive: true,
      ajax: {
            url:'{!! route('nsdl_pancard.any_data') !!}',
            data: function (d) {
                   d.start_date =  $('#searchForm').find('input[name="from_date"]').val();
                 d.end_date =  $('#searchForm').find('input[name="to_date"]').val();
                 d.searchtext =  $('#searchForm').find('input[name="searchtext"]').val();
              }
          },
      columns: [
          { data: 'f_name'},
          { data: 'application_detail'},
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
                url:"{{route('nsdl_pancard.single_status_change')}}",
                data:{"status":status,"id":id,"_token": "{{ csrf_token() }}"},
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
    //             url: '{{url('tools/get/permission')}}/'+id,
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
    //         url: '{{route("getScheme")}}',
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
    //             url: '{{route("getMemberCommission")}}',
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
@endsection