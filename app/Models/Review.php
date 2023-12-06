<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public function getOnlyAllowed() {
        return Review::where('show', '=', '1')->get();
    }
    
    public static function boot(): void
    {
        parent::boot();

        static::deleting(function ($item) {
            $settings = Setting::first();
            $settings->index_reviews = array_diff((array)json_decode($settings->index_reviews) ?? [], [$item->id]);
            $settings->save();
        });
    }
}
