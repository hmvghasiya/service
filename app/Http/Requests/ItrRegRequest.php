<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class ItrRegRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $r)
    {
         $input = $r->all();
        $id    = !empty($input['id']) ? $input['id'] : "";
         $data=[
            'f_name' => 'required',
            'l_name' => 'required',
            'm_name' => 'required',
            // 'loan_type' => 'required',
            'mobile_no' => 'required',
            'email' => 'required',
            'dob' => 'required',
            'pan_no' => 'required',
            'city' => 'required',
            'state' => 'required',
            'address' => 'required',
            'photo' => 'required',
            'pancard_photo' => 'required',
            'bank_statement_photo' => 'required',
            'addhar_card_photo' => 'required',
            'address_proof' => 'required',

        ];

            $data['signature']='required';
       

        return $data;
            

    
    }

    public function message()
    {
        return [
            'f_name.required' => 'First Name is required',
            'l_name.required' => 'Last Name is required',
            'm_name.required' => 'Middle Name is required',
            'loan_type.required' => 'Loan Type is required',
            'mobile_no.required' => 'Mobile is required',
            'email.required' => 'Email is required',
            'dob.required' => 'Date of birth required',
            'pan_no.required' => 'Pan No is required',
            'city.required' => 'City is required',
            'state.required' => 'State is required',
            'address.required' => 'Address is required',
            'photo.required' => 'Profile photo is required',
            'pancard_photo.required' => 'Pan Card is required',
            'bank_statement_photo.required' => 'Bank Statement is required',
            'addhar_card_photo.required' => 'Adharcard photo is required',
            'address_proof.required' => 'Address Proof is required',
            'signature.required' => 'Nationality is required',
            'itr_3_year.required' => 'Itr 3 year is required',
           
        ];
    }
}
