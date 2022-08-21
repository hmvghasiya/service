<!-- Main navbar -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header">
        @if (Auth::user()->company->logo)
            <a class="navbar-brand no-padding" href="{{route('home')}}">
                <img src="{{asset('')}}public/logos/{{Auth::user()->company->logo}}" class=" img-responsive" alt="" style="width: 260px;height: 56px;">
            </a>
        @else
            <a class="navbar-brand" href="{{route('home')}}" style="padding: 20px">
                <span class="companyname" style="color: white">{{Auth::user()->company->companyname}}</span>
            </a>
        @endif

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
            @if (Myhelper::hasRole('admin'))
            <li><a href="javascript:void(0)" style="padding: 13px"><button type="button" class="btn bg-slate btn-labeled btn-xs legitRipple" data-toggle="modal" data-target="#walletLoadModal"><b><i class="icon-wallet"></i></b> Load Wallet</button></a></li>
            @endif
        </ul>

        <div class="navbar-right">
            <p class="navbar-text"><i class="icon-wallet"></i> Wallet : <span class="mainwallet">{{Auth::user()->mainwallet}}</span> /-</p>
            <a class="navbar-text" href="{{route('fund', ['type' => 'aeps'])}}"> <span>Payout Request</span></a>
            <!--<p class="navbar-text"><i class="icon-wallet"></i> Aeps : <span class="aepsbalance">{{Auth::user()->aepsbalance}}</span> /-</p>-->
            <a class="navbar-text" href="{{route('logout')}}"><i class="icon-switch2"></i> <span>Logout</span></a>
        </div>
    </div>
</div>
<!-- /main navbar -->