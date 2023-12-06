import { initForm } from "./form.js";
import { maskPhone } from "./functions.js";
import { starsReview } from "./stars.js";

const KEY_ESC = 27;
const INNER_ADD_REVIEW = `
    <div class="add-review__content pop-up__content">
        <div class="add-review__close pop-up__close-block"><div class="pop-up__close"></div></div>
        <h2 class="add-review__title title">Оставьте отзыв</h2>
        <p class="add-review__text">Мы будем рады услышать ваши предложения и пожелания о том, как мы можем улучшить свою работу.</p>
        <div class="add-review__stars stars">
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
        <p class="add-review__stars-text">Выберете рейтинг</p>
        <form  class="add-review__form-review form-review form">
        <input class="form-review__rating" name="rating" type="hidden" value="5">
            <input type="hidden" name="typeForm" value="add-review">
            <div class="form-review___inputbox form-review__name inputbox">
              <input type="text" class="form-review__name" name="name" placeholder="Имя">
              <p class="inputbox__error"></p>
            </div>
            <div class="form-review__inputbox form-review__second-name inputbox">
              <input class="form-review__second-name" type="text" name="secondName" placeholder="Фамилия">
              <p class="inputbox__error"></p>
            </div>
              <div class="form-review__inputbox form-review__phone inputbox">
              <input type="tel" class="form-review__phone" name="phone" placeholder="Телефон">
              <p class="inputbox__error"></p>
            </div>
            <div class="form-review__inputbox form-review__email inputbox">
                <input type="text" class="form-review__email" name="email" placeholder="Почта">
                <p class="inputbox__error"></p>
            </div>
            <textarea type="text" class="form-review__message" name="message" placeholder="Сообщение" contenteditable></textarea>
            <div class="form-review__buttons">
                <input type="button" class="form-review__cancel button pop-up__close" value="Отменить">
                <input type="submit" class="form-review__submit button" value="Отправить отзыв">
            </div>
            <p class="form-review__text">Нажимая кнопку “<span class="form-review__text_bold">Отправить отзыв</span>”, вы даете согласие на обработку и хранение <a href="${location.origin}/articles/politika-konfidencialnosti" class="form-review__link">персональных данных</a></p>
        </form>
    </div>`;

const INNER_FEEDBACK = `
    <div class="feedback-pop-up__content pop-up__content">
        <div class="feedback-pop-up__close pop-up__close-block"><div class="pop-up__close"></div></div>
        <form class="feedback-content__feedback-form feedback-form form" id="feedback">
            <h2 class="feedback-form__title title">Обратная связь</h2>
            <p class="feedback-form__text">Задайте свой вопрос, оставьте заявку и мы свяжемся с Вами!</p>
            <div class="feedback-form__wrapper">
              <input type="hidden" name="typeForm" value="feedback">
              <div class="feedback-form__inputbox inputbox">
                <input type="text" class="feedback-form__name" name="name" placeholder="Имя">
                <p class="inputbox__error"></p>
              </div>
              <div class="feedback-form__inputbox inputbox">
                <input type="tel" class="feedback-form__phone" name="phone" placeholder="Телефон">
                <p class="inputbox__error"></p>
              </div>
              <div class="feedback-form__inputbox inputbox">
                <input type="text" class="feedback-form__mail" name="email" placeholder="Почта">
                <p class="inputbox__error"></p>
              </div>
              <div class="feedback-form__inputbox inputbox">
                <textarea type="text" class="feedback-form__message" name="message" placeholder="Сообщение"
                contenteditable></textarea>
              </div>
              <input type="submit" class="feedback-form__submit button" value="Отправить">
              <p class="feedback-form__agreement">Нажимая кнопку “<span class="feedback-form__agreement_bold">
                  Отправить</span>”, вы даете согласие на обработку и хранение <a href="${location.origin}/articles/politika-konfidencialnosti"
                  class="feedback-form__agreement_link">персональных данных</a></p>
            </div>
          </form>
    </div>`;
const INNER_ORDER = `
    <div class="order__content pop-up__content">
      <div class="order__close pop-up__close-block">
        <div class="pop-up__close"></div>
      </div>
      <form class="order-content__order-form order-form form" id="order">
        <h2 class="order-form__title title">Заказ</h2>
        <p class="order-form__text">Напишите нам и мы свяжемся с вами!</p>
        <div class="order-form__wrapper">
          <input type="hidden" name="typeForm" value="order">
          <div class="order-form__inputbox inputbox">
            <input type="text" class="order-form__name" name="name" placeholder="Имя">
            <p class="inputbox__error"></p>
          </div>
          <div class="order-form__inputbox inputbox">
            <input type="tel" class="order-form__phone" name="phone" placeholder="Телефон">
            <p class="inputbox__error"></p>
          </div>
          <div class="order-form__inputbox inputbox">
            <input type="text" class="order-form__mail" name="email" placeholder="Почта">
            <p class="inputbox__error"></p>
          </div><input type="hidden" class="order-form__item" name="message">
          <h3 class="order-form__item-title">Товар:</h3>
          <p class="order-form__item-name"></p>
          <input type="submit" class="order-form__submit button" value="Отправить">
          <p class="order-form__agreement">Нажимая кнопку “<span class="order-form__agreement_bold">
              Отправить</span>”, вы даете согласие на обработку и хранение <a href="${location.origin}/articles/politika-konfidencialnosti"
              class="order-form__agreement_link">персональных данных</a></p>
        </div>
      </form>
    </div>`;

