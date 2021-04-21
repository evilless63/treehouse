<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends LocalizedModel
{
    use HasFactory;
    protected $guarded = ['localization'];
    public function colorVariations() {
        return $this->hasMany(ColorVariation::class);
    }

}
