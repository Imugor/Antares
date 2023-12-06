<?php

namespace App\MoonShine\Resources;

use App\Models\Category;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Promo;
use App\Models\Review;
use App\Models\Setting;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Divider;
use MoonShine\Decorations\Tab;
use MoonShine\Decorations\Tabs;
use MoonShine\Fields\Image;
use MoonShine\Resources\SingletonResource;
use MoonShine\Fields\ID;
use MoonShine\Fields\Json;
use MoonShine\Fields\Number;
use MoonShine\Fields\Select;
use MoonShine\Fields\SwitchBoolean;
use MoonShine\Fields\Text;

class SettingResource extends SingletonResource
{
	public static string $model = Setting::class;

	public static string $title = 'Setting';

    public function getId(): int|string
    {
        return 1;
    }

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),

            Block::make('Настройки страниц', [

                Tabs::make([
                    Tab::make('Главная страница', [

                        Json::make('Главный баннер', 'index_banner')
                            ->fields([
                                Text::make('Заголовок', 'title')
                                    ->required(),
                                Text::make('Описание', 'description')
                                    ->required(),
                                SwitchBoolean::make('Выводить кнопку', 'button')
                                    ->default(True),
                                Image::make('Картинка 1', 'image1')
                                    ->dir('images/index_banners')
                                    ->disableDeleteFiles(),
                                Image::make('Картинка 2', 'image2')
                                    ->dir('images/index_banners')
                                    ->disableDeleteFiles(),
                                Image::make('Картинка 3', 'image3')
                                    ->dir('images/index_banners')
                                    ->disableDeleteFiles(),
                            ])->removable()
                            ->fullPage(),

                        Number::make('Сколько лет работаем в сфере', 'index_years'),
        
                        Select::make('Популярные категории', 'index_popular_categories')
                            ->multiple()
                            ->searchable()
                            ->options(function() {
                                $array = [];
                                foreach(Category::all() as $item) {
                                    $array[$item->id] = $item->name;
                                }
                                return $array;
                            }
                        ),
        
                        Select::make('Акции', 'index_promo')
                            ->multiple()
                            ->searchable()
                            ->options(function() {
                                $array = [];
                                foreach(Promo::all() as $item) {
                                    $array[$item->id] = preg_replace('/<(?!br).*?>/si', ' ', $item->name, );
                                }
                                return $array;
                            }
                        ),
        
                        Select::make('Реализованные проекты', 'index_projects')
                            ->multiple()
                            ->searchable()
                            ->options(function() {
                                $array = [];
                                foreach(Project::all() as $item) {
                                    $array[$item->id] = $item->name;
                                }
                                return $array;
                            }
                        ),
        
                        Select::make('Отзывы', 'index_reviews')
                            ->multiple()
                            ->searchable()
                            ->options(function() {
                                $array = [];
                                foreach(Review::all() as $item) {
                                    $array[$item->id] = $item->rating.'☆ '.$item->text;
                                }
                                return $array;
                            }
                        ),
        
                        Select::make('Бренды', 'index_partners')
                            ->multiple()
                            ->searchable()
                            ->options(function() {
                                $array = [];
                                foreach(Partner::all() as $item) {
                                    $array[$item->id] = $item->name;
                                }
                                return $array;
                            }
                        ),
                    ]),

                    Tab::make('Вакансии', [
                        Text::make('Заголовок', 'vacancy_title'),

                        Text::make('Текст снизу', 'vacancy_description'),

                        Json::make('Преимущества', 'vacancy_advantage')
                            ->fields([
                                Image::make('Изображение', 'image_path')
                                    ->disableDeleteFiles()
                                    ->dir('images/advantages'),

                                Text::make('Преимущество', 'name'),

                                Text::make('Описание', 'description'),
                                
                                
                            ])
                            ->hideOnIndex()
                            ->removable(),
                    ]),

                    Tab::make('Каталог товаров', [
                        Block::make('Заглушка', [
                            SwitchBoolean::make('Показывать вместо каталога товаров Партнер-заглушку', 'category_plug'),

                            Text::make('Заголовок', 'category_slug_title')
                                ->required(),

                            Text::make('Описание', 'category_slug_description')
                                ->required(),
                        ]),
                    ]),
                ]),
            ]),

            Block::make('Подвал', [
                Text::make('Ссылка на телеграм', 'footer_link_tg'),
                Text::make('Ссылка на вконтакте', 'footer_link_vk'),
                Text::make('Ссылка на инстаграм', 'footer_link_inst'),
            ]),
        ];
	}

	public function rules(Model $item): array
    {
        return [];
    }
}
