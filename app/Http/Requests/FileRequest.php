<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "data.id"             => 'required',
            "data.name"           => 'required',
            "data.recipient"      => 'required',
            // "data.recipient.name" => 'required',
            // "data.recipient.email"=> 'required',
            "data.issuer"         => 'required',
            "data.issuer.name"    => 'required',
            "data.issuer.identityProof" => 'required',
            "data.issued"         => 'required',
            "signature.targetHash"=> 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'data.name.required'            => 'Data Id is required',
            'data.name.required'            => 'Name is required',
            'data.recipient.required'       => 'Recipient field is required',
            // 'data.recipient.name.required'  => 'Recipient name field is required',
            // 'data.recipient.email.required' => 'Recipient email field is required',
            'data.issuer.required'          => 'Issuer field is required',
            'data.issuer.name.required'     => 'Issuer name field is required',
            'data.issued.required'          => 'Issued date is required',
            'signature.targetHash.required' => 'TargetHash date is required',
        ];
    }
}
