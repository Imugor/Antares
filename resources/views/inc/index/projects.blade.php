@if(isset($projects) && $projects->isNotEmpty())
<section class="projects">
    <div class="wrapper">
       <div class="projects__projects-content project-content">
          <h2 class="project-content__title title">Реализованные проекты</h2>
          <div class="project-content__project-slider project-slider">
             <div class="project-slider__button-prev button-nav"><i class="fa-solid fa-chevron-left"></i></div>
             <div class="project-slider__slider-content project-slider-content swiper">
                <div class="project-slider-content__slider-wrapper swiper-wrapper">
                    @foreach ($projects as $item)
                    <div class="project-slider-content__project-slide project-slide swiper-slide">
                       <img src="{{ asset('storage/'.$item->image_path) }}" alt="" class="project-slide__img">
                       <div class="project-slide__content">
                          <h3 class="project-slide__title">{{ $item->name }}</h3>
                          <div class="project-slide__text">{!! $item->description !!}</div>
                       </div>
                    </div>
                    @endforeach
                   {{-- <div class="project-slider-content__project-slide project-slide swiper-slide">
                      <img src="img/projects.jpg" alt="" class="project-slide__img">
                      <div class="project-slide__content">
                         <h3 class="project-slide__title">Уфа арена</h3>
                         <p class="project-slide__text">Многофункциональный спортивно-концертный комплекс в Уфе, домашняя арена российского хоккейного клуба «Салават Юлаев».</p>
                      </div>
                   </div> --}}
                </div>
             </div>
             <div class="project-slider__button-next button-nav"><i class="fa-solid fa-chevron-right"></i></div>
             <div class="project-slider__pagination swiper-pagination"></div>
          </div>
       </div>
    </div>
 </section>
 @endif