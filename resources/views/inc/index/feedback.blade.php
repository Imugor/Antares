<section class="feedback">
  <div class="no-wrapper">
    <div class="wrapper">
      <div class="feedback__feedback-content feedback-content">
        <form class="feedback-content__feedback-form feedback-form form" id="feedback">
          @csrf
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
                Отправить</span>”, вы даете согласие на обработку и хранение <a href="{{route('article', ['slug' => 'politika-konfidencialnosti'])}}"
                class="feedback-form__agreement_link">персональных данных</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>