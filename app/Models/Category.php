<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function products() {
        return $this->belongsToMany(Product::class);
    }
    
    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_id', 'category_id');
    }
    // Выгружаем из responce json (из тз 1с) в бд, проверяем изменения. Если надо добавляем новые записи.
}
