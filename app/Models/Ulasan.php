<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasan';
    protected $guarded = ['id_ulasan'];
    protected $primaryKey = 'id_ulasan';

    public function kedai()
    {
        return $this->belongsTo('App\Models\Kedai', 'id_kedai');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
    }
}
