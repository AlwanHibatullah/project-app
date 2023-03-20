<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subkejuruan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subkejuruan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['kode_subkejuruan',
                            'subkejuruan',
                            'nomor_subkejuruan',
                            'kejuruan_id',
                            'deskripsi',
                            'thumnail'
                            ];


    public function paketpelatihan()
    {
        return $this->hasMany(PaketPelatihan::class, 'subkejuruan_id');
    }


    public function skkni()
    {
        return $this->hasMany(SKKNI::class, 'subkejuruan_id');
    }


    public function kejuruan()
    {
        return $this->belongsTo(Kejuruan::class, 'kejuruan_id');
    }
}
