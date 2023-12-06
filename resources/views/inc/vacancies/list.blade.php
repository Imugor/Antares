@foreach ($vacancies as $item)
<div class="vacancies-list__vacancy vacancy">
    <div class="vacancy__main-content">
       <h3 class="vacancy__title">{{$item->name}}<div class="vacancy__button button-nav"> <div class="vacancy__button-center "></div></div></h3>

       <p class="vacancy__salary">{{$item->payment}}</p>
       <p class="vacancy__text vacancy__exp">{{$item->experience}}</p>
       <p class="vacancy__text vacancy__time">{{$item->work_day}}</p>
    </div>
    <div class="vacancy__vacancy-info vacancy-info">
       <div class="vacancy-info__vacancy-requirements">
          <h4 class="vacancy-info__title">Требования: </h4>
          @foreach ($item->requirements as $req)
            <p class="vacancy-info__lebel">{{$req}}</p>
          @endforeach
       </div>
       <div class="vacancy-info__vacancy-conditions">
          <h4 class="vacancy-info__title">Условия: </h4>
          @foreach ($item->conditions as $con)
            <p class="vacancy-info__lebel">{{$con}}</p>
          @endforeach
       </div>
    </div>
 </div>
@endforeach