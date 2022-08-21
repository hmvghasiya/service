<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class NsdlPancardRequest extends FormRequest
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
            'application_type' => 'required',
            'mobile_no' => 'required',
            'email' => 'required',
            'dob' => 'required',
            // 'old_pan_no' => 'required',
            'photo' => 'required',
            'signature' => 'required',
            'addhar_card_photo' => 'required',

        ];

        if ($r->application_type==2) {
            $data['old_pan_no']='required';
        }

        if ($r->application_type==1) {
            $data['nsdl_form'] = 'required';
            
        }

        return $data;
            

    
    }

    public function message()
    {
        return [
            'f_name.required' => 'First Name is required',
            'l_name.required' => 'Last Name is required',
            'm_name.required' => 'Middle Name is required',
            'application_type.required' => 'Application Type is required',
            'mobile_no.required' => 'Mobile is required',
            'email.required' => 'Email is required',
            'dob.required' => 'Date of birth required',
            'old_pan_no.required' => 'Pan No is required',
            'category.required' => 'Category is required',
            'photo.required' => 'Profile photo is required',
            'nsdl_form.required' => 'Nsdl Form is required',
            'addhar_card_photo.required' => 'Adharcard photo is required',
            'signature.required' => 'Nationality is required',
           
        ];
    }
}
