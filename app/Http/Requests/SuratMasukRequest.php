<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuratMasukRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Sesuaikan dengan authorization logic Anda
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'nomor_surat' => 'required|string|max:255|unique:surat_masuk,nomor_surat',
            'tanggal_surat' => 'required|date',
            'tanggal_diterima' => 'required|date',
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'jenis' => 'nullable|string|max:255',
            'isi' => 'nullable|string',
            'lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'diteruskan_ke' => 'nullable|string|max:255',
            'status' => 'required|in:Belum Dibaca,Sudah Dibaca',
            'catatan' => 'nullable|string',
        ];

        // Untuk update, tambahkan ID yang sedang diedit ke unique rule
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $suratMasukId = $this->route('surat_masuk')->id ?? $this->route('id');
            $rules['nomor_surat'] = 'required|string|max:255|unique:surat_masuk,nomor_surat,' . $suratMasukId;
        }

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'nomor_surat' => 'nomor surat',
            'tanggal_surat' => 'tanggal surat',
            'tanggal_diterima' => 'tanggal diterima',
            'pengirim' => 'pengirim',
            'perihal' => 'perihal',
            'jenis' => 'jenis surat',
            'isi' => 'isi surat',
            'lampiran' => 'lampiran',
            'diteruskan_ke' => 'diteruskan ke',
            'status' => 'status',
            'catatan' => 'catatan',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nomor_surat.required' => 'Nomor surat harus diisi',
            'nomor_surat.unique' => 'Nomor surat sudah terdaftar',
            'tanggal_surat.required' => 'Tanggal surat harus diisi',
            'tanggal_surat.date' => 'Format tanggal surat tidak valid',
            'tanggal_diterima.required' => 'Tanggal diterima harus diisi',
            'tanggal_diterima.date' => 'Format tanggal diterima tidak valid',
            'pengirim.required' => 'Pengirim harus diisi',
            'perihal.required' => 'Perihal harus diisi',
            'lampiran.file' => 'Lampiran harus berupa file',
            'lampiran.mimes' => 'Format file lampiran tidak valid (PDF, DOC, DOCX, JPG, JPEG, PNG)',
            'lampiran.max' => 'Ukuran file lampiran maksimal 5MB',
            'status.required' => 'Status harus dipilih',
            'status.in' => 'Status tidak valid',
        ];
    }
}