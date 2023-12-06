
export function changeHeightProject() {
  if (document.querySelector(".project-slide") == null) {
    return
  }

  let slides = document.querySelectorAll(".project-slide");

  let maxHeight = 0;
  let maxWidth = 0;
  setTimeout(() => {
  for (const slide of slides) {
    let height = slide.clientHeight;

    if (height > maxHeight) {
      maxHeight = height;
    }
  }

    for (const slide of slides) {
      slide.style.height = maxHeight + "px";
    }
  }, 1000);

}
