@extends('layouts.app')

@section('title'){{$product->name}}@endsection

@section('container')
<section class="item">
    <div class="wrapper">
      <div class="item__item-content item-content">
        <div class="item-content__breadcrumb">
            @include('inc.breadcrumbs')
        </div>
        <div class="item-content__brief brief">
          <div class="brief__brief-slider brief-slider">
            <div class="brief-slider__brief-aside brief-aside">
              <div class="brief-aside__arrow brief-aside__arrow_top"></div>
              <div class="brief-aside__wrapper">

                {{-- <?php dd($product->images->count()); ?> --}}
                @if ($product->images->count() > 0)
                    @foreach ($product->images as $image)
                        <picture><img src="{{asset('storage/'.$image->path)}}" alt="{{$product->name}}" class="brief-aside__img"></picture>
                    @endforeach
                @else
                    <picture><img src="{{asset('storage/noimage.png')}}" alt="{{$product->name}}" class="brief-aside__img"></picture>
                @endif

                <div class="brief-aside__arrow brief-aside__arrow_bottom"></div>
              </div>
            </div>
            <div class="brief-slider__brief-slider-content swiper">
              <div class="brief-slider__wrapper swiper-wrapper">
                @if ($product->images->count() > 0)
                    @foreach ($product->images as $image)
                        <div class="brief-slider__brief-slide brief-slide swiper-slide">
                            <picture><img src="{{asset('storage/'.$image->path)}}" alt="{{$product->name}}" class="brief-slide__img"></picture>
                        </div>
                    @endforeach
                @else
                    <div class="brief-slider__brief-slide brief-slide swiper-slide">
                        <picture><img src="{{asset('storage/noimage.png')}}" alt="{{$product->name}}" class="brief-slide__img"></picture>
                    </div>
                @endif

              </div>
            </div>
            <div class="brief-slider__pagination swiper-pagination"></div>
          </div>
          <div class="brief__info">
            <div class="brief__main-info">
              <p class="brief__articul">Арт. {{$product->id}}</p>
              <h1 class="brief__title title" data-item="name">{{$product->name}}</h1>
              <button class="brief__button button pop-up-start" data-popUp="order">Заказать</button>
            </div>
            <div class="brief__info-content ">
              <div class="brief__info-item info-item">
                <p>Название</p>
                <p>{{$product->name}}</p>
              </div>
              @foreach ($product->characteristic as $item)
              <div class="brief__info-item info-item">
                <p>{{$item->name}}</p>
                <p>{{$item->pivot->value}} {{$item->unit}}</p>
              </div>
              @endforeach
            </div>
            <div class="brief__info-content">
              <h3 class="brief__subtitle">Доступно для заказа</h3>
              <div class="brief__info-item info-item">
                <p>Самовывоз</p>
                <p>Бесплатно</p>
              </div>
              <div class="brief__info-item info-item">
                <p>Доставка</p>
                <p>от 250 руб</p>
              </div>
            </div>
          </div>
        </div>
        <div class="item-content__item-description item-description">
          <h2 class="item-description__title title">Описание</h2>
          <div class="item-description__text">{!!$product->description!!}</div>
        </div>
        <div class="item-content__characties characties">
          <h2 class="characties__title title">Характеристика</h2>
          <div class="characties__content">
            <div class="brief__info-item info-item">
              <p>Название</p>
              <p>{{$product->name}}</p>
            </div>
            @foreach ($product->characteristic as $item)
            <div class="brief__info-item info-item">
              <p>{{$item->name}} </p>
              <p>{{$item->pivot->value}} {{$item->unit}}</p>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
</section>  
@endsection