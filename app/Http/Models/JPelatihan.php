<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JPelatihan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jpelatihan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['jpelatihan', 'kode_jpelatihan'];


    public function paketpelatihan()
    {
        return $this->hasMany(PaketPelatihan::class, 'jpelatihan_id');
    }
}
