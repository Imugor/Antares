import { hidePopUp, initPopUp } from "./popUp.js";

// отправка формы
export function initForm() {
  let submits = document.querySelectorAll(".form");

  if (submits == null) {
    return;
  }

  for (let i = 0; i < submits.length; i++) {
    let submit = submits[i];
    submit.onsubmit = async function (e) {
      e.preventDefault();
      let form = submit.closest("form");
      let _token = document.getElementById('form-city').elements._token.value;
      let typeForm = form.elements.typeForm.value;
      let json;
      let response;
      if (!checkForm(form)) {
        return;
      }
      switch (typeForm) {
        case "feedback":
          json = {
            "typeForm": typeForm,
            "_token": _token,
            "name": form.elements.name.value,
            "phone": form.elements.phone.value,
            "email": form.elements.email.value,
            "message": form.elements.message.value,
          }
          response = sendForm(json, "add-lead");
          showResponse(response, false, form);
          break;
        case "summary":
          json = {
            "typeForm": typeForm,
            "_token": _token,
            "name": form.elements.name.value,
            "vacancy": form.elements.vacancy.value,
            "secondName": form.elements.secondName.value,
            "phone": form.elements.phone.value,
            "email": form.elements.email.value,
            "message": form.elements.message.value,
          }
          response = sendForm(json, "add-resume");
          showResponse(response, false, form);
          break;
        case "add-review":
          json = {
            "typeForm": typeForm,
            "_token": _token,
            "name": form.elements.name.value,
            "secondName": form.elements.secondName.value,
            "phone": form.elements.phone.value,
            "email": form.elements.email.value,
            "message": form.elements.message.value,
            "rating": form.elements.rating.value,
          }
          response = sendForm(json, "/reviews/add");
          showResponse(response, true, form);
          break;

        case "order":
          json = {
            "typeForm": typeForm,
            "_token": _token,
            "name": form.elements.name.value,
            "phone": form.elements.phone.value,
            "email": form.elements.email.value,
            "message": "Хочу заказать " + form.elements.message.value,
          }
          response = sendForm(json, "/add-lead");
          showResponse(response, false, form);
          break;

        default:
          break;
      }
    }

  }
}

async function sendForm(json, path) {
  let response = await fetch(path, {
    referrer: "origin",
    method: "POST",
    headers: {
      'Content-Type': 'application/json;charset=utf-8',
      "Accept": "applications/json",
    },
    body: JSON.stringify(json)
  });


  return await response.json();
}

function showResponse(response, review, form) {
  let result;
  response.then(function (value) {
    if (value.code == 0) {
      initPopUp("response", null, review, 0);
      form.reset();
      let popUp = form.closest(".pop-up");
      hidePopUp(popUp);
    } else {
      initPopUp("response", null, review, 1, value.message);
      console.error(value.message);
    }

  })

}

function checkForm(form) {
  let elements = form.elements;
  let check = true;

  for (const elem of elements) {


    switch (elem.name) {
      case "name":
        if (checkName(elem.value) == "Введите Ваше имя") {
          showError(elem, checkName(elem.value));
          check = false;
        } else {
          hideError(elem);
        }
        break;
      case "email":
        if (checkEmail(elem.value) == "Введите email" || checkEmail(elem.value) == "Неверно введен email") {
          showError(elem, checkEmail(elem.value));
          check = false;
        } else {
          hideError(elem);
        }
        break;
      case "phone":
        if (checkPhone(elem.value) == "Введите номер телефона" || checkPhone(elem.value) == "Неверно введен телефон") {
          showError(elem, checkPhone(elem.value));
          check = false;
        } else {
          hideError(elem);
        }
        break;
      case "message":
        break;
      case "secondName":
        if (checkSecondName(elem.value) == "Введите Вашу фамилию") {
          showError(elem, checkSecondName(elem.value));
          check = false;
        } else {
          hideError(elem);
        }
        break;
      case "vacancy":
        if (checkVacancy(elem.value) == "Введите интересующую вакансию") {
          showError(elem, checkVacancy(elem.value));
          check = false;
        } else {
          hideError(elem);
        }
        break;

      default:
        break;
    }
  }
  return check;
}

// Проверка ввода имени
function checkName(name) {
  let response = "Введите Ваше имя";
  if (name.trim() == "") {
    return response;
  }
  return name;
}
// Провекра фамилии
function checkSecondName(name) {
  let response = "Введите Вашу фамилию";
  if (name.trim() == "") {
    return response;
  }
  return name;
}
// Проверка вакансии
function checkVacancy(name) {
  let response = "Введите интересующую вакансию";
  if (name.trim() == "") {
    return response;
  }
  return name;
}

// Проверка ввода номера телефона
function checkPhone(phone) {
  let response = "Неверно введен телефон";
  if (phone == "") {
    return response = "Введите номер телефона";
  }

  // Проверка на полноту номера телефона
  let result = phone.match(/\d/g);
  if (result.length != 11) {
    return response;
  }
  result = result.join("");
  return result;
}

//Проверка Почты
function checkEmail(email) {
  let response = "Неверно введен email";
  if (email.trim() == "") {
    return response = "Введите email";
  }

  let regEmail = /.+@\w+\.\w+/;

  if (email.match(regEmail)) {
    return email;
  } else {
    return response;
  }
}


// Добавляет класс к контейнеру неправильно веденного input
function showError(elem, error) {
  let inputBox = elem.closest(".inputbox");
  let errorMessage = inputBox.querySelector(".inputbox__error");

  inputBox.classList.add("inputbox_error");

  errorMessage.textContent = error;
}
// Прячет сообщение о некорретности данных
function hideError(elem) {
  let inputBox = elem.closest(".inputbox");


  if (inputBox.classList.contains("inputbox_error")) {
    inputBox.classList.remove("inputbox_error");
  }
}
