<?php

use App\Http\Controllers\BitrixController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Controller::class, 'index'])->name('index');
Route::get('/our-mission', [Controller::class, 'our_mission'])->name('our_mission');
Route::get('/about-company', [Controller::class, 'about_company'])->name('about_company');
Route::get('/vacancies', [Controller::class, 'vacancies'])->name('vacancies');

Route::get('/articles', [Controller::class, 'articles'])->name('articles');
Route::get('/articles/{slug}', [Controller::class, 'article'])->name('article');

Route::get('/news', [Controller::class, 'news'])->name('news');
Route::get('/news/{slug}', [Controller::class, 'novelty'])->name('novelty');

Route::get('/stocks', [Controller::class, 'stocks'])->name('stocks');
Route::get('/stocks/{slug}', [Controller::class, 'stock'])->name('stock');

Route::get('/partners', [Controller::class, 'partners'])->name('partners');

Route::get('/contacts', [Controller::class, 'contacts'])->name('contacts');

Route::get('/catalog', [ProductController::class, 'catalog'])->name('catalog');
Route::get('/catalog/{slug}/{page}', [ProductController::class, 'catalogCategory'])->name('catalog_category');
Route::get('/catalog/{slug}', [ProductController::class, 'catalogCategoryNoPage'])->name('catalog_category_no_page');
Route::get('/catalog/{category_slug}/product/{product_slug}', [ProductController::class,'product'])->name('product');
Route::get('/partners/{slug}', [ProductController::class,'categoryPlug'])->name('category_plug');

Route::get('/reviews', [Controller::class, 'reviews'])->name('reviews');
Route::post('/reviews/add', [Controller::class, 'reviewsAdd'])->name('reviews_add');

Route::post('/replace-city', [Controller::class, 'replaceCity'])->name('replace_city');
Route::post('/add-lead', [BitrixController::class, 'addLead'])->name('add_lead');
Route::post('/add-summary', [Controller::class, 'addSummary'])->name('add_summary');
Route::post('/add-resume', [BitrixController::class, 'addResume'])->name('add_resume');
