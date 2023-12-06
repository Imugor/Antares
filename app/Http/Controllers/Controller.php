<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Novelty;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Promo;
use App\Models\Review;
use App\Models\Reward;
use App\Models\Setting;
use App\Models\Vacancy;
use App\MoonShine\Resources\ReviewResource;
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use MoonShine\Notifications\MoonShineNotification;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index() {
        $page_settings = $this->pageSettings([]);

        $index_settings = Setting::first();

        $reviews = Review::whereIn('id', (array)json_decode($index_settings->index_reviews) ?? [])->get();
        $popular_categories = Category::whereIn('id', (array)json_decode($index_settings->index_popular_categories) ?? [])->get();
        $projects = Project::whereIn('id', (array)json_decode($index_settings->index_projects) ?? [])->get();
        $partners = Partner::whereIn('id', (array)json_decode($index_settings->index_partners) ?? [])->get();
        $promo = Promo::whereIn('id', (array)json_decode($index_settings->index_promo) ?? [])->get();
        
        foreach($promo as $p) {
            $p->name = preg_replace('/<(?!br).*?>/si', ' ', $p->name);
        }

        return view('index', [
            'page_settings' => $page_settings,
            'index_settings' => $index_settings,
            'reviews' => $reviews,
            'popular_categories' => $popular_categories,
            'promo' => $promo,
            'projects' => $projects,
            'partners' => $partners,
        ]);
    }

    public function replaceCity(Request $req) {
        $city = $req->city;
        session(['city' => $city]);

        return redirect()->back();
    }

    public function our_mission(){
        $page_settings = $this->pageSettings([
            'О нас' => '',
            'Наша миссия' => route('our_mission'),
        ]);
        $article = Article::all()->where('slug', '=', 'our-mission')->first();

        return view('company', [
            'page_settings' => $page_settings,
            'article' => $article,
        ]);
    }

    public function about_company(){
        $page_settings = $this->pageSettings([
            'О нас' => '',
            'О компании' => route('about_company'),
        ]);
        $article = Article::all()->where('slug', '=', 'about-company')->first();

        return view('company', [
            'page_settings' => $page_settings,
            'article' => $article,
        ]);
    }

    public function articles(){
        $page_settings = $this->pageSettings([
            'Полезно знать' => '',
            'Статьи' => route('articles'),
        ]);
        $articles = Article::all()->where('show', '=', true);

        foreach ($articles as $article) {
            $article->date = $this->format_date($article->created_at);
        }

        return view('articles', [
            'page_settings'=> $page_settings,
            'articles' => $articles,
        ]);
    }

    public function article(Request $request){
        $article = Article::all()->where('slug', '=', $request->slug)->first();
        $breadcrumbs = [];
        if ($article->show) {
            $breadcrumbs['Полезно знать'] = '';
            $breadcrumbs['Статьи'] = route('articles');
        }
        $page_settings = $this->pageSettings($breadcrumbs + [
            $article->name => route('article', ['slug' => $article->slug]),
        ]);

        if ($article == null) {
            abort(404);
        }

        return view('article', [
            'page_settings' => $page_settings,
            'article'=> $article,
        ]);
    }

    public function vacancies(){
        $settings = Setting::first();
        $page_settings = $this->pageSettings([
            'Вакансии' => route('vacancies'),
        ]);

        $advantages = [[], [], []];
        $sequence = [1, 0, 2];
        $i = 0;
        foreach (array_slice($settings->vacancy_advantage, 0, 6) ?? [] as $advantage) {
            $advantages[$sequence[$i++ % 3]][] = $advantage;
        }
        
        $vacancies = Vacancy::all();

        return view('vacancies', [
            'page_settings'=> $page_settings,
            'settings' => $settings,
            'vacancies' => $vacancies,
            'advantages' => $advantages,
        ]);
    }

    public function addSummary(Request $request){
        dd($request);
    }

    public function news() {
        $page_settings = $this->pageSettings([
            'Полезно знать' => '',
            'Новости' => route('news'),
        ]);

        $novelties = Novelty::all()->where('show', '=', true)->values()->all();
        foreach ($novelties as $novelties_article) {
            // $novelties_article->date = $this->format_date($novelties_article->created_at);
            $novelties_article->href = route('novelty', ['slug' => $novelties_article->slug]);
            $novelties_article->tag = 'Новости';
        }
        
        $articles = Article::all()->where('show', '=', true)->values()->all();
        foreach ($articles as $articles_article) {
            $articles_article->preview_image_path = $articles_article->bg_image_path;
            $articles_article->href = route('article', ['slug' => $articles_article->slug]);
            $articles_article->tag = 'Статья';
        }
        
        $stocks = Promo::all()->where('show', '=', true)->values()->all();
        foreach ($stocks as $stocks_article) {
            $stocks_article->href = route('stock', ['slug' => $stocks_article->slug]);
            $stocks_article->name = $stocks_article->nameWithoutTags;
            $stocks_article->tag = 'Акция';
        }

        if (!isset($_GET['teg'])) {
            $_GET['teg'] = 'all';
        }

        if ($_GET['teg'] == 'all') {
            $news = array_merge($novelties, $articles, $stocks);
            $tag_name = 'Все';
        } 
        else if ($_GET['teg'] == 'news') {
            $news = $novelties;
            $tag_name = 'Новости';
        }
        else if ($_GET['teg'] == 'articles') {
            $news = $articles;
            $tag_name = 'Cтатьи';
        }
        else if ($_GET['teg'] == 'stocks') {
            $news = $stocks;
            $tag_name = 'Акции';
        }


        function cmp($a, $b) {
            if ($a->created_at == $b->created_at) {
                return 0;
            }
            return ($a->created_at < $b->created_at) ? 1 : -1;
        }
        uasort($news, fn($a, $b) => cmp($a, $b));
        foreach($news as $article) {
            $article->date = $this->format_date($article->created_at);
        }

        return view('news', [
            'page_settings'=> $page_settings,
            'tag_name' => $tag_name,
            'news' => $news,
        ]);
    }

    public function novelty($slug) {
        $novelty = Novelty::query()->where('slug', $slug)->first();
        $page_settings = $this->pageSettings([
            'Новости' => route('news'),
            $novelty->name => route('novelty', ['slug' => $slug])
        ]);

        return view('article', [
            'page_settings'=> $page_settings,
            'article' => $novelty,
        ]);
    }

    public function stocks() {
        $page_settings = $this->pageSettings([
            'Полезно знать' => '',
            'Акции' => route('stocks'),
        ]);
        $stocks = Promo::all()->where('show', '=', true);

        foreach ($stocks as $stock) {
            $stock->date = $this->format_date($stock->created_at);
            $stock->start = $this->format_date(new Carbon($stock->promo_start));
            $stock->end = $this->format_date(new Carbon($stock->promo_end));
        }

        return view('stocks', [
            'page_settings'=> $page_settings,
            'stocks' => $stocks,
        ]);
    }

    public function stock($slug) {
        $stock = Promo::query()->where('slug', $slug)->first();
        $stock->name = $stock->nameWithoutTags;
        $stock->bg_image_path = $stock->preview_image_path;
        $page_settings = $this->pageSettings([
            'Акции' => route('stocks'),
            $stock->name => route('stock', ['slug'=> $slug])
        ]);

        $content_hidden = true;

        return view('article', [
            'page_settings'=> $page_settings,
            'article' => $stock,
            'content_hidden' => $content_hidden,
        ]);
    }

    public function reviews() {
        $page_settings = $this->pageSettings([
            'О нас' => '',
            'Отзывы' => route('reviews'),
        ]);
        $reviews = Review::orderBy('created_at', 'desc')->where('show', '=', true)->get();
        $reviews_array = [];

        $average_rating = 0.000000001;
        foreach ($reviews as $review) { 
            $reviews_array[] = $review;
            $average_rating += $review->rating;
        }

        $average_rating /= (float)$reviews->count() - 0.000000001;
        $average_rating = mb_substr((string)$average_rating, 0, 3);

        $awards = Reward::all();

        return view('reviews', [
            'page_settings'=> $page_settings,
            'reviews' => $reviews,
            'reviews_array' => $reviews_array,
            'average_rating' => $average_rating,
            'awards' => $awards,
        ]);
    }

    public function reviewsAdd(ReviewRequest $request) {
        $review = new Review();

        $review->fullname = $request->input('name').' '.$request->input('secondName');
        $review->number = $request->input('phone');
        $review->email = $request->input('email');
        $review->text = $request->input('message');
        $review->rating = $request->input('rating');
        $review->show = False;

        $review->save();

        MoonShineNotification::send(
            message: 'Добавлен новый отзыв от '.$review->fullname,
            button: [
                'link' => (new ReviewResource())->route('show', $review->id),
                'label' => 'Перейти на страницу с отзывом'
            ],

        );
        return [
            'code' => 0,
            'message' => 'Успех',
        ];

    }

    public function partners(){
        $page_settings = $this->pageSettings([
            'Партнеры' => route('partners'),
        ]);

        $partners = Partner::all();

        return view('partners', [
            'page_settings'=> $page_settings,
            'partners'=> $partners
        ]);

    }

    public function contacts(){
        $page_settings = $this->pageSettings([
            'О нас' => '',
            'Контакты' => route('contacts'),
        ]);

        return view('contacts', [
            'page_settings'=> $page_settings
        ]);
    }

    protected function getBreadcrumbsHTML($map_breadcrumbs) {
        $DELIMITER_HTML = '<p class="breadcrumb__delimiter">/</p>';
        $breadcrumbs = '';
        foreach ($map_breadcrumbs as $key => $value) {
            $breadcrumbs .= $DELIMITER_HTML;
            $breadcrumbs .= '<a href="'.$value.'" class="breadcrumb__link">'.$key.'</a>';
        }

        return $breadcrumbs;
    }

    protected function pageSettings($map_breadcrumbs){
        $contacts = Contact::all();
        try {
            if (session('city', null) == null) {
                $first_id = Contact::first()->id;
                session(['city' => $first_id]);
            }
            // $choose_contact = Contact::all()->where('id', '=', $_COOKIE['city'])->first();
            $choose_contact = $contacts->find(session('city'));
            if ($choose_contact == null) {
                $choose_contact = Contact::first();
                session(['city' => $choose_contact->id]);
            }
        } catch (Exception $e) {}

        $parent_categories = Category::getParents();
        $settings = Setting::first();

        $page_settings = [];
        $page_settings['links'] = [
            'vk' => $settings->footer_link_vk,
            'tg' => $settings->footer_link_tg,
            'inst' => $settings->footer_link_vk,
        ];
        $page_settings['contacts'] = $contacts;
        $page_settings['choose_contact'] = $choose_contact;
        $page_settings['parent_categories'] = $parent_categories;
        $page_settings['breadcrumbs'] = $this->getBreadcrumbsHTML($map_breadcrumbs);

        return $page_settings;
    }

    protected function format_date($date) {
        $month = [
            1 => 'января',
            2 => 'февраля',
            3 => 'марта',
            4 => 'апреля',
            5 => 'мая',
            6 => 'июня',
            7 => 'июля',
            8 => 'августа',
            9 => 'сентября',
            10 => 'октября',
            11 => 'ноября',
            12 => 'декабря',
        ];
        return $date->format('d').' '.$month[(int)$date->format('m')].' '.$date->format('Y');
    }
    
}
