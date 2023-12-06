<?php

namespace App\Http\Controllers;

use App\Filters\ProductFilter;
use App\Models\Category;
use App\Models\CharacteristicProduct;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{

    public function catalog(){
        $page_settings = $this->pageSettings([
            'Каталог' => route('catalog'),
        ]);

        $catalog_parents = Category::getParentsWithChilds();
        $catalog = [];
        foreach($catalog_parents as $catalog_parent){
            $catalog[] = $catalog_parent;
        }

        return view('catalog', [
            'page_settings' => $page_settings,
            'catalog' => $catalog,
        ]);
    }

    public function catalogCategoryNoPage($slug){
        return Redirect::route('catalog_category', ['slug' => $slug, 'page'=> 1] + $_GET);
    }

    public function categoryPlug($slug) {
        $category = Category::where('slug', $slug)->first();
        $page_settings = $this->pageSettings($this->getCategoryBreadcrumbs($category));
        $partners = $category->getPartners();

        $settingsPage = Setting::first();
        $settings = [
            'title' => $settingsPage->category_slug_title,
            'description' => $settingsPage->category_slug_description,
        ];

        return view('plug_partners', [
            'page_settings' => $page_settings,
            'settings' => $settings,
            'category' => $category,
            'partners' => $partners,
        ]);
    }

    public function catalogCategory(ProductFilter $req, $slug, $page=null) {
        if (Setting::first()->category_plug) 
            return Redirect::route('category_plug', ['slug'=> $slug]);

        $category = Category::where('slug', $slug)->first();
        $page_settings = $this->pageSettings($this->getCategoryBreadcrumbs($category));
        $items_on_page = 6;

        // dd($_GET);
        $categories_array = [];
        $categories_array[] = $category->id;
        foreach($category->childs as $child){
            $categories_array[] = $child->id;
        }

        $items = $this->getItems($category, $categories_array);
        $items = $this->sortItems($items);

        $items_count = $items->count();
        $max_page = ceil($items_count / $items_on_page);
        if ($max_page == 0) {
            $max_page = 1;
        }
        if ($page < 1) {
            return Redirect::route('catalog_category', ['slug' => $slug,'page'=> 1] + $_GET);
        }
        if ($page > $max_page) {
            return Redirect::route('catalog_category', ['slug' => $slug,'page'=> $max_page] + $_GET);
        }

        $breadcrumbs = $this->getCategoryBreadcrumbs($category);

        $pages = [];
        for($i = $page-2; $i <= $page+2; $i++) {
            if ($i < 1) continue;
            if ($i > $max_page) continue;
            $pages[] = $i;
        }

        $filters_html = $this->getInputFilters($category);

        $order_name = $this->getOrderName();
        
        return view('catalog_category', [
            'page_settings'=> $page_settings,
            'breadcrumbs' => $breadcrumbs,
            'category' => $category,
            'filters_html' => $filters_html,
            'items_count' => $items_count,
            'items' => $items,
            'page' => $page,
            'pages' => $pages,
            'max_page' => $max_page,
            'order_name' => $order_name,
        ]);
    }

    private function getItems($category, $categories_array) {
        $query = Product::query();
        $characs = $this->getCharacs($category);
        

        $category_id = $category->id;
        $products = Product::query();
        $products->whereIn('category_id', $categories_array);
        
        foreach ($characs as $c) {
            if ($c->type == 'int' || $c->type == 'float') {
                if (isset($_GET[$c->slug."_low"]) && $_GET[$c->slug."_low"] != '') {
                    $products->whereHas('characteristic', function($query) use ($c) {
                        $query->where('slug', $c->slug)->where('value', '>=', $_GET[$c->slug."_low"]);
                    });
                }
                if (isset($_GET[$c->slug."_hight"]) && $_GET[$c->slug."_hight"] != '') {
                    $products->whereHas('characteristic', function($query) use ($c) {
                        $query->where('slug', $c->slug)->where('value', '<=', $_GET[$c->slug."_hight"]);
                    });
                }
            }
            else if ($c->type == 'string') {
                if (isset($_GET[$c->slug]) && $_GET[$c->slug] != []) {
                    $products->whereHas('characteristic', function($query) use ($c) {
                        $query->where('slug', $c->slug)
                        ->whereIn('value', $_GET[$c->slug]);
                    });
                }
            }
        }

        return $products->with('category')->get();
    }

    private function sortItems($items) {
        if (!isset($_GET['order']))
            return $items->sortBy('number_of_visit', descending: true);;
        if ($_GET['order'] == 'popular')
            return $items->sortBy('number_of_visit', descending: true);
        if ($_GET['order'] == 'price_asc')
            return $items->sortBy('price');
        if ($_GET['order'] == 'price_desc')
            return $items->sortBy('price', descending: true);
        return $items->sortBy('number_of_visit', descending: true);;

    }

    private function getOrderName() {
        if (!isset($_GET['order']))
            return 'Популярное';
        if ($_GET['order'] == 'popular')
            return 'Популярное';
        if ($_GET['order'] == 'price_asc')
            return 'Сначала дешевые';
        if ($_GET['order'] == 'price_desc')
            return 'Сначала дорогие';
        return 'Популярное';
    }

    private function getInputFilters($category) {
        $characs = $this->getCharacs($category);
        $html = '';
        foreach ($characs as $c) {
            if ($c->type == 'int' || $c->type == 'float') {
                $html .= $this->numberFilter($c, $category);
            }
            else if ($c->type == 'string') {
                $html .= $this->stringFilter($c, $category);
            }
        }
        return $html;
    }

    private function getCharacs($category) {
        $characs = [];
        if ($category->category_id != null) {
            foreach ($category->parent->characteristic as $c) {
                $characs[] = $c;
            }
        }
        foreach ($category->characteristic as $c) {
            $characs[] = $c;
        }
        return $characs;
    }

    private function stringFilter($characteristic, $category) {
        $items_ids = [];
        foreach($category->getProducts() as $product) {
            $items_ids[] = $product->id;    
        }
        $characteristicProduct = CharacteristicProduct::select('value')
            ->where('characteristic_id', $characteristic->id)
            ->whereIn('product_id', $items_ids)
            ->get()->toArray();
        $variants = [];
        foreach ($characteristicProduct as $product) {
            $variants[] = $product['value'];
        }
        $variants = array_unique($variants);
        $html = '<div class="category-aside__category-settings category-settings">';
        $html .= '<h3 class="category-settings__title">'.$characteristic->name.' '.$characteristic->unit.'</h3>';
        $html .= '<div class="category-settings__choose">';
        foreach($variants as $variant) {
            $html .= '<div class="category-settings__checkbox">';
            $html .= '<input';
            $html .= (in_array($variant, $_GET[$characteristic->slug] ?? [])) ? ' checked' : '';
            $html .= ' type="checkbox" name="'.$characteristic->slug.'[]" value="'.$variant.'" id="'.$characteristic->slug.$variant.'">';
            $html .= '<label for="'.$characteristic->slug.$variant.'">'.$variant.'</label>';
            $html .= '</div>';
        }
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

    private function numberFilter($characteristic, $category) {
        $items_ids = [];
        foreach($category->getProducts() as $product) {
            $items_ids[] = $product->id;    
        }
        $characteristicProduct = CharacteristicProduct::select('value')
            ->where('characteristic_id', $characteristic->id)
            ->whereIn('product_id', $items_ids)
            ->get();

        $min = $characteristicProduct->min()->value;
        $max = $characteristicProduct->max()->value;

        $html = '<div class="category-aside__category-settings category-settings">';
        $html .= '<h3 class="category-settings__title">'.$characteristic->name.' '.$characteristic->unit.'</h3>';
        $html .= '<div class="category-settings__price_low category-settings__price">';
        $html .= '<p>от:</p><input type="text" placeholder="'.$min.'" name="'.$characteristic->slug.'_low" value="'.($_GET[$characteristic->slug.'_low'] ?? '').'">';
        $html .= '</div>';
        $html .= '<div class="category-settings__price_hight category-settings__price">';
        $html .= '<p>до:</p><input type="text" placeholder="'.$max.'" name="'.$characteristic->slug.'_hight" value="'.($_GET[$characteristic->slug.'_hight'] ?? '').'">';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

    public function product($category_slug, $product_slug) {
        $category = Category::where('slug', $category_slug)->first();
        $product = Product::where('slug', $product_slug)->with('images')->with('characteristic')->first();
        $product->number_of_visit += 1;
        $product->save();
        // dd($product);

        if ((!$category || !$product) || ($product->category_id != $category->id)) {
            abort(404);
        }

        $page_settings = $this->pageSettings($this->getCategoryBreadcrumbs($category) + [
            $product->name =>route('product', ['category_slug' => $category->slug, 'product_slug'=> $product->slug]),
        ]);

        return view('product', [
            'page_settings' => $page_settings,
            'product' => $product,
        ]);
    }

    private function getCategoryBreadcrumbs(Category $category){
        if ($category->category_id == null) {
            return [
                'Каталог' => route('catalog'),
                $category->name => route('catalog_category', ['slug' => $category->slug, 'page' => 1]),
            ];
        }
        return [
            'Каталог' => route('catalog'),
            $category->parent->name => route('catalog_category', ['slug' => $category->parent->slug, 'page' => 1]),
            $category->name => route('catalog_category', ['slug' => $category->slug, 'page' => 1]),
        ];
    }

    private function getArrayPagination($page, $max_page) {
        $pages = [];
        $correction_end = 0;
        for($i = $page-1; $i <= $page+1+$correction_end; $i++) {
            if ($i == 0) {
                $correction_end += 1;
                continue;
            }
            if ($i > $max_page) {
                break;
            }
            $pages[] = $i;
        }
        return $pages;
    }
}
