import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, Grid, EffectFade, fadeEffect } from 'swiper/modules';
export function slidersInit() {
  let banner = new Swiper(".main-banner__banner", {
    modules: [Autoplay],
    allowTouchMove: true,
    loop: true,
    autoplay: {
      delay: 10000,
    },
    breakpoints: {
      421: {
        allowTouchMove: false,
      },
    },
  });

  let about = new Swiper(".statistics", {
    modules: [Autoplay],
    loop: true,
    autoplay: {
      delay: 5000,
    },
    allowTouchMove: true,
    slidesPerGroup: 1,
    spaceBetween: 50,
    breakpoints: {
      421: {
        autoplay: false,
        slidesPerGroup: 3,
        allowTouchMove: false,
        spaceBetween: 60,
      },
      1025: {
        autoplay: false,
        spaceBetween: 100,
        allowTouchMove: false,
      }
    }
  });

  let popularCategory = new Swiper(".main-categoris", {
    modules: [Autoplay],
    loop: true,
    autoplay: {
      delay: 10000,
    },
    allowTouchMove: true,
    slidesPerGroup: 1,
    slidesPerView: 1,
    initialSlide: 0,
    breakpoints: {
      421: {
        autoplay: false,
        width: 284,
        slidesPerView: 1,
        slidesPerGroup: 1,
        allowTouchMove: false,
      },
      1025: {
        autoplay: false,
        width: 384,
        slidesPerView: 1,
        slidesPerGroup: 1,

        allowTouchMove: false,
      }
    }
  });

  let stocks = new Swiper(".stocks-slider__stocks-slider-content", {
    modules: [Navigation, Pagination, Autoplay],
    pagination: {
      el: ".stocks-slider__pagination",
      clickable: true,
    },
    allowTouchMove: true,
    loop: true,
    autoplay: {
      delay: 10000,
    },
    breakpoints: {
      421: {
        allowTouchMove: false,

      }
    }
  });
  let check = document.querySelector(".stocks-slider__stocks-slider-content");
  if (check != null) {
    const swiperStockPrev = document.querySelector(".stocks-slider__button-prev")
    const swiperStockNext = document.querySelector(".stocks-slider__button-next")

    swiperStockPrev.addEventListener('click', () => {
      stocks.slidePrev();
    })
    swiperStockNext.addEventListener('click', () => {
      stocks.slideNext();
    })
  }


  let projects = new Swiper(".project-slider-content", {
    modules: [Pagination],
    pagination: {
      el: ".project-slider__pagination",
      clickable: true,
    },
    allowTouchMove: true,
    spaceBetween: 30,
    breakpoints: {
      421: {
        allowTouchMove: false,
      }
    }
  })
  check = document.querySelector(".project-slider-content");
  if (check != null) {
    const swiperProjectPrev = document.querySelector(".project-slider__button-prev")
    const swiperProjectNext = document.querySelector(".project-slider__button-next")

    swiperProjectPrev.addEventListener('click', () => {
      projects.slidePrev();
    })
    swiperProjectNext.addEventListener('click', () => {
      projects.slideNext();
    })
  }




  let reviews = new Swiper(".reviews-slider-content", {
    modules: [Pagination],
    pagination: {
      el: ".reviews-slider__pagination",
      clickable: true,
    },
    allowTouchMove: true,
    slidesPerView: 1,
    spaceBetween: 20,

    breakpoints: {
      421: {
        allowTouchMove: false,
        slidesPerView: 3,

      }
    }
  });

  let reviewsList = new Swiper(".reviews-list-slider-content", {
    allowTouchMove: false,
    slidesPerView: 1,
    slidesPerGroup: 1,
    modules: [Navigation, Pagination, Autoplay],
    pagination: {
      el: ".reviews-list-slider__pagination",
      clickable: true,
      renderBullet: function (index, className) {
        return '<span class="' + className + '">' + (index + 1) + '</span>';
      },
    },
    breakpoints: {
      421: {
        slidesPerView: 2,
        slidesPerGroup: 2,
      },
      1030: {
        slidesPerView: 3,
        slidesPerGroup: 3,
      }
    },
    spaceBetween: 15,
  });

  let numPagination = document.querySelector('.pagination-number');
  if (numPagination != null) {
    deleteLastEmptines();
    let spans = numPagination.querySelectorAll("span");

    setTimeout(() => {
      initNumPagination(spans);
    }, 10);
    const swiperReviewsListFirst = document.querySelector(".reviews-list-slider__button-first")
    const swiperReviewsListPrev = document.querySelector(".reviews-list-slider__button-prev")
    const swiperReviewsListNext = document.querySelector(".reviews-list-slider__button-next")
    const swiperReviewsListLast = document.querySelector(".reviews-list-slider__button-last")

    swiperReviewsListFirst.addEventListener('click', () => {
      reviewsList.slideTo(0);
      setTimeout(() => {
        initNumPagination(spans);
      }, 10);
    })
    swiperReviewsListPrev.addEventListener('click', () => {
      reviewsList.slidePrev();
      setTimeout(() => {
        initNumPagination(spans);
      }, 10);
    })
    swiperReviewsListNext.addEventListener('click', () => {
      reviewsList.slideNext();
      setTimeout(() => {
        initNumPagination(spans);
      }, 10);
    })
    swiperReviewsListLast.addEventListener('click', () => {
      reviewsList.slideTo(spans.length * 3);
      setTimeout(() => {
        initNumPagination(spans);
      }, 10);
    })
    for (let i = 0; i < spans.length; i++) {
      spans[i].addEventListener("click", () => {
        setTimeout(() => {
          initNumPagination(spans);
        }, 10);

      })

    }

  }

  function deleteLastEmptines() {
    if (document.documentElement.offsetWidth <= 420) {
      let lastSlide = reviewsList.slides[reviewsList.slides.length - 1];
      if (lastSlide.querySelector(".reviews-list-slide__block") == null) {
        lastSlide.style.display = "none";
        reviewsList.update();
      }
    }
  }

  async function initNumPagination(spans) {
    let activeIndex;

    if (document.documentElement.offsetWidth <= 420) {
      activeIndex = Math.ceil(reviewsList.activeIndex);


    } else if (document.documentElement.offsetWidth <= 1029) {
      activeIndex = Math.ceil(reviewsList.activeIndex / 2);

    } else {
      activeIndex = Math.ceil(reviewsList.activeIndex / 3);
    }
    for (let i = 0; i < spans.length; i++) {
        spans[i].classList.remove("active")
        spans[i].style.display = "none";
      if ((i + 1) == activeIndex || (i - 1) == activeIndex || i == activeIndex) {
        spans[i].classList.add("active")
        spans[i].style.display = "inline-flex";
      }

    }
    if (activeIndex == 0) {
      if (spans[2] != undefined) {
        spans[2].classList.add("active");
        spans[2].style.display = "inline-flex";
      }
    }
    if (activeIndex == spans.length - 1 && spans.length > 2) {
      spans[spans.length - 3].classList.add("active");
      spans[spans.length - 3].style.display = "inline-flex";
    }

  }

  let avards = new Swiper(".avards-slider-content", {
    modules: [Pagination],
    pagination: {
      el: ".avards-slider__pagination",
      clickable: true,
    },
    allowTouchMove: true,
    slidesPerView: 1,
    loop: true,
    breakpoints: {
      421: {
        allowTouchMove: false,
      },
    },
  });

  check = document.querySelector(".avards-slider-content");
  if (check != null) {
    const swiperAvardsPrev = document.querySelector(".avards-slider__button-prev")
    const swiperAvardsNext = document.querySelector(".avards-slider__button-next")

    swiperAvardsPrev.addEventListener('click', () => {
      avards.slidePrev();
    })
    swiperAvardsNext.addEventListener('click', () => {
      avards.slideNext();
    })
  }

  let parnters = new Swiper(".partners-slider-content", {
    modules: [Pagination],
    pagination: {
      el: ".partners-slider__pagination",
      clickable: true,
    },
    loop: true,
    slidesPerView: 1,
    spaceBetween: 22.8,
    breakpoints: {
      421: {
        allowTouchMove: false,
        slidesPerView: 3,

      },
      1030: {
        allowTouchMove: false,
        slidesPerView: 4,
        spaceBetween: 36.8,
      }
    },

  });
  check = document.querySelector(".partners-slider-content");
  if (check != null) {
    const swiperPartnersPrev = document.querySelector(".partners-slider__button-prev")
    const swiperPartnersNext = document.querySelector(".partners-slider__button-next")

    swiperPartnersPrev.addEventListener('click', () => {
      parnters.slidePrev();
    })
    swiperPartnersNext.addEventListener('click', () => {
      parnters.slideNext();
    })
  }

  let advantages = new Swiper(".advantages-slider__advantages-slider-content", {
    slidesPerView: 1,
    allowTouchMove: true,
    spaceBetween: 20,
    breakpoints: {
      451: {
        allowTouchMove: false,
        slidesPerView: 2,
      },
      1030: {
        allowTouchMove: false,
        slidesPerView: 3,
        spaceBetween: 18,
      },
    },

  });

  let items = new Swiper(".brief-slider__brief-slider-content", {
    modules: [Pagination, EffectFade],
    pagination: {
      el: ".brief-slider__pagination",
      clickable: true,
    },
    width: 312,
    allowTouchMove: true,
    effect: "fade",
    breakpoints: {
      421: {
        allowTouchMove: false,
        width: null,
      }
    }
  });
  check = document.querySelector(".brief-slider__brief-slider-content");

  if (check != null) {
    let slider = document.querySelector(".brief-slider");
    let chooseSlide = slider.querySelectorAll(".brief-aside__img");
    let aside = slider.querySelector(".brief-aside");
    let heightAside = aside.offsetHeight;
    let contentAside = slider.querySelector(".brief-aside__wrapper");

    let img = aside.querySelector("img");
    let imgHeight = img.offsetHeight;

    let imgs = aside.querySelectorAll("img");
    let curentDiv = 0;

    let gapHeight = heightAside - imgHeight * 3;

    let topArr = slider.querySelector(".brief-aside__arrow_top");
    let bottomArr = slider.querySelector(".brief-aside__arrow_bottom");

    let posPx = 0;
    let posSd = imgHeight + gapHeight / 2;


    checkHeight();

    for (let i = 0; i < chooseSlide.length; i++) {
      chooseSlide[i].addEventListener("mouseover", () => {
        items.slideTo(i);
      })
    }

    topArr.addEventListener("click", () => {
      curentDiv--;
      posPx -= posSd;
      contentAside.style.marginTop = -posPx + "px";
      checkHeight();
    })

    bottomArr.addEventListener("click", () => {
      curentDiv++;
      posPx += posSd;
      contentAside.style.marginTop = -posPx + "px";
      checkHeight();
    })

    function showArrow(arrow) {
      arrow.classList.add("brief-aside__arrow_visible");
    }

    function hideArrow(arrow) {
      if (arrow.classList.contains("brief-aside__arrow_visible")) {
        arrow.classList.remove("brief-aside__arrow_visible");
      }
    }

    function checkHeight() {

      if (curentDiv == 0 && imgs.length > 3) {
        showArrow(bottomArr);
      }
      if (curentDiv > 0) {
        showArrow(topArr);
      } else {
        hideArrow(topArr)
      }
      if (curentDiv + 3 == imgs.length) {
        hideArrow(bottomArr);
      }
    }
  }
}
