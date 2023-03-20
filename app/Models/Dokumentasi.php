<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dokumentasi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama_dokumentasi', 'paketpelatihan_id'];


    public function paketpelatihan()
    {
        return $this->belongsTo(PaketPelatihan::class, 'paketpelatihan_id');
    }
}
