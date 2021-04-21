<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends LocalizedModel
{
    use HasFactory;
    protected $guarded = ['localization'];
    public function sizeVariations() {
        return $this->hasMany(SizeVariation::class);
    }

}
