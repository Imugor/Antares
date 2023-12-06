<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    
    public static function boot(): void
    {
        parent::boot();

        static::deleting(function ($item) {
            $settings = Setting::first();
            $settings->index_projects = array_diff((array)json_decode($settings->index_projects) ?? [], [$item->id]);
            $settings->save();
        });
    }
}
