<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacteristicProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'product_id', 'characteristic_id', 'value', 'created_at', 'updated_at'
    ];

    protected $casts = [
        'value' => 'string',
    ];

    public function characteristic() {
        return $this->belongsTo(Characteristic::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
