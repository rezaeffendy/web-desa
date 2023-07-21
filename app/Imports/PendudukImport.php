<?php

namespace App\Imports;

use App\Models\Penduduk;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PendudukImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $collect) {
            $tgl_lahir = ($collect['tanggal_lahir'] - 25569) * 86400;

            Penduduk::create([
                'nama' => $collect['nama_lengkap'],
                'nik' => $collect['nik'],
                'jk' => $collect['jk'],
                'kewarganegaraan' => $collect['kewarganegaraan'],
                'agama' => $collect['agama'],
                'tempat_lahir' => $collect['tempat_lahir'],
                'tgl_lahir' => date('Y-m-d', strtotime($tgl_lahir)),
                'pekerjaan' => $collect['pekerjaan'],
                'alamat' => $collect['alamat'],
                'status' => 1
            ]);
        }
    }
}
