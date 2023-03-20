<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dana extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dana';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['dana'];


    public function skkni()
    {
        return $this->hasMany(SKKNI::class, 'dana_id');
    }


    public function paketpelatihan()
    {
        return $this->hasMany(PaketPelatihan::class, 'dana_id');
    }
}
