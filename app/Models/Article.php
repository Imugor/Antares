<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'content', 'preview_image_path', 'bg_image_path', 'time_to_read', 'show', 'slug', 'created_at', 'updated_at'
    ];

    public function getOnlyAllowed() {
        return Article::where('show', '=', '1')->get();
    }
}
