@extends('layouts.app')
@section('title', 'Nsdl Pancard Registration View Detail')
@section('pagetitle', 'Nsdl Pancard Registration View Detail')
@section('content')
<div class="content">
  
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Nsdl Pancard Registration View Detail </h3>
                    </div>
                    <div class="panel-body p-b-0">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Application Type</label>
                                <div class="form-control"> 
                                    @if($nsdl_pancard->application_type==1)
                                        <span>New Application</span>
                                    @else
                                        <span>Correction</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>User Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <img src="{{$nsdl_pancard->getPhotoImageUrl()}}" width="200px" height="200px">
                                </div>
                                {{-- <input type="text" name="l_name"  class="form-control" placeholder="Enter Value"> --}}
                            </div>
                             

                           

                            <div class="form-group col-md-4">
                                <label>Adhar Card  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <img src="{{$nsdl_pancard->getAdharCardImageUrl()}}" width="200px" height="200px">
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Signature Proof  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <img src="{{$nsdl_pancard->getSignatureImageUrl()}}" width="200px" height="200px">
                                </div>
                            </div>

                            @if($nsdl_pancard->application_type==1)
                            <div class="form-group col-md-4">
                                <label>Nsdl Form  Photo</label>
                                <div class="mt-4" style="margin-top: 20px;">
                                    <img src="{{$nsdl_pancard->getNsdlFormImageUrl()}}" width="200px" height="200px">
                                </div>
                            </div>

                            @endif
                        
                       
                    </div>
                </div>
            </div>
          

           

            
        </div>
   
</div>
@endsection

@section('script')


@endsection
