<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'category_id', 'bg_image_path', 'logo_image_path', 'name', 'slug', 'description', 'created_at', 'updated_at', 'characteristics'
    ];

    protected $casts = [
        'characteristics' => 'json',
    ];

    public function parent() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function childs() {
        return $this->hasMany(Category::class, 'category_id', 'id');
    }

    public static function getParents() {
        return Category::where('category_id', '=', null)->get();
    }

    public static function getParentsWithChilds() {
        return Category::where('category_id', '=', null)->with('childs')->get();
    }

    public function characteristic() {
        return $this->hasMany(Characteristic::class,'category_id', 'id');
    }

    public function getPartners() {
        $category_ids = [$this->id];
        if ($this->parent_id == null) {
            foreach($this->childs as $child) {
                $category_ids[] = $child->id;
            }
        }
        return Product::whereIn('category_id', $category_ids)
                        ->whereNot('partner_id', null)
                        ->with('partner')
                        ->get()
                        ->pluck('partner')
                        ->unique();
    }

    public function products() {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function getProducts() {
        $category_ids = [$this->id];
        if ($this->parent_id == null) {
            foreach($this->childs as $child) {
                $category_ids[] = $child->id;
            }
        }
        return Product::whereIn('category_id', $category_ids)->get();
    }
    
    public static function boot(): void
    {
        parent::boot();

        static::deleting(function ($category) {
            $settings = Setting::first();
            $category->characteristic()->delete();
            Product::where('category_id', $category->id)->delete();
            if($category->category_id == null) {
                foreach($category->childs as $child) {
                    $settings->index_popular_categories = array_diff((array)json_decode($settings->index_popular_categories) ?? [], [$child->id]);
                    $child->characteristic()->delete();
                    foreach(Product::where('category_id', $child->id) as $item) {
                        $item->characteristic()->delete();
                        $item->characteristicProduct()->delete();
                        $item->delete();
                    }
                    $child->delete();
                }
            }
            $settings->index_popular_categories = array_diff((array)json_decode($settings->index_popular_categories) ?? [], [$category->id]);
            $settings->save();
            // $category->childs()->delete();
            // $category->characteristic()->delete();
            // $category->products()->delete();
        });
    }
    
}
