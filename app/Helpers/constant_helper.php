<?php 

function getLoanTypeDropdown()
{
	$arr=[
		'1'=>'Personal Loan',
		'2'=>'Bussiness Loan',
	];

	return $arr;
}

function getApplicationTypeDropdown()
{
    $arr=[
        '1'=>'New',
        '2'=>'Correction',
    ];

    return $arr;
}

function getStatus($id)
{
    if ($id==1) {
        return 'Rejected';
    }elseif($id==2){
        return 'Pending';
    }elseif($id==3){
        return 'Deleted';
    }elseif($id==4){
        return 'Approved';
    }
}
function ADMIN_RATION_CARD_PHOTO_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/ration_card/photos/';
}

function NO_IMAGE_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/no_image.png';
}

function ADMIN_RATION_CARD_PHOTO_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/ration_card/photos/';
}

function ADMIN_RATION_CARD_ITR_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/ration_card/itr/';
}

function ADMIN_RATION_CARD_NATION_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/ration_card/nationalilty/';
}
function ADMIN_RATION_CARD_ADDRESS_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/ration_card/address/';
}

function ADMIN_RATION_CARD_ADHAR_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/ration_card/adhar/';
}
function ADMIN_RATION_CARD_BANK_STATE_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/ration_card/bank/';
}

function ADMIN_RATION_CARD_PAN_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/ration_card/pan/';
}

function ADMIN_RATION_CARD_ITR_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/ration_card/itr/';
}

function ADMIN_RATION_CARD_NATION_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/ration_card/nationalilty/';
}

function ADMIN_RATION_CARD_ADDRESS_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/ration_card/address/';
}

function ADMIN_RATION_CARD_ADHAR_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/ration_card/adhar/';
}
function ADMIN_RATION_CARD_BANK_STATE_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/ration_card/bank/';
}

function ADMIN_RATION_CARD_PAN_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/ration_card/pan/';
}





function ADMIN_E_SHARM_PHOTO_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/E_SHARM/photos/';
}

function ADMIN_E_SHARM_PHOTO_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/E_SHARM/photos/';
}

function ADMIN_E_SHARM_ITR_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/E_SHARM/itr/';
}

function ADMIN_E_SHARM_NATION_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/E_SHARM/nationalilty/';
}
function ADMIN_E_SHARM_ADDRESS_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/E_SHARM/address/';
}

function ADMIN_E_SHARM_ADHAR_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/E_SHARM/adhar/';
}
function ADMIN_E_SHARM_BANK_STATE_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/E_SHARM/bank/';
}

function ADMIN_E_SHARM_PAN_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/E_SHARM/pan/';
}

function ADMIN_E_SHARM_ITR_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/E_SHARM/itr/';
}

function ADMIN_E_SHARM_NATION_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/E_SHARM/nationalilty/';
}

function ADMIN_E_SHARM_ADDRESS_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/E_SHARM/address/';
}

function ADMIN_E_SHARM_ADHAR_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/E_SHARM/adhar/';
}
function ADMIN_E_SHARM_BANK_STATE_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/E_SHARM/bank/';
}

function ADMIN_E_SHARM_PAN_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/E_SHARM/pan/';
}



function ADMIN_PREPAIDCARD_KYC_PHOTO_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/PREPAIDCARD_KYC/photos/';
}

function ADMIN_PREPAIDCARD_KYC_PHOTO_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/PREPAIDCARD_KYC/photos/';
}

function ADMIN_PREPAIDCARD_KYC_ITR_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/PREPAIDCARD_KYC/itr/';
}

function ADMIN_PREPAIDCARD_KYC_NATION_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/PREPAIDCARD_KYC/nationalilty/';
}
function ADMIN_PREPAIDCARD_KYC_ADDRESS_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/PREPAIDCARD_KYC/address/';
}

function ADMIN_PREPAIDCARD_KYC_ADHAR_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/PREPAIDCARD_KYC/adhar/';
}
function ADMIN_PREPAIDCARD_KYC_PASS_BOOK_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/PREPAIDCARD_KYC/pass_book/';
}

function ADMIN_PREPAIDCARD_KYC_PAN_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/PREPAIDCARD_KYC/pan/';
}

