<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'category_id', 'partner_id', 'name', 'description', 'price', 'slug', 'created_at', 'updated_at', 'characteristics'
    ];
    
    public function images() {
        return $this->hasMany(ImageProduct::class, 'product_id', 'id')->orderBy('position');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function partner() {
        return $this->belongsTo(Partner::class, 'partner_id', 'id');
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter) {
        return $filter->apply($builder);
    }

    public function characteristic() {
        return $this->belongsToMany(Characteristic::class, CharacteristicProduct::class, 'product_id', 'characteristic_id', 'id', 'id')
            ->withPivot('value');
    }

    public function characteristicProduct() {
        return $this->hasMany(CharacteristicProduct::class, 'product_id', 'id');
    }
    
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            $product->images()->delete();
            $product->characteristicProduct()->delete();
        });
    }
}
