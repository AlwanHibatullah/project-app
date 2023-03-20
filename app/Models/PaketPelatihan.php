<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketPelatihan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'paketpelatihan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['namapelatihan',
                            'angkatan',
                            'jp',
                            'awalpelatihan',
                            'selesaipelatihan',
                            'tahun',
                            'jumlah_siswa',
                            'status',
                            'dana_id',
                            'jpelatihan_id',
                            'subkejuruan_id',
                            'test',
                            'group',
                            'pembukaan',
                            'penutupan'
                        ];

    public function jpelatihan()
    {
        return $this->belongsTo(JPelatihan::class, 'jpelatihan_id');
    }


    public function subkejuruan()
    {
        return $this->belongsTo(Subkejuruan::class, 'subkejuruan_id');
    }


    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'paketpelatihan_id');
    }


    public function bukuinduk()
    {
        return $this->hasMany(BukuInduk::class, 'paketpelatihan_id');
    }


    public function dokumentasi()
    {
        return $this->hasMany(Dokumentasi::class, 'paketpelatihan_id');
    }


    public function dana()
    {
        return $this->belongsTo(Dana::class, 'dana_id');
    }


    public function riwayat()
    {
        return $this->hasMany(Riwayat::class, 'paketpelatihan_id');
    }
}
