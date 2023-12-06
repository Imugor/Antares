<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $casts = [
        // 'geoposition' => 'json',
    ];

    public function vacancies() {
        return $this->hasMany(Vacancy::class, 'contacts_id', 'id');
    }
}
