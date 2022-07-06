<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $guarded = ['id_promo'];
    protected $table = 'promo';
    protected $primaryKey = 'id_promo';

    public function kedai()
    {
        return $this->belongsTo('App\Models\Kedai', 'id_kedai');
    }
}
