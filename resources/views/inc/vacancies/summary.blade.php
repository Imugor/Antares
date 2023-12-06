<div class="vacancies-list__summary summary">
   <h2 class="summary__title">Отправьте резюме</h2>
   <p class="summary__text">Заполните форму и отправьте нам. <br>Мы всегда в поисках крутых специалистов.</p>
   <form action="" class="summary__summary-form summary-form form">
    @csrf
    <div class="summary-form__grid">
      <input type="hidden" name="typeForm" value="summary">
      <div class="summary-form__inputbox inputbox summary-form__name">
        <input type="text" class="summary-form__input-name" name="name" placeholder="Имя">
        <p class="inputbox__error"></p>
      </div>
      <div class="summary-form__inputbox inputbox summary-form__second-name">
        <input type="text" class="summary-form__input-second-name" name="secondName" placeholder="Фамилия">
        <p class="inputbox__error"></p>
      </div>
      <div class="summary-form__inputbox inputbox summary-form__phone">
        <input type="tel" class="summary-form__input-phone" name="phone" placeholder="Телефон">
        <p class="inputbox__error"></p>
      </div>
      <div class="summary-form__inputbox inputbox summary-form__mail">
        <input type="text" class="summary-form__input-mail" name="email" placeholder="Почта">
        <p class="inputbox__error"></p>
      </div>
      <div class="summary-form__inputbox inputbox summary-form__vacancy">
        <input type="text" class="summary-form__input-vacancy" name="vacancy" placeholder="Вакансия">
        <p class="inputbox__error"></p>
      </div>
      <textarea type="text" class="summary-form__message" name="message" placeholder="Сообщение"
        contenteditable></textarea>
      <p class="summary-form__agreement">Нажимая кнопку “<span class="summary-form__agreement_bold">
          Отправить</span>”, вы даете согласие на обработку и хранение <a href="{{route('article', ['slug' => 'politika-konfidencialnosti'])}}"
          class="summary-form__agreement_link">персональных данных</a></p>
      <input type="submit" class="summary-form__submit button" value="Отправить">
    </div>
  </form>
 </div>