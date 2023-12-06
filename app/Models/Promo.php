<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    public function getOnlyAllowed() {
        return Promo::where('show', '=', '1')->get();
    }

    public function nameWithoutTags(): Attribute {
        return Attribute::make(
            get: (fn() => preg_replace('/<(?!br).*?>/si', ' ', $this->name))
        );
    }
    
    public static function boot(): void
    {
        parent::boot();

        static::deleting(function ($item) {
            $settings = Setting::first();
            $settings->index_promo = array_diff((array)json_decode($settings->index_promo) ?? [], [$item->id]);
            $settings->save();
        });
    }
}
