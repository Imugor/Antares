@if (isset($partners) && $partners->isNotEmpty())
<section class="partners">
    <div class="wrapper">
       <div class="partners__partners-content partners-content">
          <h2 class="partners-content__title title">Наши партнеры</h2>
          <div class="partners-content__partners-slider partners-slider">
             <div class="partners-slider__button-prev button-nav"><i class="fa-solid fa-chevron-left"></i></div>
             <div class="partners-slider__partners-slider-content partners-slider-content swiper">
                <div class="partners-slider-content__wrapper swiper-wrapper">
                    @foreach ($partners as $item)
                    <div class="partners-slider-content__partners-slide partners-slide swiper-slide">
                       <img src="{{ asset('storage/'.$item->image_path) }}" alt="" class="partners-slide__img">
                    </div>
                    @endforeach
                </div>
             </div>
             <div class="partners-slider__button-next button-nav"><i class="fa-solid fa-chevron-right"></i></div>
             <div class="partners-slider__pagination swiper-pagination"></div>
          </div>
       </div>
    </div>
 </section>
@endif