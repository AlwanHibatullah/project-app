<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

    protected $fillable = ['nama_pendaftar',
                            'nik',
                            'tempat_lahir',
                            'tgl_lahir',
                            'jenis_kelamin',
                            'status_pernikahan',
                            'telp',
                            'telpwali',
                            'email',
                            'bb',
                            'tb',
                            'orangtua',
                            'alamat_detail',
                            'desa',
                            'kecamatan',
                            'kabupaten',
                            'provinsi',
                            'pendidikan_terakhir',
                            'nama_sekolah',
                            'jurusan_prodi',
                            'tahun_lulus',
                            'nilai_rata',
                            'paketpelatihan_id',
                            'pegawai_id'
                            ];


    public function paketpelatihan()
    {
        return $this->belongsTo(PaketPelatihan::class, 'paketpelatihan_id');
    }

    // public function pegawai()
    // {
    //     return $this->belongsTo(Pegawai::class, 'pegawai_id');
    // }
}
