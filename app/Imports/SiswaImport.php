<?php

namespace App\Imports;

use App\User;
use App\Models\Siswa;
use App\Models\SiswaOrangTua;
use App\Models\SiswaWali;
use Illuminate\Support\Facades\{Hash, Auth};
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


// kalau mau pake yang lama hidupkan yang ini
// class SiswaImport implements ToModel, WithHeadingRow
// {
//     /**
//     * @param array $row
//     *
//     * @return \Illuminate\Database\Eloquent\Model|null
//     */
//     public function model(array $row)
//     {
//         if ($row['nama'] != null) {
//             $user = User::where('username', $row['username'])->first();
        
//             $siswaId = Siswa::create([
//                 'nama_lengkap' => $row['nama'],
//                 'nis' => $row['nis'],
//                 'nisn' => $row['nisn'],
//                 'poin' => $row['poin'],
//                 'kelas_id' => $row['kelas_id'],
//             ])->id;

//             $user = User::create([
//                 'role_id' => 3,
//                 'siswa_id' => $siswaId,
//                 'id_sekolah' => Auth::user()->id_sekolah,
//                 'name' => $row['nama'],
//                 'username' => $row['username'],
//                 'nis' => $row['nis'],
//                 'password' => Hash::make($row['password']),
//             ]);

//             $siswaWali = SiswaWali::create([
//                 'id_siswa' => $siswaId,
//             ]);

//             SiswaOrangTua::create([
//                 'id_siswa' => $siswaId,
//             ]);
//         } 
//     }
// }

// kalau mau pake yang baru hidupkan yang ini
class SiswaImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row['nama'] != null) {
            $user = User::where('username', $row['username'])->first();
        
            $siswaId = Siswa::create([
                'nama_lengkap' => $row['nama'],
                'nis' => $row['nis'],
                'nisn' => $row['nisn'],
                'poin' => $row['poin'],
                'kelas_id' => $row['kelas_id'],
            ])->id;

            $user = User::create([
                'role_id' => 3,
                'siswa_id' => $siswaId,
                'id_sekolah' => Auth::user()->id_sekolah,
                'name' => $row['nama'],
                'username' => $row['username'],
                'nis' => $row['nis'],
                'password' => Hash::make($row['password']),
            ]);

            $siswaWali = SiswaWali::create([
                'id_siswa' => $siswaId,
            ]);

            SiswaOrangTua::create([
                'id_siswa' => $siswaId,
            ]);
        } 
    }

    public function  rules(): array {
        return [
            '*.username' => 'unique:users',
        ];
    }
}
