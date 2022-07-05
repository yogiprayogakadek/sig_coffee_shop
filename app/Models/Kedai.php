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
}