function ADMIN_PREPAIDCARD_KYC_ITR_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/PREPAIDCARD_KYC/itr/';
}

function ADMIN_PREPAIDCARD_KYC_NATION_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/PREPAIDCARD_KYC/nationalilty/';
}

function ADMIN_PREPAIDCARD_KYC_ADDRESS_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/PREPAIDCARD_KYC/address/';
}

function ADMIN_PREPAIDCARD_KYC_ADHAR_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/PREPAIDCARD_KYC/adhar/';
}
function ADMIN_PREPAIDCARD_KYC_PASS_BOOK_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/PREPAIDCARD_KYC/pass_book/';
}

function ADMIN_PREPAIDCARD_KYC_PAN_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/PREPAIDCARD_KYC/pan/';
}



function ADMIN_LOAN_PHOTO_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/LOAN/photos/';
}

function ADMIN_LOAN_PHOTO_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/LOAN/photos/';
}

function ADMIN_LOAN_ITR_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/LOAN/itr/';
}

function ADMIN_LOAN_NATION_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/LOAN/nationalilty/';
}
function ADMIN_LOAN_ADDRESS_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/LOAN/address/';
}

function ADMIN_LOAN_ADHAR_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/LOAN/adhar/';
}
function ADMIN_LOAN_BANK_STATE_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/LOAN/bank/';
}

function ADMIN_LOAN_PAN_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/LOAN/pan/';
}

function ADMIN_LOAN_ITR_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/LOAN/itr/';
}

function ADMIN_LOAN_NATION_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/LOAN/nationalilty/';
}

function ADMIN_LOAN_ADDRESS_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/LOAN/address/';
}

function ADMIN_LOAN_ADHAR_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/LOAN/adhar/';
}
function ADMIN_LOAN_BANK_STATE_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/LOAN/bank/';
}

function ADMIN_LOAN_PAN_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/LOAN/pan/';
}




function ADMIN_DIGITAL_SIGNATURE_PHOTO_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/DIGITAL_SIGNATURE/photos/';
}

function ADMIN_DIGITAL_SIGNATURE_PHOTO_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/DIGITAL_SIGNATURE/photos/';
}

function ADMIN_DIGITAL_SIGNATURE_ITR_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/DIGITAL_SIGNATURE/itr/';
}

function ADMIN_DIGITAL_SIGNATURE_NATION_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/DIGITAL_SIGNATURE/nationalilty/';
}
function ADMIN_DIGITAL_SIGNATURE_ADDRESS_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/DIGITAL_SIGNATURE/address/';
}

function ADMIN_DIGITAL_SIGNATURE_ADHAR_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/DIGITAL_SIGNATURE/adhar/';
}
function ADMIN_DIGITAL_SIGNATURE_BANK_STATE_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/DIGITAL_SIGNATURE/bank/';
}

function ADMIN_DIGITAL_SIGNATURE_PAN_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/DIGITAL_SIGNATURE/pan/';
}

function ADMIN_DIGITAL_SIGNATURE_ITR_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/DIGITAL_SIGNATURE/itr/';
}

function ADMIN_DIGITAL_SIGNATURE_NATION_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/DIGITAL_SIGNATURE/nationalilty/';
}

function ADMIN_DIGITAL_SIGNATURE_ADDRESS_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/DIGITAL_SIGNATURE/address/';
}

function ADMIN_DIGITAL_SIGNATURE_ADHAR_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/DIGITAL_SIGNATURE/adhar/';
}
function ADMIN_DIGITAL_SIGNATURE_BANK_STATE_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/DIGITAL_SIGNATURE/bank/';
}

function ADMIN_DIGITAL_SIGNATURE_PAN_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/DIGITAL_SIGNATURE/pan/';
}





function ADMIN_GST_REG_PHOTO_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/GST_REG/photos/';
}

function ADMIN_GST_REG_PHOTO_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/GST_REG/photos/';
}

function ADMIN_GST_REG_ITR_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/GST_REG/itr/';
}

function ADMIN_GST_REG_SIGN_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/GST_REG/signature/';
}
function ADMIN_GST_REG_ADDRESS_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/GST_REG/address/';
}

function ADMIN_GST_REG_ADHAR_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/GST_REG/adhar/';
}
function ADMIN_GST_REG_BANK_STATE_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/GST_REG/bank/';
}

