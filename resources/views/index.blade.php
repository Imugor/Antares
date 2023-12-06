@extends('layouts.app')

@section('title')Antares @endsection

@section('container')
    @include('inc.index.main_banner')

    @include('inc.index.about_company')

    @include('inc.index.popular_categories')

    @include('inc.index.promo_slider')

    @include('inc.index.projects')

    @include('inc.index.reviews')

    @include('inc.index.partners')

    @include('inc.index.feedback')
@endsection