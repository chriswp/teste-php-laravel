<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentUploadRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'file' => 'required|mimes:json|max:10240',
        ];
    }

    public function messages()
    {
        return [
            'file.max' => 'O arquivo não pode ser maior que 10MB.',
            'file.required' => 'O arquivo é obrigatório.',
            'file.mimes' => 'O arquivo deve ser um JSON válido.',
        ];
    }
}
