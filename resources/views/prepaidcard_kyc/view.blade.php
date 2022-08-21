@extends('layouts.app')
@section('title', 'Prepaid Card Kyc View Detail')
@section('pagetitle', 'Prepaid Card Kyc View Detail')
@section('content')
<div class="content">
  
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Prepaid Card Kyc View Detail </h3>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="row">
                           
                            <div class="form-group col-md-4">
                                <label>User Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$prepaidcard_kyc->getPhotoImageUrl()}}" width="200px" height="200px"> --}}
                                     @if( pathinfo($prepaidcard_kyc->getPhotoImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$prepaidcard_kyc->getPhotoImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$prepaidcard_kyc->getPhotoImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                                {{-- <input type="text" name="l_name"  class="form-control" placeholder="Enter Value"> --}}
                            </div>
                             <div class="form-group col-md-4">
                                <label>Pan Card Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$prepaidcard_kyc->getPanCardImageUrl()}}" width="200px" height="200px"> --}}
                                     @if( pathinfo($prepaidcard_kyc->getPanCardImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$prepaidcard_kyc->getPanCardImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$prepaidcard_kyc->getPanCardImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                                {{-- <input type="text" name="l_name"  class="form-control" placeholder="Enter Value"> --}}
                            </div>

                            <div class="form-group col-md-4">
                                <label>Passbook  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$prepaidcard_kyc->getPassBookImageUrl()}}" width="200px" height="200px"> --}}
                                     @if( pathinfo($prepaidcard_kyc->getPassBookImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$prepaidcard_kyc->getPassBookImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$prepaidcard_kyc->getPassBookImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                            </div>

                             <div class="form-group col-md-4">
                                <label>Adhar Card  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$prepaidcard_kyc->getAdharCardImageUrl()}}" width="200px" height="200px"> --}}
                                     @if( pathinfo($prepaidcard_kyc->getAdharCardImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$prepaidcard_kyc->getAdharCardImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$prepaidcard_kyc->getAdharCardImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                            </div>

                           
                           
                       
                    </div>
                </div>
            </div>
          

           

            
        </div>
   
</div>
@endsection

@section('script')


@endsection
