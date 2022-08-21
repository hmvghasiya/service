@extends('layouts.app')
@section('title', 'Portal Settings')
@section('pagetitle',  'Portal Settings')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-4">
            <form class="actionForm" action="{{route('setupupdate')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="actiontype" value="portalsetting">
                <input type="hidden" name="code" value="settlementtype">
                <input type="hidden" name="name" value="Wallet Settlement Type">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">Wallet Settlement Type</h5>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="form-group">
                            <label>Settlement Type</label>
                            <select name="value" required="" class="form-control select">
                                <option value="">Select Type</option>
                                <option value="auto" {{(isset($settlementtype->value) && $settlementtype->value == "auto") ? "selected=''" : ''}}>Auto</option>
                                <option value="mannual" {{(isset($settlementtype->value) && $settlementtype->value == "mannual") ? "selected=''" : ''}}>Mannual</option>
                            </select>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn bg-slate btn-raised legitRipple pull-right" type="submit" data-loading-text="<i class='fa fa-spin fa-spinner'></i> Updating...">Update Info</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-4">
            <form class="actionForm" action="{{route('setupupdate')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="actiontype" value="portalsetting">
                <input type="hidden" name="code" value="banksettlementtype">
                <input type="hidden" name="name" value="Wallet Settlement Type">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">Bank Settlement Type</h5>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="form-group">
                            <label>Settlement Type</label>
                            <select name="value" required="" class="form-control select">
                                <option value="">Select Type</option>
                                <option value="auto" {{(isset($banksettlementtype->value) && $banksettlementtype->value == "auto") ? "selected=''" : ''}}>Auto</option>
                                <option value="mannual" {{(isset($banksettlementtype->value) && $banksettlementtype->value == "mannual") ? "selected=''" : ''}}>Mannual</option>
                            </select>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn bg-slate btn-raised legitRipple pull-right" type="submit" data-loading-text="<i class='fa fa-spin fa-spinner'></i> Updating...">Update Info</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-4">
            <form class="actionForm" action="{{route('setupupdate')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="actiontype" value="portalsetting">
                <input type="hidden" name="code" value="settlementcharge">
                <input type="hidden" name="name" value="Bank Settlement Charge">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">Bank Settlement Charge</h5>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="form-group">
                            <label>Charge</label>
                            <input type="number" name="value" value="{{$settlementcharge->value ?? ''}}" class="form-control" required="" placeholder="Enter value">
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn bg-slate btn-raised legitRipple pull-right" type="submit" data-loading-text="<i class='fa fa-spin fa-spinner'></i> Updating...">Update Info</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-4">
            <form class="actionForm" action="{{route('setupupdate')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="actiontype" value="portalsetting">
                <input type="hidden" name="code" value="settlementcharge1k">
                <input type="hidden" name="name" value="Bank Settlement Charge">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">Bank Settlement Charge (<= 1000)</h5>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="form-group">
                            <label>Charge</label>
                            <input type="number" name="value" value="{{$settlementcharge1k->value ?? ''}}" class="form-control" required="" placeholder="Enter value">
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn bg-slate btn-raised legitRipple pull-right" type="submit" data-loading-text="<i class='fa fa-spin fa-spinner'></i> Updating...">Update Info</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-4">
            <form class="actionForm" action="{{route('setupupdate')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="actiontype" value="portalsetting">
                <input type="hidden" name="code" value="settlementcharge25k">
                <input type="hidden" name="name" value="Bank Settlement Charge">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">Bank Settlement Charge ( 1001 To 25000)</h5>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="form-group">
                            <label>Charge</label>
                            <input type="number" name="value" value="{{$settlementcharge25k->value ?? ''}}" class="form-control" required="" placeholder="Enter value">
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn bg-slate btn-raised legitRipple pull-right" type="submit" data-loading-text="<i class='fa fa-spin fa-spinner'></i> Updating...">Update Info</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-4">
            <form class="actionForm" action="{{route('setupupdate')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="actiontype" value="portalsetting">
                <input type="hidden" name="code" value="settlementcharge2l">
                <input type="hidden" name="name" value="Bank Settlement Charge">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">Bank Settlement Charge (25001 To 2Lac)</h5>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="form-group">
                            <label>Charge</label>
                            <input type="number" name="value" value="{{$settlementcharge2l->value ?? ''}}" class="form-control" required="" placeholder="Enter value">
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn bg-slate btn-raised legitRipple pull-right" type="submit" data-loading-text="<i class='fa fa-spin fa-spinner'></i> Updating...">Update Info</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-4">
            <form class="actionForm" action="{{route('setupupdate')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="actiontype" value="portalsetting">
                <input type="hidden" name="code" value="otplogin">
                <input type="hidden" name="name" value="Login required otp">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">Login Otp Required</h5>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="form-group">
                            <label>Login Type</label>
                            <select name="value" required="" class="form-control select">
                                <option value="">Select Type</option>
                                <option value="yes" {{(isset($otplogin->value) && $otplogin->value == "yes") ? "selected=''" : ''}}>With Otp</option>
                                <option value="no" {{(isset($otplogin->value) && $otplogin->value == "no") ? "selected=''" : ''}}>Without Otp</option>
                            </select>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn bg-slate btn-raised legitRipple pull-right" type="submit" data-loading-text="<i class='fa fa-spin fa-spinner'></i> Updating...">Update Info</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-4">
            <form class="actionForm" action="{{route('setupupdate')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="actiontype" value="portalsetting">
                <input type="hidden" name="code" value="otpsendmailid">
                <input type="hidden" name="name" value="Sending mail id for otp">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">Sending mail id for otp</h5>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="form-group">
                            <label>Mail Id</label>
                            <input type="text" name="value" value="{{$otpsendmailid->value ?? ''}}" class="form-control" required="" placeholder="Enter value">
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn bg-slate btn-raised legitRipple pull-right" type="submit" data-loading-text="<i class='fa fa-spin fa-spinner'></i> Updating...">Update Info</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-4">
            <form class="actionForm" action="{{route('setupupdate')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="actiontype" value="portalsetting">
                <input type="hidden" name="code" value="otpsendmailname">
                <input type="hidden" name="name" value="Sending mailer name id for otp">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">Sending mailer name id for otp</h5>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="form-group">
                            <label>Mailer Name</label>
                            <input type="text" name="value" value="{{$otpsendmailname->value ?? ''}}" class="form-control" required="" placeholder="Enter value">
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn bg-slate btn-raised legitRipple pull-right" type="submit" data-loading-text="<i class='fa fa-spin fa-spinner'></i> Updating...">Update Info</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-4">
            <form class="actionForm" action="{{route('setupupdate')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="actiontype" value="portalsetting">
                <input type="hidden" name="code" value="transactioncode">
                <input type="hidden" name="name" value="Transaction Id Code">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">Transaction Id Code</h5>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="form-group">
                            <label>Code</label>
                            <input type="text" name="value" value="{{$transactioncode->value ?? ''}}" class="form-control" required="" placeholder="Enter value">
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn bg-slate btn-raised legitRipple pull-right" type="submit" data-loading-text="<i class='fa fa-spin fa-spinner'></i> Updating...">Update Info</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-4">
            <form class="actionForm" action="{{route('setupupdate')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="actiontype" value="portalsetting">
                <input type="hidden" name="code" value="batch">
                <input type="hidden" name="name" value="Settlement Batch">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">Settlement Batch</h5>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="form-group">
                            <label>Time</label>
                            <textarea name="value"class="form-control" required="" placeholder="Enter value" rows="3">{{$batch->value ?? ''}}</textarea>
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
@endsection

@push('script')
    <script type="text/javascript">
    $(document).ready(function () {
        $('.actionForm').submit(function(event) {
            var form = $(this);
            var id = form.find('[name="id"]').val();
            form.ajaxSubmit({
                dataType:'json',
                beforeSubmit:function(){
                    form.find('button[type="submit"]').button('loading');
                },
                success:function(data){
                    if(data.status == "success"){
                        if(id == "new"){
                            form[0].reset();
                            $('[name="api_id"]').select2().val(null).trigger('change');
                        }
                        form.find('button[type="submit"]').button('reset');
                        notify("Task Successfully Completed", 'success');
                        $('#datatable').dataTable().api().ajax.reload();
                    }else{
                        notify(data.status, 'warning');
                    }
                },
                error: function(errors) {
                    showError(errors, form);
                }
            });
            return false;
        });

        $("#setupModal").on('hidden.bs.modal', function () {
            $('#setupModal').find('.msg').text("Add");
            $('#setupModal').find('form')[0].reset();
        });

        $('')
    });
</script>
@endpush