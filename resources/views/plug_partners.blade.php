@extends('layouts.app')

@section('title'){{$category->name}}@endsection

@section('container')
<section class="partners-list">
    <div class="partners-list__partners-list-content partners-list-content">
       <div class="no-wrapper">
<div class="head-of-page">

  <picture><source srcset="{{asset('img/mission.webp')}}" type="image/webp"><img src="img/mission.jpg" alt="" class="head-of-page__img"></picture>
  <div class="wrapper head-of-page__wrapper">
    <div class="head-of-page__breadcrumb">
        @include('inc.breadcrumbs')
    </div>
    <h2 class="head-of-page__title">{{$settings['title']}}</h2>
    <p>{{$settings['description']}}</p>
  </div>
</div>
</div>

       <div class="wrapper">
          <div class="partners-list-content__product-block product-block">
              <h2 class="product-block__title title">{{$category->name}}</h2>
              <button class="product-block__button button">Заказать</button>
          </div>
          <div class="partners-list-content__partners-grid partners-grid">
            @foreach ($partners as $partner)
            <a href="{{$partner->link}}" class="partners-grid__partners-grid-cell partners-grid-cell">
               <picture><img src="{{asset('storage/'.$partner->image_path)}}" alt="" class="partners-grid-cell__img"></picture>
               <h3 class="partners-grid-cell__title">{{$partner->name}}</h3>
               <div class="partners-grid-cell__info">{!!$partner->description!!}</div>
            </a>
            @endforeach
          </div>
       </div>
    </div>
 </section>
@endsection