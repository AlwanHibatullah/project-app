<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumni';

    protected $fillable = [ 'predikat',
                            'no_sertifkat',
                            'file_serfikat',
                            'bekerja_di',
                            'pesan',
                            'siswa_id',
                            'pegawai_id'
                            ];


    // public function pegawai(): BelongsTo
    // {
    //     return $this->belongsTo(Pegawai::class, 'pegawai_id');
    // }

    public function bukuinduk(): BelongsTo
    {
        return $this->belongsTo(BukuInduk::class, 'siswa_id');
    }
}
