<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Exception;
use MoonShine\Fields\Image;
use MoonShine\Fields\Text;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\HasMany;
use MoonShine\Fields\NoInput;
use MoonShine\Fields\Slug;
use MoonShine\Fields\TinyMce;
use MoonShine\QueryTags\QueryTag;

class CategoryResource extends Resource
{
	public static string $model = Category::class;

	public static string $title = 'Категории';

    public string $titleField = 'name';

    public static string $orderType = 'DESC';

    public bool $createInModal = True;

	public function fields(): array
	{
		return [
            Grid::make('', [
                Column::make('', [
                    Block::make('Основная информация', [
                        ID::make()->sortable(),
            
                        BelongsTo::make('Родительская категория', 'parent', fn($item) => $item ? $item->name : "-")
                            ->nullable()
                            ->searchable()
                            ->hideOnDetail()
                            ->hideOnIndex()
                            ->valuesQuery(fn($query) => $query->where('category_id', '=', null)),
            
                        Text::make('Название', 'name')
                            ->required(),
            
                        TinyMce::make('Описание', 'description')
                            ->default('Описание')
                            ->required()
                            ->hideOnIndex(),
                        
                        NoInput::make('Родительская категория', '', function ($item) {
                            try {
                                if ($item->category_id != null) {
                                    $temp = $item->parent->name;
                                    return $item->parent->name;
                                }
                                return "Родительская категория";
                            }
                            catch (Exception) {
                                return 'Удаленная родительская категория';
                            }
                        })
                            ->badge(function ($item) {
                                try {
                                    if ($item->category_id != null) {
                                        $temp = $item->parent->name;
                                        return 'green';
                                    }
                                    return 'blue';
                                }
                                catch (Exception) {
                                    return 'red';
                                }
                            })
                            ->hideOnUpdate()
                            ->hideOnCreate(),

                    ]),
                ])->columnSpan(7),
                Column::make('', [
                    Block::make('Дополнительная информация', [
                        Image::make('Обложка', 'bg_image_path')
                            ->dir('images/categories')
                            ->disableDeleteFiles(),
                        Image::make('Логотип', 'logo_image_path')
                            ->dir('images/categories')
                            ->disableDeleteFiles(),
                        Slug::make('Slug', 'slug')
                            ->from('name')
                            ->separator('-')
                            ->unique(),
                        

                    ]),
                ])->columnSpan(5),
            ]),

            HasMany::make('Характеристика товара', 'characteristic', new CharacteristicResource())
                ->resourceMode()
                ->hideOnIndex(),
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

    public function queryTags(): array
    {
        $tags = [];

        $tags[] = QueryTag::make(
            'Все категории',
            fn($query) => $query,
        );

        $tags[] = QueryTag::make(
            'Родительские категории',
            fn($query) => $query->whereNull('category_id'),
        );

        foreach(Category::all()->where('category_id', '=', null) as $item) {
            $tags[] = QueryTag::make(
                $item->name,
                fn($query) => $query->where('category_id', '=', $item->id),
            );
        }

        return $tags;
    }

    public function filters(): array
    {
        return [

        ];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }

    protected function afterSave(Model $model)
    {
        $model->name = $model->name . '1';
    }
}
