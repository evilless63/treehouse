<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Color;

class ColorLocalization extends Model
{
    use HasFactory;

    protected $fillable = ['lang', 'title'];
    public $timestamps = false;
    /**
     * @return BelongsTo
     */
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
