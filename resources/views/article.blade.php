@extends('layouts.app')

@section('title'){{ $article->name }}@endsection

@section('container')
<section class="article-info">
    <div class="article-info__article-info-content">
       <div class="head-of-article">
 <img src="{{ asset('storage/'.$article->bg_image_path) }}" alt="" class="head-of-article__img">
 <div class="wrapper head-of-article__wrapper">
   <div class="head-of-article__breadcrumb">
      @include('inc.breadcrumbs')
   </div>
    <h2 class="head-of-article__title">{{$article->name}}</h2>
    <p class="head-of-article__date">{{$article->date}}</p>
    <p class="head-of-article__time-to-read">
      @if (isset($article->time_to_read))
       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
          <path d="M8.00016 13.334C9.41465 13.334 10.7712 12.7721 11.7714 11.7719C12.7716 10.7717 13.3335 9.41514 13.3335 8.00065C13.3335 6.58616 12.7716 5.22961 11.7714 4.22941C10.7712 3.22922 9.41465 2.66732 8.00016 2.66732C6.58567 2.66732 5.22912 3.22922 4.22893 4.22941C3.22873 5.22961 2.66683 6.58616 2.66683 8.00065C2.66683 9.41514 3.22873 10.7717 4.22893 11.7719C5.22912 12.7721 6.58567 13.334 8.00016 13.334ZM8.00016 1.33398C8.87564 1.33398 9.74255 1.50642 10.5514 1.84145C11.3602 2.17649 12.0951 2.66755 12.7142 3.28661C13.3333 3.90566 13.8243 4.64059 14.1594 5.44943C14.4944 6.25827 14.6668 7.12517 14.6668 8.00065C14.6668 9.76876 13.9644 11.4645 12.7142 12.7147C11.464 13.9649 9.76827 14.6673 8.00016 14.6673C4.3135 14.6673 1.3335 11.6673 1.3335 8.00065C1.3335 6.23254 2.03587 4.53685 3.28612 3.28661C4.53636 2.03636 6.23205 1.33398 8.00016 1.33398ZM8.3335 4.66732V8.16732L11.3335 9.94732L10.8335 10.7673L7.3335 8.66732V4.66732H8.3335Z" fill="white"/>
       </svg>
         Время чтения: <span class="head-of-article__time-to-read_bold"> {{$article->time_to_read}} минут</span>
       @endif
    </p>
 </div>
</div>

       <div class="wrapper">
         <ul class="article-info-content__article-contents article-contents" <?php if (isset($content_hidden)) echo 'hidden'; ?>>
            <li class="article-contents__title">Содержание</li>
            <li class="article-contents__links-conteiner">
              <ul class="article-contents__links">
                <!-- <li class="article-contents__link"><a>Что такое Lorem Ipsum?</a></li>
                <li class="article-contents__link"><a>Что такое Lorem Ipsum?</a></li> -->
              </ul>
            </li>
          </ul>
          <div class="article-info-content__article-info-text article-info-text">
            {!! $article->content !!}
          </div>
       </div>
    </div>
 </section>
@endsection