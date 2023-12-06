@if(isset($reviews) && $reviews->isNotEmpty())
<section class="reviews">
    <div class="wrapper">
       <div class="reviews__reviews-content reviews-content">
          <h2 class="reviews-content__title title">Отзывы</h2>
          <div class="reviews-content__reviews-slider reviews-slider">
             <div class="reviews-slider__reviews-slider-content reviews-slider-content swiper">
                <div class="reviews-slider-content__wrapper swiper-wrapper">
                    @foreach ($reviews as $item)
                    <div class="reviews-slider-content__reviews-slide reviews-slide swiper-slide">
                     <div class="reviews-slide__top">
                        <p class="reviews-slide__name">{{ $item->fullname }}</p>
                        <div class="reviews-slide__stars stars" data-rating="{{ $item->rating }}">
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
                     <p class="reviews-slide__text">{{ $item->text }}</p>
                  </div>
                    @endforeach               
                </div>
             </div>
             <div class="reviews-slider__pagination swiper-pagination"></div> 
          </div>
       </div>
    </div>
 </section>
 @endif