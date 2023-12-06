<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    
    public static function boot(): void
    {
        parent::boot();

        static::deleting(function ($item) {
            $settings = Setting::first();
            $settings->index_partners = array_diff((array)json_decode($settings->index_partners) ?? [], [$item->id]);
            $settings->save();

            foreach(Product::where('partner_id', $item->id)->get() as $product) {
                $product->partner_id = null;
                $product->save();
            }
        });
    }
}
