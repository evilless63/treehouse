<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory;
    // use Sluggable;

    // protected $primaryKey = 'category_id';
    // protected $keyType = 'string';
    protected $guarded = [];

    public function products() {
        return $this->hasMany('App\Models\Product', 'category_id', 'category_id');
    }
    
    public function childs()
    {
        return $this->hasMany('App\Models\Category', 'parent_id', 'category_id');
    }
    // Выгружаем из responce json (из тз 1с) в бд, проверяем изменения. Если надо добавляем новые записи.
}
