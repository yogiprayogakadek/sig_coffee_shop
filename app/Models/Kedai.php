<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kedai extends Model
{
    use HasFactory;

    protected $guarded = ['id_kedai'];
    protected $table = 'kedai';
    protected $primaryKey = 'id_kedai';

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_kedai');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function promo()
    {
        return $this->hasMany(Promo::class, 'id_kedai');
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'id_kedai');
    }
}
