<?php

namespace App\Http\Requests\Applicant;

use Illuminate\Foundation\Http\FormRequest;

class PengajuanBaruRequest extends FormRequest
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
            'id_user' => 'required|exists:users,id',
            'name' => 'required|unique:brands,name',
            'address' => 'required',
            'owner' => 'required',
            'kelas' => 'required|integer|between:1,45',
            'logo' => 'required|image|mimes:png,jpg|max:1024',
            'suket_umk' => 'file|mimes:pdf,jpg|max:2048',
            'applicant_signature' => 'required|image|mimes:png,jpg|max:1024',
        ];
    }

    public function attributes()
    {
        return [
            'id_user' => 'ID Pemohon',
			'name' => 'Nama Merk / Usaha', 
			'address' => 'Alamat Usaha', 
			'owner' => 'Pemilik Merk / Usaha',
            'kelas' => 'Kelas Merk', 
			'logo' => 'Logo Merk / Usaha', 
			'suket_umk' => 'Surat Keterangan UMK', 
			'applicant_signature' => 'Tanda Tangan Pemohon',
        ];
    }
}
