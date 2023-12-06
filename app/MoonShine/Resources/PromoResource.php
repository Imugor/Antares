<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Promo;

use MoonShine\Fields\Image;
use MoonShine\Fields\NoInput;
use MoonShine\Fields\Slug;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Divider;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Date;
use MoonShine\Fields\SwitchBoolean;
use MoonShine\Fields\Text;
use MoonShine\Fields\TinyMce;

class PromoResource extends Resource
{
	public static string $model = Promo::class;

	public static string $title = 'Акции';

	public function fields(): array
	{
		return [
            Grid::make('', [
                Column::make('', [
                    Block::make('Основная информация', [
                        ID::make()->sortable(),

                        NoInput::make('Название акции', 'name', fn($item) => preg_replace('/<(?!br).*?>/si', ' ', $item->name, )),

                        TinyMce::make('Название акции', 'name')
                            ->required()
                            ->hideOnIndex(),

                        Text::make('Описание', 'description')
                            ->required()
                            ->hideOnIndex(),

                        Image::make('Обложка на главной странице', 'bg_image_path')
                            ->dir('images/promo')
                            ->disableDeleteFiles()
                            ->hideOnIndex(),

                        Image::make('Превью акции', 'preview_image_path')
                            ->dir('images/promo')
                            ->disableDeleteFiles(),
                    ])
                ])->columnSpan(7),
                Column::make('', [
                    Block::make('Дополнительная информация', [

                        Block::make('Период действия акции', [
                            Date::make('Дата начала акции', 'promo_start')
                                ->default('now-15')
                                ->required(),
                            Date::make('Дата начала акции', 'promo_end')
                                ->default('now+5')
                                ->required(),
                        ]),

                        Date::make('Дата создания', 'created_at')
                            ->default('now-5')
                            ->withTime(),

                        SwitchBoolean::make('Опубликовать', 'show')
                            ->default(False),
                            
                        Slug::make('Человеко-понятный URL', 'slug')
                            ->from('nameWithoutTags')
                            ->separator('-')
                            ->unique(),
                    ])
                ])->columnSpan(5),
            ]),

            Divider::make(),

            TinyMce::make('Контент', 'content')
                ->required()
                ->hideOnIndex()
                ->hideOnDetail(),
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['name'];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }
}
