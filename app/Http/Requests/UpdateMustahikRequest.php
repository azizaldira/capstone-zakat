<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMustahikRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() && $this->user()->isAmil();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'nomor_telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
            'kategori_asnaf' => 'required|in:Fakir,Miskin,Amil,Mualaf,Riqab,Gharim,Fisabilillah,Ibnu Sabil',
            'status_aktif' => 'required|in:Aktif,Tidak Aktif',
            'keterangan' => 'nullable|string',
        ];
    }
}
