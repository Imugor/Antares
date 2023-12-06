@extends('layouts.app')

@section('title'){{ $article->name }}@endsection

@section('container')
    <section class="company-info">
        <div class="company-info__company-info-content company-info-content">
        <div class="head-of-page">
            <picture><source srcset="{{asset('storage/'.$article->bg_image_path)}}" type="image/webp"><img src="{{asset('storage/'.$article->bg_image_path)}}" alt="" class="head-of-page__img"></picture>
            <div class="wrapper head-of-page__wrapper">
                <div class="head-of-page__breadcrumb">
                    @include('inc.breadcrumbs')
                 </div>
                <h2 class="head-of-page__title">{{ $article->name }}</h2>
                {{-- {!! $article->description !!} --}}
            </div>
        </div>
        <div class="wrapper">
            <div class="company-info-content__company-info-text company-info-text">
                {!! $article->content !!}
            </div>
        </div>
        </div>
    </section>
@endsection