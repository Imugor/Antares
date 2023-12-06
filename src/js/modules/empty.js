import { getScrollHeight } from "./functions.js";

export function initCheckEmpty() {
  let heightWidnow = window.innerHeight;
  let heightPage = document.body.clientHeight;

  if (heightWidnow > heightPage) {
    addMargin(heightWidnow - heightPage);
  }
}

function addMargin(margin) {
  let footer = document.querySelector(".footer");

  footer.style.marginTop = margin +"px";
}
