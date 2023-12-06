@if (isset($popular_categories) && $popular_categories->isNotEmpty())
{{-- <section class="popular-category">
    <div class="wrapper">
       <div class="popular-category__content">
          <h2 class="popular-category__title title">Популярные категории</h2>
          <div class="popular-category__main-categoris">
            @foreach ($popular_categories as $item)
               <a href="{{route('catalog_category', ['slug' => $item->slug, 'page' => 1])}}" class="popular-category__main-category main-category">
                  <img src="{{ asset('storage/'.$item->bg_image_path) }}" alt="" class="main-category__img">
                  <h3 class="main-category__name">{{ $item->name }}</h3>
               </a>
            @endforeach
          </div>
       </div>
    </div>
 </section>  --}}
 <section class="popular-category">
   <div class="wrapper">
     <div class="popular-category__content">
       <h2 class="popular-category__title title">Популярные категории</h2>
       <div class="popular-category__main-categoris main-categoris swiper">
         <div class="main-categoris__wrapper swiper-wrapper">
            
            @foreach ($popular_categories as $item)
           <div class="main-categoris__slide swiper-slide">
             <a href="{{route('catalog_category', ['slug' => $item->slug, 'page' => 1])}}" class="main-categoris__main-category main-category">
               <picture><img src="{{ asset('storage/'.$item->bg_image_path) }}" alt="" class="main-category__img"></picture>
               <h3 class="main-category__name">{{ $item->name }}</h3>
             </a>
           </div>
           @endforeach
           </a>
         </div>
       </div>
     </div>
   </div>
 </section>
 @endif