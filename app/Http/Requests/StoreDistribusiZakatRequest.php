<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDistribusiZakatRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'mustahik_id' => 'required|exists:mustahiks,id',
            'nominal_distribusi' => 'required|numeric|min:1',
            'tanggal_distribusi' => 'required|date',
            'kategori_bantuan' => 'required|in:Zakat Fitrah,Zakat Mal,Bantuan Pendidikan,Bantuan Kesehatan,Bantuan Sosial,Bantuan Darurat',
            'keterangan' => 'nullable|string',
        ];
    }
}
