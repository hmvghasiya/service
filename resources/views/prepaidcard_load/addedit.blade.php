@extends('layouts.app')
@section('title', 'Prepaid Card Load Registration')
@section('pagetitle', 'Prepaid Card Load Registration')
@section('content')
<div class="content">
    <form class="FromSubmit" action="{{ route('prepaidcard_load.store') }}" id="rationform" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Personal Information</h3>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Bank Name</label>
                                <input type="text" name="bank_name" class="form-control" value=""  placeholder="Enter Value">
                            </div>
                            <div class="form-group col-md-4">
                                <label> Name</label>
                                <input type="text" name="name" class="form-control" value=""  placeholder="Enter Value">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Amount</label>
                                <input type="text" name="atm"  class="form-control" placeholder="Enter Value">
                            </div>
                           
                            <div class="form-group col-md-4">
                                <label> Card Number</label>
                                <input type="text" name="card_number" class="form-control" value=""  placeholder="Enter Value">
                            </div>

                             <div class="form-group col-md-4">
                                <label>Mobile No</label>
                                <input type="text" name="mobile_no" class="form-control" value="" placeholder="Enter Value">
                            </div>
                          
                        </div>
                        
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Loan Information</h3>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="row">
                             <div class="form-group col-md-12">
                                <label>Loan Type</label>
                                <select name="loan_type" class="form-control select loan_type" >
                                    <option value="">Select Loan</option>
                                    @foreach (getLoanTypeDropdown() as $key=>$value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="res_all" style="display: none;">
                                <div class="form-group col-md-12">
                                    <label>Profile Photo</label>
                                    <input type="file" name="photo" class="form-control" value="" placeholder="Enter Value">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Pancard Photo</label>
                                    <input type="file" name="pancard_photo" class="form-control" value="" placeholder="Enter Value">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Bank Statement Photo</label>
                                    <input type="file" name="bank_statement_photo" class="form-control" value="" placeholder="Enter Value">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Adhar Card Photo</label>
                                    <input type="file" name="addhar_card_photo" class="form-control" value="" placeholder="Enter Value">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Address Proof Photo</label>
                                    <input type="file" name="address_proof" class="form-control" value="" placeholder="Enter Value">
                                </div>
                            </div>
                            <div class="loan_res">
                                
                            </div>


                        </div>
                    </div>
                </div>
            </div> --}}

           

            <div class="col-md-4 col-md-offset-4">
                <button class="btn bg-slate btn-raised legitRipple btn-lg btn-block" type="submit" data-loading-text="Please Wait...">Submit</button>
            </div>
        </div>
    </form>
</div>


<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Prepaid Card Load Registration List</h4>

                    {{-- @if ($role || sizeOf($roles) > 0) --}}
                        <div class="heading-elements">
                            <a href="{{route('prepaidcard_load.create')}}"><button type="button" class="btn btn-sm bg-slate btn-raised heading-btn legitRipple">
                                <i class="icon-plus2"></i> Request New
                            </button></a>
                        </div>
                    {{-- @endif --}}
                </div>
                <table class="table table-bordered table-striped table-hover" id="datatable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Bank Name</th>
                            <th>Card Number</th>
                            <th>ATM</th>
                            <th>Mobile Number</th>                            
                            <th>Status</th>                            
                            {{-- <th>Action</th> --}}
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

    $(document).ready(function() {
        // $(document).on('change', '.loan_type', function(event) {

        //     event.preventDefault();
        //     var loan_id=$(this).val();
        //     // alert(loan_id);
        //     $.ajax({
        //         url: '{{route('prepaidcard_load.loan_data')}}',
        //         type: 'GET',
        //         data: {loan_id: loan_id},
        //         success:function(response) {
        //             $('.res_all').removeAttr('style');
        //             $('.loan_res').html(response);
        //         }
        //     });
            
        // });
    });
</script>

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
            url:'{!! route('prepaidcard_load.user_any_data') !!}',
            data: function (d) {
                d.name = $('input[name=name]').val();
                d.status = $('select[name=status]').val();
              }
          },
      columns: [
           { data: 'name'},
          { data: 'bank_name'},
          { data: 'card_number'},
          { data: 'atm'},
          { data: 'mobile_no'},
          { data: 'status'},
          // { data: 'action',name:'action', orderable: false, searchable: false}
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
                url:"{{route('prepaidcard_load.single_status_change')}}",
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
    });

     

</script>
@endsection
