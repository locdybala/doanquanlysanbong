<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    protected $guarded = [];

    use HasFactory;
    public function pitch(){
        return $this->belongsTo(Pitch::class,'pitch_id');
    }
}
