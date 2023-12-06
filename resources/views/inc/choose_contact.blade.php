<img src="{{asset('img/location.svg')}}" alt="Локация" class="location__icon">
<form action="{{ route('replace_city') }}" class="location__form-city form-city" method="POST" id="form-city">
   @csrf
   <div class="form-city__title-content" data-state="">
      <h3 class="form-city__title" data-default="{{$page_settings['choose_contact']->city}}">{{$page_settings['choose_contact']->city}}</h3>
   
      <div class="form-city__content">
         <input type="radio" class="form-city__select-input" id="">
         <label for="" class="form-city__select-label"></label>

         @foreach ($page_settings['contacts'] as $item)
            <input type="radio" class="form-city__select-input" id="{{$item->id}}">
            <label for="{{$item->id}}" class="form-city__select-label">{{$item->city}}</label>
         @endforeach
      </div>
   </div>
</form>