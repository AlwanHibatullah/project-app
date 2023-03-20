<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $table = 'dokumen';

    protected $fillable = [ 'noinduk',
                            'siswa_id',
                            'foto',
                            'ijazah',
                            'transkip',
                            'surat_pernyataan'
                            ];

    public function bukuinduk()
    {
        return $this->belongsTo(BukuInduk::class, 'siswa_id');
    }
}


