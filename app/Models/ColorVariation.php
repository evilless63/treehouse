<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorVariation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function color() {
        return $this->BelongsTo(Color::class);
    }

    public function product() {
        return $this->BelongsTo(Product::class);
    }

    public function images() {
        return $this->hasMany(ImageGallery::class);
    }

    public function sizeVariations() {
        return $this->hasMany(SizeVariation::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
