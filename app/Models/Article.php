<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends LocalizedModel
{
    use HasFactory;
    protected $guarded = ['localization'];
}
