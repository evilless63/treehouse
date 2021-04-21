<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends LocalizedModel
{

    use HasFactory;
    protected $guarded = ['localization'];
    public function products() {
        return $this->belongsToMany(Product::class);
    }
    
    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_id', 'category_id');
    }

}
