@if(isset($promo) && $promo->isNotEmpty())
 <section class="stocks">
   <div class="wrapper">
      <div class="stocks__stocks-content stocks-content">
         <h2 class="stocks-content__title title">Акция</h2>
         <div class="stocks-content__stocks-slider stocks-slider">
            <div class="stocks-slider__button-prev stocks-slider__button button-nav">
              <div class="button-nav__content button-nav__prev"></div>
            </div>
            <div class="stocks-slider__stocks-slider-content stocks-slider-content swiper">
               <div class="stocks-slider-content__wrapper swiper-wrapper">
                  @foreach ($promo as $item)
                     <div class="stocks-slider-content__stocks-slide stocks-slide swiper-slide">
                        <div  class="stocks-slide__stocks-slide-content stocks-slide-content">
                           <div class="stocks-slide-content__title">{!! $item->name !!}</div>
                           <p class="stocks-slide-content__text">{{ $item->description }}</p>
                           <a href="{{route('stock', ['slug' => $item->slug])}}"><button class="stocks-slide-content__button">Подробнее</button></a>
                        </div>
                        <div class="stocks-slide__effects">
                           <div></div>
                           <div></div>
                           <div></div>
                           <div></div>
                           <div></div>
                        </div>
                        <img src="{{ asset('storage/'.$item->bg_image_path) }}" alt="" class="stocks-slide__photo">
                     </div>
                  @endforeach
               </div>                  
            </div>
         <div class="stocks-slider__button-next button-nav"><i class="fa-solid fa-chevron-right"></i></div>
         </div>          
         <div class="stocks-slider__pagination swiper-pagination"></div> 
      </div>
   </div>
</section>
 @endif