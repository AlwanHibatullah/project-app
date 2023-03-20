<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegumuman extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pengumuman';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['judul',
                            'content',
                            'views',
                            'status',
                            'pegawai_id'
                            ];


    // public function pegawai()
    // {
    //     return $this->belongsTo(Pegawai::class, 'pegawai_id');
    // }
}
