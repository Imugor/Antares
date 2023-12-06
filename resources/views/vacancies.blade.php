@extends('layouts.app')

@section('title')Вакансии@endsection

@section('container')
<section class="vacancies">
    <div class="vacancies__vacancies-content">
       <div class="wrapper">
         <div class="vacancies-content__breadcrumb breadcrumbs">
         @include('inc.breadcrumbs')
         </div>
       </div>
       <div class="vacancies-content__advantages advantages">
          <div class="wrapper">
             <h2 class="advantages__title title">{{$settings->vacancy_title}}</h2>
             <p class="advantages__text">{{$settings->vacancy_description}}</p>
          </div>
          @include('inc.vacancies.advantages')
       </div>

       <div class="vacancies-content__vacancies-list vacancies-list">
          <div class="wrapper">
            @if (isset($vacancies) && $vacancies->isNotEmpty())
                <h2 class="vacancies-list__title title">Активные вакансии</h2>
                @include('inc.vacancies.list')
            @endif
            @include('inc.vacancies.summary')
          </div>
       </div>
    </div>
</section>
@endsection