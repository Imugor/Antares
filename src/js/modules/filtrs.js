import { toggleClass } from "./functions.js";

export function filtrInit() {
    let button = document.querySelector(".category-top-settings__filtr");

    if (button == null) {
      return;
    }

    // if (document.documentElement.offsetWidth <= 420) {
    //   setHeightMobileSettings();
    // }

    let buttons = [button, document.querySelector(".category-aside__close")];
    for (const button of buttons) {
      button.addEventListener("click", (e) =>{
        e.preventDefault();
        let body = document.querySelector("body");
        let filtrs = document.querySelector(".category-aside");
        toggleClass(filtrs, "active");
        toggleClass(body, "blocked");
      })
    }

}
