<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends LocalizedModel
{
    use HasFactory;

    protected $guarded = ['localization'];

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function colorVariations() {
        return $this->hasMany(ColorVariation::class);
    }


}
