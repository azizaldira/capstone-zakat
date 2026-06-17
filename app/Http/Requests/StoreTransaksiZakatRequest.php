<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransaksiZakatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() && $this->user()->isAdminPanitia();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'muzakki_id' => 'required|exists:muzakkis,id',
            'jenis_zakat' => 'required|in:Zakat Fitrah,Zakat Mal,Infak,Sedekah',
            'nominal' => 'required|numeric|min:1',
            'metode_pembayaran' => 'required|in:Tunai,Transfer Bank,E-Wallet',
            'tanggal_bayar' => 'required|date',
            'keterangan' => 'nullable|string',
        ];
    }
}
