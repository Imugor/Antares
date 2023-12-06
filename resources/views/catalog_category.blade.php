@extends('layouts.app')

@section('title'){{$category->name}}@endsection

@section('container')
<section class="category">
    <div class="wrapper">
      <div class="category__category-content category-content">
        <div class="category-content__breadcrumb">
        @include('inc.breadcrumbs')
        </div>
        <h2 class="category-content__title title">{{$category->name}}</h2>
        <div class="category-content__category-list category-list">

          <form action="{{route('catalog_category', ['slug' => $category->slug, 'page' => 1])}}" class="category-list__category-aside category-aside">
            @if (isset($_GET['order']))
            <input type="hidden" name="order" value="{{$_GET['order']}}">
            @endif
            <div class="category-aside__wrapper">
              <p class="category-aside__close">{{$category->name}}</p>
              {{-- <div class="category-aside__category-settings category-settings">
                <h3 class="category-settings__title">Цена ₽</h3>
                <div class="category-settings__price_low category-settings__price">
                  <p>от:</p><input type="text" placeholder="1000" name="low_price" value="{{$_GET['low_price'] ?? ''}}">
                </div>
                <div class="category-settings__price_hight category-settings__price">
                  <p>до:</p><input type="text" placeholder="10000" name="hight_price" value="{{$_GET['hight_price'] ?? ''}}">
                </div>
              </div> --}}
              {!!$filters_html!!}
              @if ($filters_html != '')
              <input type="submit" class="category-aside__submit button" value="Применить">
              @endif

            </div>
          </form>
          <div class="category-list__category-list-content category-list-content">
            <form action="{{route('catalog_category', ['slug' => $category->slug, 'page' => 1] + $_GET)}}" method="GET" class="category-list__category-top-settings category-top-settings">
              <p class="category-top-settings__count">Кол-во товаров: {{$items_count}}</p>
              <p class="category-top-settings__filtr">Фильтр</p>
              <div class="category-top-settings__select-list select-list">
                <h3 class="select-list__title">{{$order_name}}</h3>
                <div class="select-list__content">
                  <input type="radio" class="select-list__select-input" name="order" value="popular" id="1">
                  <label for="1" class="select-list__select-label">Популярное</label>
                  <input type="radio" class="select-list__select-input" name="order" value="price_asc" id="2">
                  <label for="2" class="select-list__select-label">Сначала дешевые</label>
                  <input type="radio" class="select-list__select-input" name="order" value="price_desc" id="3">
                  <label for="3" class="select-list__select-label">Сначала дорогие</label>
                </div>
              </div>
            </form>
            <div class="category-list-content__grid">
                @foreach ($items as $item)
                <div class="category-list-content__category-cell category-cell">
                  <a href="{{route('product', ['category_slug' => $item->category->slug, 'product_slug' => $item->slug])}}" class="catalog-cell__link"><img src="{{asset('storage/'.($item->images->first()->path ?? 'noimage.png'))}}" alt="{{$item->name}}"
                      class="category-cell__img"></a>
                  <div class="category-cell__flex-element flex-element">
                    <div class="flex-element__top">
                    <a href="{{route('product', ['category_slug' => $item->category->slug, 'product_slug' => $item->slug])}}" class="catalog-cell__link">
                      <p class="category-cell__articul">Арт: {{$item->id}}</p>
                    </a>
                    <a href="{{route('product', ['category_slug' => $item->category->slug, 'product_slug' => $item->slug])}}" class="catalog-cell__link">
                      <p class="category-cell__name" data-item="name">{{$item->name}}</p>
                    </a>
                  </div>
                  <div class="flex-element__bottom">
                    <button class="category-cell__button button pop-up-start" data-popUp="order">Заказать
                    </button>
                  </div>
                  </div>
                </div>
                @endforeach
                @if ($items_count > 0)
                <div class="category-list-content__category-pagination category-pagination">
                  @if ($page == 1)
                  <div class="category-pagination__arrow category-pagination__arrow_first"><a></a></div>
                  <div class="category-pagination__arrow category-pagination__arrow_prev"><a></a></div>
                  @else
                  <div class="category-pagination__arrow category-pagination__arrow_first"><a href="{{route('catalog_category', ['slug' => $category->slug, 'page' => 1] + $_GET)}}"></a></div>
                  <div class="category-pagination__arrow category-pagination__arrow_prev"><a href="{{route('catalog_category', ['slug' => $category->slug, 'page' => $page-1] + $_GET)}}"></a></div>
                  @endif
                  <div class="category-pagination__page">
                      @foreach ($pages as $item)
                          @if ($page == $item)
                          <a href="{{route('catalog_category', ['slug' => $category->slug, 'page' => $item] + $_GET)}}" class="category-pagination__link category-pagination__link_active">{{$item}}</a>
                          @elseif ($page != $item)
                          <a href="{{route('catalog_category', ['slug' => $category->slug, 'page' => $item] + $_GET)}}" class="category-pagination__link">{{$item}}</a>
                          @endif
                      @endforeach
                  </div>
                  @if ($page == $max_page)
                  <div class="category-pagination__arrow category-pagination__arrow_next"><a></a></div>
                  <div class="category-pagination__arrow category-pagination__arrow_last"><a></a></div>
                  @else
                  <div class="category-pagination__arrow category-pagination__arrow_next"><a href="{{route('catalog_category', ['slug' => $category->slug, 'page' => $page+1] + $_GET)}}"></a></div>
                  <div class="category-pagination__arrow category-pagination__arrow_last"><a href="{{route('catalog_category', ['slug' => $category->slug, 'page' => $max_page] + $_GET)}}"></a></div>
                  @endif
                </div>
                @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection