<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'penilaian';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['jenis_nilai',
                            'nilai',
                            'skkni_id',
                            'siswa_id',
                            // 'pegawai_id'
                            ];

    public function skkni()
    {
        return $this->belongsTo(SKKNI::class, 'skkni_id');
    }

    public function bukuinduk()
    {
        return $this->belongsTo(BukuInduk::class, 'siswa_id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }


}
