<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportXmlFileRequest extends FormRequest
{
    public function authorize()
    {
        // Change to true if you want to allow all users to import
        return true;
    }

    public function rules()
    {
        return [
            'xml_file' => 'required|max:5120',

        ];
    }

    public function messages()
    {
        return [
            'xml_file.required' => 'Please upload an XML file.',
            'xml_file.max' => 'The XML file must not exceed 5MB.',
        ];
    }
}
