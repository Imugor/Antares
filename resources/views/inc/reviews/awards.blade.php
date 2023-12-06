@if (isset($awards) && $awards->count() > 0)
<section class="avards">
    <div class="wrapper">
        <div class="avards__avards-content avards-content">
            <div class="avards-content__avards-slider avards-slider">
                <div class="avards-slider__button-prev button-nav"><i class="fa-solid fa-chevron-left"></i></div>
                <div class="avards-slider__avards-slider-content avards-slider-content swiper">
                    <div class="avards-slider-content__wrapper swiper-wrapper">
                        @foreach ($awards as $item)
                            <div class="avards-slider-content__avards-slide avards-slide swiper-slide">
                                <img src="{{asset('storage/'.$item->image_path)}}" alt="" class="avards-slide__img">
                                <h3 class="avards-slide__title">{{$item->name}}</h3>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="avards-slider__button-next button-nav"><i class="fa-solid fa-chevron-right"></i></div>
            </div>
        </div>
    </div>
</section>
@endif