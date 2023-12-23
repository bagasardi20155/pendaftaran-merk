<?php

namespace App\Http\Requests\Applicant;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAjuanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasRole('applicant');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id_user' => 'exists:users,id',
            'address' => '',
            'owner' => '',
            'logo' => 'image|mimes:png,jpg|max:1024',
            'suket_umk' => 'file|mimes:pdf,jpg|max:2048',
            'applicant_signature' => 'image|mimes:png,jpg|max:1024',
        ];
    }
}
