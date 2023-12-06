import { getUniqueArray } from "./functions.js";
import { scrollAncorInit } from "./scrollAnchor.js";

export function settingsDropInit() {
  if (!document.querySelector(".select-list")) {
    return;
  }
  let settings = new Map();
  let settingsContent = new Map();
  let settingsTitle = document.querySelectorAll(".select-list__title");
  let settingsForm = document.querySelector(".category-aside");

  openSettings(settingsTitle);


  function openSettings(settingsTitle) {
    for (let i = 0; i < settingsTitle.length; i++) {
      settings.set(i, settingsTitle[i].closest(".select-list"));
      settingsContent.set(i, settings.get(i).querySelector(".select-list__content"));
      settingsTitle[i].addEventListener("click", () => {
        if (!settingsContent.get(i).classList.contains("active")) {
          settingsTitle[i].classList.add("active");
          settingsContent.get(i).classList.add("active");
        } else {
          settingsTitle[i].classList.remove("active");
          settingsContent.get(i).classList.remove("active");
        }
      })
      clickSetting(settingsTitle[i], settingsContent.get(i), i);

    }
  }

  function clickSetting(settingsTitle, settingsContent, k) {
    let labels = settingsContent.querySelectorAll(".select-list__select-label")
    for (let i = 0; i < labels.length; i++) {
      labels[i].addEventListener('click', (evt) => {
        settingsTitle.textContent = evt.target.textContent;
        settingsTitle.classList.remove("active");
        settingsContent.classList.remove("active");

        let form = settingsTitle.closest("form");
        if (form.classList.contains("category-top-settings")) {
          let catInput = document.createElement("input");
          catInput.type = "hidden";
          catInput.name = "order";
          catInput.value = labels[i].previousElementSibling.value;
          form.appendChild(catInput);

          let inputs = form.querySelectorAll("input[type='hidden']");
          redirectFormParams(form, inputs);
        }

        if (form.classList.contains("teg-select")) {
          let catInput = document.createElement("input");
          catInput.type = "hidden";
          catInput.name = "teg";
          catInput.value = labels[i].previousElementSibling.value;
          form.appendChild(catInput);
        }

        settingsTitle.nextSibling.nextSibling.value = evt.target.textContent;
        if (form.querySelector("input[type='submit']")) {
          return;
        }

        form.method = 'GET';

        form.submit();
      });
    }
  }
}


// Добавляет в форму скрытые инпуты со значениями, которые уже были введены
// при отправке предыдущей формы
function redirectFormParams(form, inputs) {
  let getParams = location.search.slice(1, location.search.length);
  getParams = getParams.split("&");

  for (const params of getParams) {
    let mass = params.split("=");

    let input = document.createElement("input");
    input.type = "hidden";
    input.name = mass[0];
    input.value = mass[1];

    //Проверка на то есть ли значение в настоящей форме и в предыдущей
    let check = true;
    for (const hidden of inputs) {
      if (hidden.name == input.name) {
        check = false;
        break;
      }
    }

    if (check) {
      form.appendChild(input);
    }
  }
}



export function cityDropInit() {
  // Выпадающий список городов
  let selectSingle = new Map();
  let selectSingle_labels = new Map();
  let selectSingle_title = document.querySelectorAll('.form-city__title');

  // Toggle menu
  for (let i = 0; i < selectSingle_title.length; i++) {
    selectSingle.set(i, selectSingle_title[i].closest('.form-city__title-content'));
    selectSingle_labels.set(i, selectSingle.get(i).querySelectorAll('.form-city__select-label'));
    selectSingle_title[i].addEventListener('click', () => {
      if ('active' === selectSingle.get(i).getAttribute('data-state')) {
        selectSingle.get(i).setAttribute('data-state', '');
      } else {
        selectSingle.get(i).setAttribute('data-state', 'active');
      }

    });

  }


  for (let i = 0; i < selectSingle_labels.size; i++) {
    clickCity(selectSingle_labels.get(i), 0);

  }

  function clickCity(labels, k) {
    // Close when click to option
    for (let i = 0; i < labels.length; i++) {
      labels[i].addEventListener('click', (evt) => {
        selectSingle_title[k].textContent = evt.target.textContent;
        selectSingle.get(k).setAttribute('data-state', '');
        let form = selectSingle_title[k].closest("form");
        let cityInput = document.createElement("input");
        cityInput.type = "hidden";
        cityInput.name = "city"
        cityInput.value = labels[i].htmlFor;
        form.appendChild(cityInput);
        form.method = 'POST';
        form.submit();
      });
    }
  }
}



