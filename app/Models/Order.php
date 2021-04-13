<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function colorVariation() {
        return $this->belongsTo(ColorVariation::class);
    }

    public function sizeVariation() {
        return $this->belongsTo(SizeVariation::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
