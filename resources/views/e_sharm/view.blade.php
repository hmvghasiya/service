@extends('layouts.app')
@section('title', 'E Sharm View Detail')
@section('pagetitle', 'E Sharm View Detail')
@section('content')
<div class="content">
  
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">E Sharm View Detail </h3>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="row">
                           
                            <div class="form-group col-md-4">
                                <label>User Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$e_sharm->getPhotoImageUrl()}}" width="200px" height="200px"> --}}
                                     @if( pathinfo($e_sharm->getPhotoImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$e_sharm->getPhotoImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$e_sharm->getPhotoImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                                {{-- <input type="text" name="l_name"  class="form-control" placeholder="Enter Value"> --}}
                            </div>
                             <div class="form-group col-md-4">
                                <label>Pan Card Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$e_sharm->getPanCardImageUrl()}}" width="200px" height="200px"> --}}
                                     @if( pathinfo($e_sharm->getPanCardImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$e_sharm->getPanCardImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$e_sharm->getPanCardImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                                {{-- <input type="text" name="l_name"  class="form-control" placeholder="Enter Value"> --}}
                            </div>

                            <div class="form-group col-md-4">
                                <label>Bank Statement  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$e_sharm->getBankImageUrl()}}" width="200px" height="200px"> --}}
                                     @if( pathinfo($e_sharm->getBankImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$e_sharm->getBankImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$e_sharm->getBankImageUrl()}}" target="_blank">View Detail</a>
                                    @endif
                                </div>
                            </div>

                             <div class="form-group col-md-4">
                                <label>Adhar Card  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$e_sharm->getAdharCardImageUrl()}}" width="200px" height="200px"> --}}
                                    @if( pathinfo($e_sharm->getAdharCardImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$e_sharm->getAdharCardImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$e_sharm->getAdharCardImageUrl()}}" target="_blank">View Detail</a>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Address Proof  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    {{-- <img src="{{$e_sharm->getAddressImageUrl()}}" width="200px" height="200px"> --}}
                                     @if( pathinfo($e_sharm->getAddressImageUrl(), PATHINFO_EXTENSION) !='pdf')

                                    <img src="{{$e_sharm->getAddressImageUrl()}}" width="200px" height="200px">
                                      @else
                                    <a href="{{$e_sharm->getAddressImageUrl()}}" target="_blank">View Detail</a>
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
