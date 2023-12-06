@extends('layouts.app')

@section('title')Новости @endsection

@section('container')
<section class="news">
    <div class="wrapper">
        <div class="news__news-content news-content">
            <div class="news-content__breadcrumb">
            @include('inc.breadcrumbs')
            </div>
            <h2 class="news-content__title title">Новости</h2>
            <form action="{{route('news')}}" class="news-content__teg-select teg-select">
                <div class="teg-select__teg-select-list select-list">
                  <h3 class="select-list__title">{{$tag_name ?? 'Все'}}</h3>
                  <div class="select-list__content">
                    <input type="radio" class="select-list__select-input" id="3" value="all">
                    <label for="3" class="select-list__select-label">Все</label>
                    <input type="radio" class="select-list__select-input" id="0" value="news">
                    <label for="0" class="select-list__select-label">Новости</label>
                    <input type="radio" class="select-list__select-input" id="1" value="articles">
                    <label for="1" class="select-list__select-label">Статьи</label>
                    <input type="radio" class="select-list__select-input" id="2" value="stocks">
                    <label for="2" class="select-list__select-label">Акции</label>
                  </div>
                </div>
              </form>
            @if(isset($news) && $news != [])
            <div class="news-content__news-list news-list">
                @foreach ($news as $item)
                    <div class="news-list__news-cell  news-cell">
                        <a href="{{$item->href}}" class="news-cell__link">
                            <img src="{{asset('storage/'.$item->preview_image_path)}}" alt="" class="news-cell__img">
                        </a>
                        <a href="{{$item->href}}" class="news-cell__link">
                            <h3 class="news-cell__title">{{$item->name}}</h3>
                        </a>
                        <div class="news-cell__news-atribute news-atribute">
                            <p class="news-atribute__teg"># {{$item->tag}}</p>
                            <p class="news-atribute__date">{{$item->date}}</p>
                            <p class="news-atribute__time-to-read">
                                @if (isset($item->time_to_read))
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13" fill="none">
                                    <path d="M6 10.5C7.06087 10.5 8.07828 10.0786 8.82843 9.32843C9.57857 8.57828 10 7.56087 10 6.5C10 5.43913 9.57857 4.42172 8.82843 3.67157C8.07828 2.92143 7.06087 2.5 6 2.5C4.93913 2.5 3.92172 2.92143 3.17157 3.67157C2.42143 4.42172 2 5.43913 2 6.5C2 7.56087 2.42143 8.57828 3.17157 9.32843C3.92172 10.0786 4.93913 10.5 6 10.5ZM6 1.5C6.65661 1.5 7.30679 1.62933 7.91342 1.8806C8.52005 2.13188 9.07124 2.50017 9.53553 2.96447C9.99983 3.42876 10.3681 3.97995 10.6194 4.58658C10.8707 5.19321 11 5.84339 11 6.5C11 7.82608 10.4732 9.09785 9.53553 10.0355C8.59785 10.9732 7.32608 11.5 6 11.5C3.235 11.5 1 9.25 1 6.5C1 5.17392 1.52678 3.90215 2.46447 2.96447C3.40215 2.02678 4.67392 1.5 6 1.5ZM6.25 4V6.625L8.5 7.96L8.125 8.575L5.5 7V4H6.25Z" fill="black"/>
                                    </svg>
                                    Время чтения: <span class="head-of-article__time-to-read_bold"> {{$item->time_to_read}} минут</span>
                                @endif
                            </p>
                        </div>
                        <p class="news-cell__text">{{$item->description}}</p>
                    </div>
                @endforeach

            </div>
            @endif 
            @if(!(isset($news) || $news == []))
                <p class="news-atribute__date">Новостей пока нет</p>
            @endif
        </div>
    </div>
</section>
@endsection