export function contentDropInit() {
  let content = document.querySelector(".article-contents__title")
  if (content == null) {
    return;
  }
  let parent = content.parentNode;
  let contentsLinks = parent.querySelector(".article-contents__links");
  let contentArticle = document.querySelector(".article-info-text");
  let titles = getTitles(contentArticle);

  for (let i = 0; i < titles.length; i++) {
    createLinks(contentsLinks, titles[i].textContent, "article-contents__link")
  }

  scrollAncorInit();
  let heightContent = contentsLinks.clientHeight;
  contentsLinks.style.marginTop = -heightContent + "px";
  setTimeout(() => {
    contentsLinks.style.transition = "1s margin ease";
  }, 10);
  content.addEventListener('click', () => {


    if (contentsLinks.classList.contains("active")) {
      content.classList.remove("active");
      contentsLinks.classList.remove("active");
      contentsLinks.style.marginTop = -heightContent + "px";


    } else {
      content.classList.add("active");
      contentsLinks.classList.add("active");
      contentsLinks.style.marginTop = 0;

    }
  })

}

function getTitles(div) {
  let titles = div.querySelectorAll("h2, h3, h4, h5, h6");
  return titles;
}

function createLinks(div, titles, className) {
  let link = document.createElement("li");
  link.classList.add(className);
  let tegA = document.createElement("a");
  tegA.textContent = titles;
  link.append(tegA);
  div.append(link);
}
// высота строки элемента меню в мобильной версии;
let labelMenuHeight = 45;
// Мобильное меню
export function menuDropInit() {
  let buttons = document.querySelectorAll(".burger");

  for (const button of buttons) {
    let menu;
    if (button.classList.contains("top-nav__burger")) {
      menu = document.querySelector(".header__bottom-nav");
    } else if (button.classList.contains("fixed-nav__burger")) {
      menu = button.parentElement.parentElement.querySelector(".bottom-nav");

    }
    button.addEventListener("click", () => {
      if (button.classList.contains("active")) {
        button.classList.remove("active");
        menu.classList.remove("active");
        closeAllSubMenu();

      } else {
        button.classList.add("active");
        menu.classList.add("active");

      }
    })
  }



}

//Подменю в меню
export function subMenuDropInit() {
  let labelMenu = document.querySelectorAll(".drop-down-list__main");

  for (const menu of labelMenu) {
    let parent = menu.parentElement;
    let subMenu = parent.querySelector(".drop-down-list__links");
    //Проверка на существования подменю
    if (subMenu == null) {
      continue;
    }
    let subMenuHeight = subMenu.offsetHeight;

    menu.addEventListener("click", (e) => {
      if (parent.classList.contains("active")) {
        parent.classList.remove("active");
        parent.style.height = labelMenuHeight + "px";
      } else {
        parent.classList.add("active");
        parent.style.height = labelMenuHeight + subMenuHeight + "px";
        closeAllSubMenu(e.target.closest(".drop-down-list"));
      }
    })
  }

}

let labelFooterMenuHeight = 49.8;
//Меню в подвале
export function footerMenuDropInit() {
  let labelMenu = document.querySelectorAll(".footer-links__main-link");

  for (const menu of labelMenu) {
    let parent = menu.parentElement;
    let subMenu = parent.querySelector(".footer-links__sub-links");
    //Проверка на существования подменю
    if (subMenu == null) {
      continue;
    }
    let subMenuHeight = subMenu.offsetHeight;

    menu.addEventListener("click", (e) => {
      if (parent.classList.contains("active")) {
        parent.classList.remove("active");
        parent.style.height = labelFooterMenuHeight + "px";
      } else {
        parent.classList.add("active");
        parent.style.height = labelFooterMenuHeight + subMenuHeight + "px";
        closeAllFooterMenu(e.target.closest(".footer-links"));
      }
    })
  }

}

function closeAllFooterMenu(e = null) {
  let subMenu = document.querySelectorAll(".footer-links.active");

  for (const elem of subMenu) {
    if (elem == e) {
      continue;
    }
    elem.style.height = labelFooterMenuHeight + "px";
    elem.classList.remove("active");
  }
}

export function closeAllSubMenu(e = null) {
  let subMenu = document.querySelectorAll(".drop-down-list.active");

  for (const elem of subMenu) {
    if (elem == e) {
      continue;
    }
    elem.style.height = labelMenuHeight + "px";
    elem.classList.remove("active");
  }
}
// Закрытие фиксированного меню
export function closeFixedMenu() {

  let fixedBurger = document.querySelector(".fixed-nav__burger");
  let fixedBottomNav = document.querySelector(".fixed-nav__bottom-nav");

  if (fixedBurger.classList.contains("active") || fixedBottomNav.classList.contains("active")) {
    fixedBurger.classList.remove("active");
    fixedBottomNav.classList.remove("active");
    closeAllSubMenu();

  }
}


export function closeTopMenu() {
  let topBurger = document.querySelector(".top-nav__burger");
  let topBottomNav = document.querySelector(".header__bottom-nav");

  if (topBurger.classList.contains("active") || topBottomNav.classList.contains("active")) {
    topBurger.classList.remove("active");
    topBottomNav.classList.remove("active");
    closeAllSubMenu();
  }
}

export function closeCityMenu() {
  let locations = document.querySelectorAll(".location");

  for (const location of locations) {
    let content = location.querySelector(".form-city__title-content");
    content.setAttribute('data-state', '');
  }
}
