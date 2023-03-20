<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skkni extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'skkni';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['kode_unit',
                            'unit_kompetensi',
                            'jp_teori',
                            'jp_praktik',
                            'kelompok_unit',
                            'subkejuruan_id',
                            'dana_id'
                        ];


    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'skkni_id');
    }

    public function subkejuruan()
    {
        return $this->belongsTo(Subkejuruan::class, 'subkejuruan_id');
    }

    public function dana()
    {
        return $this->belongsTo(Dana::class, 'dana_id');
    }
}
