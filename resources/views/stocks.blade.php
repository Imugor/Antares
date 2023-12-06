@extends('layouts.app')

@section('title')Акции @endsection

@section('container')
<section class="stocks-list">
    <div class="wrapper">
       <div class="stocks-list__stocks-list-content stocks-list-content">
        <div class="stocks-list-content__breadcrumb breadcrumb">
        @include('inc.breadcrumbs')
        
        </div>
          <h2 class="stocks-list-content__title title">Акции</h2>
          <div class="stocks-list-content__stocks-cells stocks-cells">
            @foreach ($stocks as $item)
              <a href="{{route('stock', ['slug' => $item->slug])}}">
                  <div class="stocks-cells__stocks-cell stocks-cell">
                  <img src="{{asset('storage/'.$item->preview_image_path)}}" alt="" class="stocks-cell__img">
                  <p class="stocks-cell__time">
                      <span>{{$item->start}}</span> <span>-</span> <span>{{$item->end}}</span>
                  </p>
                  {{-- <h3 class="stocks-cell__text">При покупке на сайте <span class="stocks-cell__text_bold">Скидка 35%</span> на весь ассортимент</h3> --}}
                  <div class="stocks-cell__text">{!!$item->name!!} </div>
                  </div>
                </a>
            @endforeach
          </div>
       </div>
    </div>
 </section>
@endsection