const INNER_RESPONSE = `
    <div class="response__content pop-up__content">
        <div class="response__close pop-up__close-block"><div class="pop-up__close"></div></div>
        <img src="img/response-succes.jpg" alt="" class="response__img">
        <h2 class="response__title title">Заказ оформлен</h2>
        <p class="response__text">Спасибо за Ваш заказ! Ждите пока с Вами свяжутся.</p>
        <button class="response__button button pop-up__close">Хорошо</button>
    </div>`;

const responseImgSuccess = "img/response-success.png";
const responseImgFail = "img/response-fail.png";

const responseTitleSuccess = "Форма отправлена";
const responseTitleReview = "Отзыв оставлен";
const responseTitleFail = "Что-то пошло не так";

const responseTextSuccess = "Спасибо за Ваше обращение! Ожидайте пока с Вами свяжуться";
const responseTextReview = "Спасибо за Ваш отзыв!";
const responseTextFail = "Попробуйте заполнить форму чуть позже";

export function popUpStart() {
  let popUpStarts = document.querySelectorAll(".pop-up-start");

  if (popUpStarts.length == 0) {
    return
  }

  for (const popUpStart of popUpStarts) {
    popUpStart.addEventListener("click", (e) => {
      initPopUp(popUpStart.getAttribute("data-popUp"), e)
    })
  }

}

export function initPopUp(typeForm, e = null, review = false, code = 2, message = "") {
  let section;
  if (document.querySelector(`.${typeForm}`) == null) {
    section = document.createElement("section");
  } else {
    section = document.querySelector(`.${typeForm}`);
  }


  section.classList.add(typeForm, "pop-up");
  document.body.append(section);
  showPopUp(section);
  switch (typeForm) {
    case "add-review":
      section.innerHTML = INNER_ADD_REVIEW;
      starsReview();
      break;
    case "feedback-pop-up":
      section.innerHTML = INNER_FEEDBACK;
      break;
    case "order":
      section.innerHTML = INNER_ORDER;
      let nameItem = e.target.parentNode.parentNode.querySelector(`[data-item="name"]`);
      let orderName = section.querySelector(".order-form__item-name");
      let titleItem = section.querySelector(".order-form__item-title");
      if (!(nameItem == null)) {
        nameItem = nameItem.textContent;
        console.log(titleItem.textContent);
        orderName.textContent = nameItem;
      console.log
      } else {
        let title;
        if (document.querySelector(".product-block__title") != null) {
          title = document.querySelector(".product-block__title").textContent;
          titleItem.textContent = `Заказать "${title}"`;
        } else {
          titleItem.textContent = "";
        }


      }

      let orderInput = section.querySelector(".order-form__item");
      orderInput.setAttribute("value", nameItem);

      break;

    case "response":
      section.innerHTML = INNER_RESPONSE;
      let img = section.querySelector(".response__img");
      let title = section.querySelector(".response__title");
      let text = section.querySelector(".response__text");
      if (code == 0) {
        img.setAttribute("src", location.origin + "/" + responseImgSuccess);
        if (review) {
          title.textContent = responseTitleReview;
          text.textContent = responseTextReview;
        } else {
          title.textContent = responseTitleSuccess;
          text.textContent = responseTextSuccess;
        }
      } else if (code == 1) {

        img.setAttribute("src", location.origin + "/" + responseImgFail);
        title.textContent = responseTitleFail;
        text.textContent = message;
      }
      break;
    default:
      return;
      break;
  }

  initForm();
  maskPhone();




  section.addEventListener("click", (e) => {
    let content = e.target.closest(".pop-up__content");
    if (content) {
      return;
    }
    hidePopUp(section);
  });

  window.addEventListener("keydown", (e) => {
    if (e.keyCode == KEY_ESC) {
      hidePopUp(section);
    }
  });

  let closeButtons = section.querySelectorAll(".pop-up__close")
  for (const button of closeButtons) {
    button.addEventListener("click", () => {
      hidePopUp(section);
    })
  }
}


let wrappers = document.querySelectorAll(".wrapper");
let noWrappers = document.querySelectorAll(".no-wrapper")
function showPopUp(popUp) {
  const WIDTH_WINDOW = window.innerWidth;
  const WIDTH_DOCUMENT = document.documentElement.clientWidth;
  const WIDTH_SCROLLBAR = WIDTH_WINDOW - WIDTH_DOCUMENT;
  document.body.style.overflow = "hidden";
  // document.body.style.paddingRight = `${WIDTH_SCROLLBAR}px`;
  for (let i = 0; i < wrappers.length; i++) {
    wrappers[i].style.paddingRight = `${WIDTH_SCROLLBAR}px`;
  }
  for (let i = 0; i < noWrappers.length; i++) {
    noWrappers[i].style.marginRight = `${WIDTH_SCROLLBAR}px`;
    noWrappers[i].querySelector(".wrapper") != null ? noWrappers[i].querySelector(".wrapper").style.paddingRight = 0 : "";
  }
  popUp.style.display = "block";
}

export function hidePopUp(popUp) {
  document.body.style.overflow = "auto"
  document.body.style.paddingRight = 0;
  for (let i = 0; i < wrappers.length; i++) {
    wrappers[i].style.paddingRight = 0;
  }
  for (let i = 0; i < noWrappers.length; i++) {
    noWrappers[i].style.marginRight = 0;
  }
  popUp.style.display = "none";
}

