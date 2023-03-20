<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kejuruan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kejuruan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['kejuruan','kode_kejuruan'];


    public function subkejuruan()
    {
        return $this->hasMany(Subkejuruan::class, 'kejuruan_id');
    }


    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'kejuruan_id');
    }
}
