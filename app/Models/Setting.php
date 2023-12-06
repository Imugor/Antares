<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $casts = [
        'index_banner' => 'json',
        'vacancy_advantage' => 'json',
    ];
}
