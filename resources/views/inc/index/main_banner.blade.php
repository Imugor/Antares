 @if(isset($index_settings->index_banner) && $index_settings->index_banner != null)
 <section class="main-banner">
   <div class="no-wrapper">
     <div class="main-banner__banner banner swiper">
       <div class="swiper-wrapper banner__wrapper">

        @foreach ($index_settings->index_banner as $item)
        <div class="swiper-slide banner__banner-slide">
          <div class="banner-slide">
            <div class="banner-slide__particles">
              <div class="banner-slide__main-text">
                <h2 class="banner-slide__title">{{$item['title']}}</h2>
                <p class="banner-slide__text">{{$item['description']}}</p>
                @if ($item['button'])
                <a href="{{route('catalog')}}"><button class="banner-slide__button">Перейти в каталог</button></a>
                @endif
              </div>
              <div class="banner-slide__main">
              </div>
              <div></div>
              <div></div>
              <div></div>
              <div></div>
              <div></div>
              <div></div>
              <div></div>
              <div></div>
              <div></div>
              <div></div>
              <div></div>
              <div></div>
              <div></div>
              <div></div>
              <div></div>
            </div>
            <div class="banner-slide__photo">
              <picture><img src="{{asset('storage/'.$item['image1'])}}"></picture>
            </div>
            <div class="banner-slide__photo">
              <picture><img src="{{asset('storage/'.$item['image2'])}}"></picture>
            </div>
            <div class="banner-slide__photo">
              <picture><img src="{{asset('storage/'.$item['image3'])}}"></picture>
            </div>
          </div>
        </div>
        @endforeach
       </div>
     </div>
   </div>
 </section>
 @endif