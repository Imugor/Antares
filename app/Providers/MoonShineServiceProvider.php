<?php

namespace App\Providers;

use App\Models\Review;
use App\MoonShine\Resources\ArticleResource;
use App\MoonShine\Resources\CategoryResource;
use App\MoonShine\Resources\CharacteristicProductResource;
use App\MoonShine\Resources\CharacteristicResource;
use App\MoonShine\Resources\ContactResource;
use App\MoonShine\Resources\NoveltyResource;
use App\MoonShine\Resources\PartnerResource;
use App\MoonShine\Resources\ProductResource;
use App\MoonShine\Resources\ProjectResource;
use App\MoonShine\Resources\PromoResource;
use App\MoonShine\Resources\ReviewResource;
use App\MoonShine\Resources\RewardResource;
use App\MoonShine\Resources\SettingResource;
use App\MoonShine\Resources\VacancyResource;
use App\MoonShine\Resources\VacancyPageResource;
use Illuminate\Support\ServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        app(MoonShine::class)->menu([
            MenuGroup::make('moonshine::ui.resource.system', [
                MenuItem::make('moonshine::ui.resource.admins_title', new MoonShineUserResource())
                    ->translatable()
                    ->icon('users'),
                MenuItem::make('moonshine::ui.resource.role_title', new MoonShineUserRoleResource())
                    ->translatable()
                    ->icon('bookmark'),
            ])->translatable(),
            
            MenuGroup::make('Управление товарами', [
                MenuItem::make('Категории', new CategoryResource())
                    ->icon('heroicons.rectangle-group'),
                MenuItem::make('Товары', new ProductResource())
                    ->icon('heroicons.tag'),
            ])->icon('heroicons.tag'),

            MenuGroup::make('Управление статьями', [
                MenuItem::make('Статьи', new ArticleResource())
                    ->icon('heroicons.newspaper'),
                MenuItem::make('Новости', new NoveltyResource())
                    ->icon('heroicons.newspaper'),
                MenuItem::make('Акции', new PromoResource())
                    ->icon('heroicons.newspaper'),
            ])->icon('heroicons.newspaper'),

            MenuGroup::make('Вакансии', [
                MenuItem::make('Вакансии', new VacancyResource())
                    ->icon('heroicons.document-text'),
                MenuItem::make('Страница вакансии', new VacancyPageResource())
                    ->icon('heroicons.wrench-screwdriver'),
            ])->icon('heroicons.document-text'),

            MenuGroup::make('Прочее', [
                MenuItem::make('Партнеры', new PartnerResource())
                    ->icon('heroicons.building-office-2'),
                MenuItem::make('Достижения', new RewardResource())
                    ->icon('heroicons.trophy'),
                MenuItem::make('Реализованные проекты', new ProjectResource())
                    ->icon('heroicons.rectangle-stack'),
                MenuItem::make('Контакты', new ContactResource())
                    ->icon('heroicons.identification'),
                MenuItem::make('Характеристики категорий', new CharacteristicResource())
                    ->icon('heroicons.wrench-screwdriver'),
                MenuItem::make('Характеристика-товар', new CharacteristicProductResource())
                    ->icon('heroicons.wrench-screwdriver'),
            ])->icon('heroicons.beaker'),

            MenuItem::make('Отзывы', new ReviewResource())
                ->icon('heroicons.chat-bubble-left-ellipsis')
                ->badge(fn() => Review::all()->where('show', '=', '0')->count()),

            MenuItem::make('Настройки', new SettingResource())
                ->icon('heroicons.wrench-screwdriver'),
        ]);
    }
}