function ADMIN_GST_REG_PAN_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/GST_REG/pan/';
}

function ADMIN_GST_REG_ITR_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/GST_REG/itr/';
}

function ADMIN_GST_REG_SIGN_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/GST_REG/signature/';
}

function ADMIN_GST_REG_ADDRESS_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/GST_REG/address/';
}

function ADMIN_GST_REG_ADHAR_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/GST_REG/adhar/';
}
function ADMIN_GST_REG_BANK_STATE_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/GST_REG/bank/';
}

function ADMIN_GST_REG_PAN_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/GST_REG/pan/';
}



function ADMIN_ITR_REG_PHOTO_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/ITR_REG/photos/';
}

function ADMIN_ITR_REG_PHOTO_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/ITR_REG/photos/';
}

function ADMIN_ITR_REG_ITR_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/ITR_REG/itr/';
}

function ADMIN_ITR_REG_SIGN_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/ITR_REG/signature/';
}
function ADMIN_ITR_REG_ADDRESS_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/ITR_REG/address/';
}

function ADMIN_ITR_REG_ADHAR_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/ITR_REG/adhar/';
}
function ADMIN_ITR_REG_BANK_STATE_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/ITR_REG/bank/';
}

function ADMIN_ITR_REG_PAN_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/ITR_REG/pan/';
}

function ADMIN_ITR_REG_ITR_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/ITR_REG/itr/';
}

function ADMIN_ITR_REG_SIGN_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/ITR_REG/signature/';
}

function ADMIN_ITR_REG_ADDRESS_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/ITR_REG/address/';
}

function ADMIN_ITR_REG_ADHAR_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/ITR_REG/adhar/';
}
function ADMIN_ITR_REG_BANK_STATE_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/ITR_REG/bank/';
}

function ADMIN_ITR_REG_PAN_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/ITR_REG/pan/';
}



function ADMIN_NSDL_PANCARD_PHOTO_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/NSDL_PANCARD/photos/';
}

function ADMIN_NSDL_PANCARD_PHOTO_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/NSDL_PANCARD/photos/';
}

function ADMIN_NSDL_PANCARD_ITR_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/NSDL_PANCARD/itr/';
}

function ADMIN_NSDL_PANCARD_SIGN_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/NSDL_PANCARD/signature/';
}
function ADMIN_NSDL_PANCARD_ADDRESS_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/NSDL_PANCARD/address/';
}

function ADMIN_NSDL_PANCARD_ADHAR_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/NSDL_PANCARD/adhar/';
}

function ADMIN_NSDL_PANCARD_NSDL_FORM_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/NSDL_PANCARD/nsdl_form/';
}

function ADMIN_NSDL_PANCARD_BANK_STATE_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/NSDL_PANCARD/bank/';
}

function ADMIN_NSDL_PANCARD_PAN_UPLOAD_URL()
{
    return UPLOAD_AND_DOWNLOAD_URL().'upload/NSDL_PANCARD/pan/';
}

function ADMIN_NSDL_PANCARD_ITR_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/NSDL_PANCARD/itr/';
}

function ADMIN_NSDL_PANCARD_SIGN_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/NSDL_PANCARD/signature/';
}

function ADMIN_NSDL_PANCARD_NSDL_FORM_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/NSDL_PANCARD/nsdl_form/';
}

function ADMIN_NSDL_PANCARD_ADHAR_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/NSDL_PANCARD/adhar/';
}
function ADMIN_NSDL_PANCARD_BANK_STATE_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/NSDL_PANCARD/bank/';
}

function ADMIN_NSDL_PANCARD_PAN_UPLOAD_PATH(){

    return UPLOAD_AND_DOWNLOAD_PATH().'/upload/NSDL_PANCARD/pan/';
}

// Upload and download path
function UPLOAD_AND_DOWNLOAD_PATH()
{
    return public_path();
}

function UPLOAD_AND_DOWNLOAD_URL(){


        return  asset('');

}


function UPLOAD_FILE($r,$name,$uploadPath){

    $image=$r->$name;
    $name = time().''.$image->getClientOriginalName();
    
    $image->move($uploadPath,time().''.$image->getClientOriginalName());
 
    return  $name;
}
?>