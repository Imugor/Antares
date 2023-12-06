
export function scrollAncorInit() {
  if (document.querySelector(".article-contents__link") == null) {
    return;
  }

  let links = document.querySelectorAll(".article-contents__link");
  let titles = document.querySelector(".article-info-text").querySelectorAll("h2, h3, h4, h5, h6");

  for (let i = 0; i < links.length; i++) {
    console.log(titles[i].offsetTop);
    links[i].addEventListener("click", () => {
      let posTitlteY = titles[i].offsetTop
      let scrollPx = posTitlteY - 100;
      window.scrollTo(0, scrollPx);
    })

  }
}

export function scrollButtonInit() {
  let scrollButton = document.querySelector(".scroll-button");
  if (scrollButton == null) {
    return
  }
  scrollTop(scrollButton);
}

function scrollTop(elem) {
  elem.addEventListener("click", () => {
    window.scrollTo(0, 0);
  })
}
