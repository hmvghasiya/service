@extends('layouts.app')
@section('title', 'Scheme Manager')
@section('pagetitle',  'Scheme Manager')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title">My Commission</h6>
                </div>

                <div class="panel-body no-padding">
                    <div class="tabbable">
                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified no-margin">
                            @foreach ($commission as $key => $value)
                                <li class="{{($key == 'mobile') ? 'active' : ''}}"><a href="#{{$key}}" data-toggle="tab" class="legitRipple" aria-expanded="true">{{ucfirst($key)}}</a></li>
                            @endforeach
                        </ul>

                        <div class="tab-content">
                            @foreach ($commission as $key => $value)
                            
                                <div class="tab-pane {{($key == 'mobile') ? 'active' : ''}}" id="{{$key}}">
                                    <table class="table table-bordered" cellspacing="0" style="width:100%">
                                        <thead>
                                            <th>Provider</th>
                                            <th>Type</th>
                                            @if(Myhelper::hasRole(['whitelable']))
                                            <th>Whitelable</th>
                                            @endif
                                            @if(Myhelper::hasRole(['statehead']))
                                            <th>State Head</th>
                                            @endif
                                            @if(Myhelper::hasRole(['md']))
                                            <th>Md</th>
                                            @endif
                                            @if(Myhelper::hasRole(['distributor']))
                                            <th>Distributor</th>
                                            @endif
                                            @if(Myhelper::hasRole(['retailer']))
                                            <th>Retailer</th>
                                            @endif
                                    </thead>

                                        <tbody>
                                            @foreach ($value as $comm)
                                            
                                                <tr>
                                                    <td>{{ucfirst($comm->provider->name)}}</td>
                                                    <td>{{ucfirst($comm->type)}}</td>
                                                    @if(Myhelper::hasRole(['admin','whitelable']))
                                                    <td>{{ucfirst($comm->whitelable)}}</td>
                                                    @endif
                                                    @if(Myhelper::hasRole(['admin','statehead']))
                                                    <td>{{ucfirst($comm->statehead)}}</td>
                                                    @endif
                                                    @if(Myhelper::hasRole(['admin','md']))
                                                    <td>{{ucfirst($comm->md)}}</td>
                                                    @endif
                                                    @if(Myhelper::hasRole(['admin','distributor']))
                                                    <td>{{ucfirst($comm->distributor)}}</td>
                                                    @endif
                                                    @if(Myhelper::hasRole(['admin','retailer']))
                                                    <td>{{ucfirst($comm->retailer)}}</td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach

                            

                            <div class="tab-pane" id="bottom-justified-tab2">
                                Food truck fixie locavore, accusamus mcsweeneys marfa nulla single-origin coffee squid laeggin.
                            </div>

                            <div class="tab-pane" id="bottom-justified-tab3">
                                DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
                            </div>

                            <div class="tab-pane" id="bottom-justified-tab4">
                                Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection