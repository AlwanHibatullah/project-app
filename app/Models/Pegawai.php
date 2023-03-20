<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pegawai';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'nama_pegawai',
                            'status_kepegawaian',
                            'jabatan',
                            'nip',
                            'jenis_kelamin',
                            'alamat',
                            'avatar',
                            'user_id',
                            'kejuruan_id'
                            ];

    // public function alumni(): HasMany
    // {
    //     return $this->hasMany(Alumni::class, 'pegawai_id');
    // }

    // public function penilaian(): HasMany
    // {
    //     return $this->hasMany(Peniaian::class, 'pegawai_id');
    // }


    // public function pendaftaran()
    // {
    //     return $this->hasMany(Pendaftaran::class, 'pegawai_id');
    // }


    // public function pengumuman()
    // {
    //     return $this->hasMany(Pengumuman::class, 'pegawai_id');
    // }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    // public function kejuruan()
    // {
    //     return $this->belongsTo(Kejuruan::class, 'kejuruan_id');
    // }


    // public function bukuinduk()
    // {
    //     return $this->hasMany(BukuInduk::class, 'pegawai_id');
    // }


    // public function riwayat()
    // {
    //     return $this->hasMany(Riwayat::class, 'pegawai_id');
    // }
}
