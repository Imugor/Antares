@if(isset($advantages) && $advantages != [[], [], []])
<div class="advantages__advantages-slider advantages-slider">
    <div class="no-wrapper">
        <div class="wrapper">
            <div class="advantages-slider__advantages-slider-content swiper">
                <div class="advantages-slider-content__wrapper swiper-wrapper">
                    @foreach ($advantages as $advantages_column)
                        <div class="advantages-slider-content__advantages-slide advantages-slide swiper-slide">
                            @foreach ($advantages_column as $item)
                                <div class="advantages-slide__advantage advantage">
                                    <img src="{{asset('storage/'.$item['image_path'])}}" alt="" class="advantage__img">
                                    <div class="advantage__text-content">
                                        <h3 class="advantage__title">{{$item['name']}}</h3>
                                        <p class="advantage__text">{{$item['description']}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif