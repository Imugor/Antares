@extends('layouts.app')

@section('title')Наши контакты @endsection

@section('container')
<section class="contact">
    <div class="wrapper">
        <div class="contact__contact-content contact-content">
          <div class="contact-content__breadcrumb breadcrumb">
          @include('inc.breadcrumbs')
          </div>
            <h2 class="contact-content__title title">Контакты</h2>
            <div class="contact-content__flex">
               <div class="contact-content__feedback-content feedback-content">
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
                      <textarea type="text" class="feedback-form__message" name="message" placeholder="Сообщение"
                        contenteditable></textarea>
                      <input type="submit" class="feedback-form__submit button" value="Отправить">
                      <p class="feedback-form__agreement">Нажимая кнопку “<span class="feedback-form__agreement_bold">
                          Отправить</span>”, вы даете согласие на обработку и хранение <a href="{{route('article', ['slug' => 'politika-konfidencialnosti'])}}"
                          class="feedback-form__agreement_link">персональных данных</a></p>
                    </div>
                  </form>
                </div>
                 <div class="contact-content__address-content address-content">
                    {!!$page_settings['choose_contact']->geoposition!!}
                    <div action="" class="contact-content__location location">
                     <form action="{{ route('replace_city') }}" class="location__form-city form-city" id="form-city">
                        @csrf
                        <div class="form-city__title-content" data-state="">
                           <h3 class="form-city__title" data-default="{{$page_settings['choose_contact']->city}}">{{$page_settings['choose_contact']->city}}</h3>

                        <div class="form-city__content">
                           <input type="radio" class="form-city__select-input" id="">
                           <label for="" class="form-city__select-label"></label>
                           @foreach ($page_settings['contacts'] as $item)
                            <input type="radio" class="form-city__select-input" id="{{$item->id}}">
                              <label for="{{$item->id}}" class="form-city__select-label">{{$item->city}}</label>
                           @endforeach
                        </div>
                     </div>
                     </form>
                  </div>
                  <div class="address-content__info">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                        <path d="M16.6668 2.66797C13.6621 2.67141 10.7815 3.83144 8.65688 5.89359C6.53223 7.95575 5.33705 10.7516 5.33351 13.668C5.32991 16.0512 6.13197 18.3698 7.61666 20.268C7.61666 20.268 7.92575 20.663 7.97623 20.72L16.6668 30.668L25.3615 20.715C25.4069 20.662 25.717 20.268 25.717 20.268L25.718 20.265C27.202 18.3676 28.0037 16.0501 28.0002 13.668C27.9966 10.7516 26.8014 7.95575 24.6768 5.89359C22.5521 3.83144 19.6715 2.67141 16.6668 2.66797ZM16.6668 17.668C15.8517 17.668 15.0549 17.4334 14.3772 16.9938C13.6995 16.5543 13.1713 15.9296 12.8593 15.1987C12.5474 14.4678 12.4658 13.6635 12.6248 12.8876C12.7838 12.1117 13.1763 11.399 13.7527 10.8395C14.3291 10.2801 15.0634 9.89917 15.8628 9.74483C16.6623 9.59049 17.4909 9.6697 18.2439 9.97245C18.997 10.2752 19.6406 10.7879 20.0935 11.4457C20.5463 12.1035 20.788 12.8768 20.788 13.668C20.7867 14.7284 20.352 15.7451 19.5795 16.4949C18.8069 17.2448 17.7594 17.6666 16.6668 17.668Z" fill="#E74F42"/>
                    </svg>
                    <p class="address-content__text">{{$page_settings['choose_contact']->address}}</p>
                  </div>
                  <div class="address-content__info">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                        <path d="M22.0745 17.2093L21.4678 17.8133C21.4678 17.8133 20.0238 19.2479 16.0838 15.3306C12.1438 11.4133 13.5878 9.97861 13.5878 9.97861L13.9692 9.59727C14.9118 8.66127 15.0012 7.15727 14.1785 6.05861L12.4985 3.81461C11.4798 2.45461 9.51317 2.27461 8.34651 3.43461L6.25317 5.51461C5.67584 6.09061 5.28917 6.83461 5.33584 7.66127C5.45584 9.77727 6.41317 14.3279 11.7518 19.6373C17.4145 25.2666 22.7278 25.4906 24.8998 25.2879C25.5878 25.2239 26.1852 24.8746 26.6665 24.3946L28.5598 22.5119C29.8398 21.2413 29.4798 19.0613 27.8425 18.1719L25.2958 16.7866C24.2212 16.2026 22.9145 16.3746 22.0745 17.2093Z" fill="#E74F42"/>
                    </svg>
                    <p class="address-content__text">{{$page_settings['choose_contact']->number}}</p>

                  </div>
                  <div class="address-content__info">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                        <path d="M26.6665 5.33203H5.33317C3.8665 5.33203 2.67984 6.53203 2.67984 7.9987L2.6665 23.9987C2.6665 25.4654 3.8665 26.6654 5.33317 26.6654H26.6665C28.1332 26.6654 29.3332 25.4654 29.3332 23.9987V7.9987C29.3332 6.53203 28.1332 5.33203 26.6665 5.33203ZM26.1332 10.9987L16.7065 16.892C16.2798 17.1587 15.7198 17.1587 15.2932 16.892L5.8665 10.9987C5.73281 10.9236 5.61573 10.8222 5.52236 10.7006C5.42898 10.579 5.36125 10.4397 5.32327 10.2912C5.28529 10.1426 5.27784 9.98795 5.30138 9.83644C5.32492 9.68494 5.37895 9.53978 5.46021 9.40977C5.54147 9.27975 5.64827 9.16757 5.77414 9.08002C5.90001 8.99248 6.04233 8.93138 6.1925 8.90043C6.34266 8.86948 6.49755 8.86932 6.64778 8.89996C6.79801 8.9306 6.94045 8.99141 7.0665 9.0787L15.9998 14.6654L24.9332 9.0787C25.0592 8.99141 25.2017 8.9306 25.3519 8.89996C25.5021 8.86932 25.657 8.86948 25.8072 8.90043C25.9573 8.93138 26.0997 8.99248 26.2255 9.08002C26.3514 9.16757 26.4582 9.27975 26.5395 9.40977C26.6207 9.53978 26.6748 9.68494 26.6983 9.83644C26.7218 9.98795 26.7144 10.1426 26.6764 10.2912C26.6384 10.4397 26.5707 10.579 26.4773 10.7006C26.3839 10.8222 26.2669 10.9236 26.1332 10.9987Z" fill="#E74F42"/>
                    </svg>
                    <p class="address-content__text">{{$page_settings['choose_contact']->email}}</p>

                  </div>
                 </div>
            </div>
        </div>
    </div>
</section>
@endsection