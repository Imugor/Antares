@extends('layouts.app')

@section('title')Каталог товаров@endsection

@section('container')
<section class="catalog">
    <div class="wrapper">
        <div class="catalog__catalog-content catalog-content">
            <div class="catalog-content__breadcrumb">
            @include('inc.breadcrumbs')
            </div>
            <h2 class="catalog-content__title title">Каталог товаров</h2>
            <div class="catalog-content__catalog-list catalog-list">
                @foreach ($catalog as $parent)
                <div class="catalog-list__catalog-cell catalog-cell">
                    <a href="{{route('catalog_category', ['slug'=>$parent->slug, 'page'=>1])}}"><picture><source srcset="" type="image/webp"><img src="{{asset('storage/'.$parent->logo_image_path)}}" alt="" class="catalog-cell__img"></picture></a>
                    <ul class="catalog-cell__category category">
                        <li class="category__main-category"> <a href="{{route('catalog_category', ['slug'=>$parent->slug, 'page'=>1])}}">{{$parent->name}}</a></li>
                        @foreach ($parent->childs as $item)
                            <li class="category__sub-category"> <a href="{{route('catalog_category', ['slug'=>$item->slug, 'page'=>1])}}">{{$item->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection