<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;

    protected $casts = [
        'requirements' => 'json',
        'conditions' => 'json',
    ];

    public function contact() {
        return $this->belongsTo(Contact::class, 'contact_id', 'id');
    }
}
