<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuInduk extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'buku_induk';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'noinduk','nama_pendaftar',
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
                            'pendidikan_terakhir',
                            'nama_sekolah',
                            'jurusan_prodi',
                            'tahun_lulus',
                            'nilai_rata',
                            'kepesertaan',
                            'paketpelatihan_id',
                            'ktp',
                            'status_ktp'
                            ];


    public function alumni()
    {
        return $this->hasOne(Alumni::class, 'siswa_id');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'siswa_id');
    }

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'siswa_id');
    }

    public function paketpelatihan()
    {
        return $this->belongsTo(PaketPelatihan::class, 'paketpelatihan_id');
    }

    // public function pegawai()
    // {
    //     return $this->belongsTo(Pegawai::class, 'pegawai_id');
    // }
}
