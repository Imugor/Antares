<section class="reviews-list">
    <div class="wrapper">
        <div class="reviews-list__reviews-list-content reviews-list-content">
            <div class="reviews-list-content__breadcrumb breadcrumb">
            @include('inc.breadcrumbs')
            </div>
            <h2 class="reviews-list-content__title title">Отзывы</h2>
            <p class="reviews-list-content__text">Ваши отзывы имеют для нас огромное значение, поскольку они помогают нам развиваться, улучшать наши услуги и создавать лучший опыт обслуживания для наших клиентов.</p>

            <div class="reviews-list-content__reviews-list-flex reviews-list-flex">
                @if ($reviews->count() > 0)
                <div class="reviews-list-flex__reviews-rating reviews-rating">
                    <p class="reviews-rating__rating rating">{{$average_rating}}</p>
                    <div class="reviews-rating__stars stars">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M3.295 13L4.27 8.93289L1 6.19737L5.32 5.83553L7 2L8.68 5.83553L13 6.19737L9.73 8.93289L10.705 13L7 10.8434L3.295 13Z"/>
                         </svg>
                         <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M3.295 13L4.27 8.93289L1 6.19737L5.32 5.83553L7 2L8.68 5.83553L13 6.19737L9.73 8.93289L10.705 13L7 10.8434L3.295 13Z" />
                         </svg>
                         <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M3.295 13L4.27 8.93289L1 6.19737L5.32 5.83553L7 2L8.68 5.83553L13 6.19737L9.73 8.93289L10.705 13L7 10.8434L3.295 13Z"/>
                         </svg>
                         <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M3.295 13L4.27 8.93289L1 6.19737L5.32 5.83553L7 2L8.68 5.83553L13 6.19737L9.73 8.93289L10.705 13L7 10.8434L3.295 13Z"/>
                         </svg>
                         <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M3.295 13L4.27 8.93289L1 6.19737L5.32 5.83553L7 2L8.68 5.83553L13 6.19737L9.73 8.93289L10.705 13L7 10.8434L3.295 13Z" />
                         </svg>
                    </div>
                    <p class="reviews-rating__count">/ {{$reviews->count()}} оц.</p>
                </div>
                @endif
                <button class="reviews-list-content__button button pop-up-start" data-popUp="add-review">Написать отзыв</button>
            </div>

        </div>
        @if ($reviews->count() > 0)
        <div class="reviews-list__reviews-list-slider reviews-list-slider">
            <div class="reviews-list-slider__reviews-list-slider-content reviews-list-slider-content swiper">
                <div class="reviews-list-slider-content__wrapper swiper-wrapper">
                    @for ($i = 0; $i < $reviews->count(); $i+=2)
                    <div class="reviews-list-slider-content__reviews-list-slide reviews-list-slide swiper-slide">
                        @for ($j = 0; $j < 2; $j++)
                            <?php $item = $reviews_array[$i+$j] ?? null ?>
                            @if (isset($item) && $item != null)
                                <div class="reviews-list-slide__block">
                                    <div class="reviews-slide__top">
                                        <p class="reviews-slide__name">{{$item->fullname}}</p>
                                        <div class="reviews-slide__stars stars" data-rating="{{$item->rating}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                            <path d="M3.295 13L4.27 8.93289L1 6.19737L5.32 5.83553L7 2L8.68 5.83553L13 6.19737L9.73 8.93289L10.705 13L7 10.8434L3.295 13Z"/>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                            <path d="M3.295 13L4.27 8.93289L1 6.19737L5.32 5.83553L7 2L8.68 5.83553L13 6.19737L9.73 8.93289L10.705 13L7 10.8434L3.295 13Z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                            <path d="M3.295 13L4.27 8.93289L1 6.19737L5.32 5.83553L7 2L8.68 5.83553L13 6.19737L9.73 8.93289L10.705 13L7 10.8434L3.295 13Z"/>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                            <path d="M3.295 13L4.27 8.93289L1 6.19737L5.32 5.83553L7 2L8.68 5.83553L13 6.19737L9.73 8.93289L10.705 13L7 10.8434L3.295 13Z"/>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                            <path d="M3.295 13L4.27 8.93289L1 6.19737L5.32 5.83553L7 2L8.68 5.83553L13 6.19737L9.73 8.93289L10.705 13L7 10.8434L3.295 13Z" />
                                        </svg>
                                        </div>
                                    </div>
                                    <p class="reviews-slide__text">{{$item->text}}</p>
                                </div>
                            @endif
                        @endfor
                    </div>
                    @endfor
                    @for ($i = 0; $i < 3 - (ceil($reviews->count() / 2) % 3); $i++)
                        <div class="reviews-list-slider-content__reviews-list-slide reviews-list-slide swiper-slide"></div>
                    @endfor
                    @csrf
                </div>
            </div>
            <div class="reviews-list-slider__navigation">
                <div class="reviews-list-slider__button-first reviews-list-slider__button"><div></div></div>
                <div class="reviews-list-slider__button-prev reviews-list-slider__button"></div>
                <div class="reviews-list-slider__pagination pagination-number swiper-pagination">
                    <span class="swiper-pagination-bullet"></span>
                </div>
                <div class="reviews-list-slider__button-next reviews-list-slider__button"></div>
                <div class="reviews-list-slider__button-last reviews-list-slider__button"><div></div></div>
            </div>
        </div>
        @endif
        @if($reviews->count() == 0)
        <br><br><br><br>
        @endif
    </div>
   </section>