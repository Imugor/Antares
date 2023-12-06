"use strict"
import * as func from "./modules/functions.js";
import { slidersInit } from "./modules/sliders.js";
import { popUpStart } from "./modules/popUp.js";
import { initStars } from "./modules/stars.js";
import { initForm } from "./modules/form.js";
import { cityDropInit, closeAllSubMenu, closeCityMenu, closeFixedMenu, closeTopMenu, contentDropInit, footerMenuDropInit, menuDropInit, settingsDropInit, subMenuDropInit } from "./modules/dropList.js";
import { scrollAncorInit, scrollButtonInit } from "./modules/scrollAnchor.js";
import { filtrInit } from "./modules/filtrs.js";
import { initCheckEmpty } from "./modules/empty.js";
import { changeHeightProject } from "./modules/changeHeightProject.js";


window.addEventListener('scroll', function() {
  let topNav = document.querySelector(".header__fixed-nav");
  let scrollButton = this.document.querySelector(".scroll-button");
  if ( this.pageYOffset > 200) {
    topNav.classList.add("header__fixed-nav_visible")
    if (scrollButton != null) {
        scrollButton.classList.add("active");
    }

    closeTopMenu();
  } else {
    topNav.classList.remove("header__fixed-nav_visible")
    if (scrollButton != null) {
        scrollButton.classList.remove("active");
    }
    closeFixedMenu();
    closeCityMenu();
  }
});

//Если не мобильная версия, то меню не выпадает
//Сделано для того, чтобы не присваивался класс active на декстоп
if (document.documentElement.clientWidth <= 420) {
    menuDropInit();
    subMenuDropInit();
    footerMenuDropInit();
  }
func.maskPhone();
slidersInit();
popUpStart();
initStars();
initForm();

cityDropInit();
settingsDropInit();
contentDropInit()
filtrInit();

initCheckEmpty();
scrollButtonInit();

changeHeightProject();






let vacancyButton = document.querySelectorAll(".vacancy__button");
let vacancyHeight = new Map();
if (vacancyButton != null) {
  for (let i = 0; i < vacancyButton.length; i++) {
    let vacancy = vacancyButton[i].closest(".vacancy");
    vacancyHeight.set(i,`${vacancy.querySelector(".vacancy-info").offsetHeight}`)

    vacancy.style.height = `${vacancy.querySelector(".vacancy__main-content").offsetHeight}px`;
  }

  for (let i = 0; i < vacancyButton.length; i++) {
    vacancyButton[i].addEventListener("click", () => {
      let vacancy = vacancyButton[i].closest(".vacancy");
      let vacancyInfo = vacancy.querySelector(".vacancy-info");
      vacancyInfo.classList.toggle("vacancy-info_visible")
      if (vacancyInfo.classList.contains("vacancy-info_visible")) {
        vacancyInfo.style.height = vacancyHeight.get(i) + "px";

        vacancy.style.height = `${vacancy.querySelector(".vacancy__main-content").offsetHeight + +vacancyHeight.get(i)}px`;
      } else {
        vacancy.style.height = `${vacancy.querySelector(".vacancy__main-content").offsetHeight}px`;
      }

      let vacancyButtonContent = vacancyButton[i].querySelector(".vacancy__button-center");

      vacancyButtonContent.classList.toggle("vacancy__button-center_visible");
    })

  }
}

