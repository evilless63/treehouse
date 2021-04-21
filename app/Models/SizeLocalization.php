<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Size;

class SizeLocalization extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['lang', 'title'];
    /**
     * @return BelongsTo
     */
    public function color()
    {
        return $this->belongsTo(Size::class);
    }
}
