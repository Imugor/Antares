 <section class="about">
  <div class="no-wrapper">
    <div class="wrapper">
      <div class="about__about-info about-info">
        <h2 class="about-info__title title">О компании</h2>
        <h1 class="about-info__text"><span class="about-info__text_bold">Антарес</span> - комплексное
          снабжение объектов
          строительными материалами</h1>
        <div class="about-info__statistics statistics swiper">
          <div class="statistics__wrapper swiper-wrapper">
            <div class="statistics__slide swiper-slide">
              <div class="statistics__statistics-element statistics-element">
                <h3 class="statistics-element__title">100%</h3>
                <p class="statistics-element__info">команда нацеленая на 100% результат</p>
              </div>
            </div>
            <div class="statistics__slide swiper-slide">
              <div class="statistics__statistics-element statistics-element">
                <h3 class="statistics-element__title">{{ $index_settings->index_years ?? 1  }} <?php 
                  $years = $index_settings->index_years ?? 1;
                  $last_symbol = $years % 10;
                  if ($last_symbol == 1 && (($years / 10) % 10) != 1) {
                     echo 'год';
                  } else if ($last_symbol > 1 && $last_symbol < 5 && (($years / 10) % 10) != 1) {
                     echo 'года';
                  } else {
                     echo 'лет';
                  }
                  ?></h3>
                <p class="statistics-element__info">работаем в сфере более {{ $index_settings->index_years ?? 1  }} <?php 
                  if ($last_symbol == 1 && (($years / 10) % 10) != 1) {
                     echo 'года';
                  } else {
                     echo 'лет';
                  }
                ?></p>
              </div>
            </div>
            <div class="statistics__slide swiper-slide">
              <div class="statistics__statistics-element statistics-element">
                <h3 class="statistics-element__title">24/7</h3>
                <p class="statistics-element__info">сопровождение от начала и до конца</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>