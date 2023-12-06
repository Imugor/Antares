export function initStars() {
    let reviewsStars = document.querySelectorAll(".stars");
    if (reviewsStars == null) {
        return;
    }
    getRatingStars(reviewsStars);
}



function getRatingStars(reviews) {
  for (let i = 0; i < reviews.length; i++) {
    let rating;
    if (reviews[i].getAttribute("data-rating") != null) {
        rating = +reviews[i].getAttribute("data-rating");
    } else {
        if (reviews[i].parentNode.querySelector(".rating") == null) {
            return
        }
        rating = reviews[i].parentNode.querySelector(".rating").firstChild.textContent;
        rating = rating.slice(0,1);
    }
    let stars = reviews[i].querySelectorAll("svg");
    fillStars(stars,rating)
  }
}

export function starsReview() {
    let starsBlock = document.querySelector(".add-review__stars");
    let stars = starsBlock.querySelectorAll("svg");
    let parent = starsBlock.parentNode;
    let text = parent.querySelector(".add-review__stars-text");

    fillStars(stars,5);
    changeReviewText(text, 5);

    for (let i = 0; i < stars.length; i++) {
        stars[i].addEventListener("click", () => {
            cleanStars(stars);
            fillStars(stars,i + 1);
            let form = parent.querySelector("form");
            let rating;
            changeReviewText(text, i+1);
            if (form.querySelector(".form-review__rating") == null) {
                rating = document.createElement("input");
                rating.classList.add("form-review__rating");
                rating.setAttribute("name", "rating");
                rating.setAttribute("type", "hidden");
            } else {
                rating = form.querySelector(".form-review__rating");
            }

            rating.setAttribute("value", i+1);

            form.prepend(rating);
        })

    }
}

function fillStars(stars, rating) {
    for (let i = 0; i < rating; i++) {
        stars[i].style.fill = "#F0A229";
      }
}

function cleanStars(stars) {
    for (let i = 0; i < stars.length; i++) {
        stars[i].style.fill = "#C7C3BE";
      }
}

function changeReviewText(string, rating) {
    switch (rating) {
        case 1:
            string.textContent = "Расскажите с какими проблемами вы столкнулись";
            break;
        case 2:
            string.textContent = "Поделитесь тем, что Вас не устроило";
            break;
        case 3:
            string.textContent = "Поделитесь тем, что могло быть лучше";
            break;
        case 4:
            string.textContent = "Поделитесь тем, что Вам понравилось";
            break;
        case 5:
            string.textContent = "Поделитесь тем, от чего вы именно восторге";
            break;

        default:
            break;
    }
}
