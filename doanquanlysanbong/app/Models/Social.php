<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table='social';
    public function login(){
        return $this->belongsTo('App\User','user');
    }
}
