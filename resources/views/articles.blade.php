@extends('layouts.app')

@section('title')Статьи@endsection

@section('container')
<section class="articles-list">
    <div class="wrapper">
       <div class="articles-list__article-list-content article-list-content">
         <div class="article-list-content__breadcrumb">
            @include('inc.breadcrumbs')
         </div>
          <h2 class="article-list-content__title title">Статьи</h2>
          <div class="article-list-content__articles-year articles-year"></div>
          <div class="article-list-content__article-list-singls article-list-singls">
            @foreach ($articles as $item)
            <a href="{{route('article', ['slug' => $item->slug])}}" class="article-list-singls__singl-article singl-article">
               <img src="{{asset('storage/'.$item->preview_image_path)}}" alt="" class="singl-article__img">
               <div class="singl-article__sub-info">
                  <p class="singl-article__date">{{ $item->date }}</p>
                  <p class="singl-article__time-to-read">
                     <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13" fill="none">
                        <path d="M6 10.5C7.06087 10.5 8.07828 10.0786 8.82843 9.32843C9.57857 8.57828 10 7.56087 10 6.5C10 5.43913 9.57857 4.42172 8.82843 3.67157C8.07828 2.92143 7.06087 2.5 6 2.5C4.93913 2.5 3.92172 2.92143 3.17157 3.67157C2.42143 4.42172 2 5.43913 2 6.5C2 7.56087 2.42143 8.57828 3.17157 9.32843C3.92172 10.0786 4.93913 10.5 6 10.5ZM6 1.5C6.65661 1.5 7.30679 1.62933 7.91342 1.8806C8.52005 2.13188 9.07124 2.50017 9.53553 2.96447C9.99983 3.42876 10.3681 3.97995 10.6194 4.58658C10.8707 5.19321 11 5.84339 11 6.5C11 7.82608 10.4732 9.09785 9.53553 10.0355C8.59785 10.9732 7.32608 11.5 6 11.5C3.235 11.5 1 9.25 1 6.5C1 5.17392 1.52678 3.90215 2.46447 2.96447C3.40215 2.02678 4.67392 1.5 6 1.5ZM6.25 4V6.625L8.5 7.96L8.125 8.575L5.5 7V4H6.25Z" fill="black"/>
                        </svg>
                     Время чтения: <span class="singl-article__time-to-read__bold"> {{$item->time_to_read}} минут</span></p>
               </div>
               <h3 class="singl-article__title">{{$item->name}}</h3>
               <p class="singl-article__info">{{$item->description}}</p>
            </a>
            @endforeach
          </div>
       </div>
    </div>
 </section>
@endsection