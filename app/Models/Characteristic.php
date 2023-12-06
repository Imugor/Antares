<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    use HasFactory;

    protected $fillable = [
        "id", "type", "unit", "slug", "category_id", "name",
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function ($item) {
            CharacteristicProduct::where('characteristic_id', $item->id)->delete();
        });
    }
}
