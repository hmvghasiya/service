<!-- Page header -->
<div class="page-header page-header-default mb-10">
    <div class="page-header-content">
        <div class="page-title">
            <div class="row">
                <h4 class="col-md-3"><span class="text-semibold">@yield('pagehead', 'Home')</span> - @yield('pagetitle')</h4>
                @if ($mydata['news'] != '' && $mydata['news'] != null)
                <h4 class="col-md-9 text-danger"><marquee style="height: 25px" onmouseover="this.stop();" onmouseout="this.start();">{{$mydata['news']}}</marquee></h4>
                @endif
            </div>
        </div>
    </div>
</div>
@if (!Request::is('dashboard') && !Request::is('profile/*') && !Request::is('recharge/*') && !Request::is('billpay/*') && !Request::is('pancard/*') && !Request::is('member/*/create') && !Request::is('profile') && !Request::is('profile/*') && !Request::is('dmt') && !Request::is('resources/companyprofile') && !Request::is('aeps/*') && !Request::is('developer/*') && !Request::is('resources/commission') && !Request::is('setup/portalsetting'))
<!-- /page header -->
<div class="content p-b-0">
    <form id="searchForm">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Search</h4>
                <div class="heading-elements">
                    <button type="submit" class="btn bg-slate btn-xs btn-labeled legitRipple btn-lg search_text" data-loading-text="<b><i class='fa fa-spin fa-spinner'></i></b> Searching"><b><i class="icon-search4"></i></b> Search</button>
                    <button type="button" class="btn btn-warning btn-xs btn-labeled legitRipple" id="formReset" data-loading-text="<b><i class='fa fa-spin fa-spinner'></i></b> Refreshing"><b><i class="icon-rotate-ccw3"></i></b> Refresh</button>
                    <button type="button" class="btn btn-primary btn-xs btn-labeled legitRipple {{ isset($export) ? '' : 'hide' }}" product="{{ $export ?? '' }}" id="reportExport"><b><i class="icon-cloud-download2"></i></b> Export</button></div>
            </div>
            <div class="panel-body p-tb-10">
                @if(isset($mystatus))
                    <input type="hidden" name="status" value="{{$mystatus}}">
                @endif
                <div class="row">
                    <div class="form-group col-md-2 m-b-10">
                        <input type="text" name="from_date" class="form-control mydate" placeholder="From Date">
                    </div>
                    <div class="form-group col-md-2 m-b-10">
                        <input type="text" name="to_date" class="form-control mydate" placeholder="To Date">
                    </div>
                    <div class="form-group col-md-2 m-b-10">
                        <input type="text" name="searchtext" class="form-control" placeholder="Search Value">
                    </div>
                    @if (Myhelper::hasNotRole(['retailer', 'apiuser']))
                        <div class="form-group col-md-2 m-b-10 {{ isset($agentfilter) ? $agentfilter : ''}}">
                            <input type="text" name="agent" class="form-control" placeholder="Agent Id / Parent Id">
                        </div>
                    @endif

                    @if(isset($status))
                    <div class="form-group col-md-2">
                        <select name="status" class="form-control select">
                            <option value="">Select {{$status['type'] ?? ''}} Status</option>
                            @if (isset($status['data']) && sizeOf($status['data']) > 0)
                                @foreach ($status['data'] as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    @endif

                    @if(isset($product))
                    <div class="form-group col-md-2">
                        <select name="product" class="form-control select">
                            <option value="">Select {{$product['type'] ?? ''}}</option>
                            @if (isset($product['data']) && sizeOf($product['data']) > 0)
                                @foreach ($product['data'] as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>
@endif