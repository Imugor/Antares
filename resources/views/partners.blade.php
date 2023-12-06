@extends('layouts.app')

@section('title')Наши партнеры@endsection

@section('container')
<section class="partners-list">
    <div class="partners-list__partners-list-content partners-list-content">
        <div class="head-of-page">
            <img src="img/mission.webp" alt="" class="head-of-page__img">
            <div class="wrapper head-of-page__wrapper">
               <div class="head-of-page__breadcrumb">
                  @include('inc.breadcrumbs')
               </div>
               <h2 class="head-of-page__title">Наши партнеры</h2>
            </div>
         </div>
       <div class="wrapper">
          <div class="partners-list-content__partners-grid partners-grid">
            @foreach ($partners as $item)
            <a href="{{$item->link}}" class="partners-grid__partners-grid-cell partners-grid-cell">
               <img src="{{asset('storage/'.$item->image_path)}}" alt="" class="partners-grid-cell__img">
               <div class="partners-grid-cell__info">
                  <picture><h3 class="partners-grid-cell__title">{{$item->name}}</h3></picture>
                  <div class="partners-grid-cell__info">{!!$item->description!!}</div>
               </div>
            </a>
            @endforeach
          </div>
       </div>
    </div>
 </section>
@endsection