 <footer class="footer">
   <div class="wrapper">
     <div class="footer__footer-content footer-content">
       <ul class="footer-content__footer-links footer-links">
         <li class="footer-links__main-link">
           <div class="footer__wrapper footer__wrapper_underline"><a
               class="footer-links__link footer-links__link_arrow">Каталог</a></div>
         </li>
         <ul class="footer-links__sub-links">
            <li class="footer-links__sub-link">
              <div class="footer__wrapper footer__wrapper_underline"><a href="{{route('catalog')}}" class="footer-links__link">Все категории</a></div>
            </li>
            @foreach ($page_settings['parent_categories'] as $item)
           <li class="footer-links__sub-link">
             <div class="footer__wrapper footer__wrapper_underline"><a href="{{route('catalog_category', ['slug'=>$item->slug, 'page'=>1])}}" class="footer-links__link">{{$item->name}}</a></div>
           </li>
           @endforeach
         </ul>
       </ul>
       <ul class="footer-content__footer-links footer-links">
         <li class="footer-links__main-link">
           <div class="footer__wrapper footer__wrapper_underline"><a
               class="footer-links__link footer-links__link_arrow">О нас</a></div>
         </li>
         <ul class="footer-links__sub-links">
           <li class="footer-links__sub-link">
             <div class="footer__wrapper footer__wrapper_underline"><a href="{{route('about_company')}}" class="footer-links__link">О
                 компании</a></div>
           </li>
           <li class="footer-links__sub-link">
             <div class="footer__wrapper footer__wrapper_underline"><a href="{{route('our_mission')}}" class="footer-links__link">Миссия
                 компании</a></div>
           </li>
           <li class="footer-links__sub-link">
             <div class="footer__wrapper footer__wrapper_underline"><a href="{{route('contacts')}}" class="footer-links__link">Контакты</a>
             </div>
           </li>
           <li class="footer-links__sub-link">
             <div class="footer__wrapper footer__wrapper_underline"><a href="{{route('reviews')}}" class="footer-links__link">Отзывы</a>
             </div>
           </li>
         </ul>
       </ul>
       <ul class="footer-content__footer-links footer-links">
         <li class="footer-links__main-link">
           <div class="footer__wrapper footer__wrapper_underline"><a
               class="footer-links__link footer-links__link_arrow">Полезно знать</a>
         </li>
         <ul class="footer-links__sub-links">
           <li class="footer-links__sub-link">
             <div class="footer__wrapper footer__wrapper_underline"><a href="{{route('news')}}" class="footer-links__link">Новости</a>
             </div>
           </li>
           <li class="footer-links__sub-link">
             <div class="footer__wrapper footer__wrapper_underline"><a href="{{route('articles')}}" class="footer-links__link">Статьи</a>
             </div>
           </li>
           <li class="footer-links__sub-link">
             <div class="footer__wrapper footer__wrapper_underline"><a href="{{route('stocks')}}" class="footer-links__link">Акции</a></div>
           </li>
         </ul>
       </ul>
       <ul class="footer-content__footer-links footer-links">
         <li class="footer-links__main-link">
           <div class="footer__wrapper footer__wrapper_underline"><a href="{{route('vacancies')}}" class="footer-links__link">Вакансии</a>
           </div>
         </li>
       </ul>
       <ul class="footer-content__footer-links footer-links">
         <li class="footer-links__main-link">
           <div class="footer__wrapper footer__wrapper_underline"><a href="{{route('partners')}}" class="footer-links__link">Партнеры</a>
           </div>
         </li>
       </ul>
       <div class="footer-content__delimetr"></div>
       <div class="footer__wrapper">
         <div class="footer-content__footer-contact footer-contact">
           <h3 class="footer-contact__title">Контакты</h3>
           <div class="footer-contact__phone-box phone-box">
             <img src="{{ asset('img/phone.svg') }}" alt="" class="phone-box__icon">
             <p class="phone-box__phone">{{ $page_settings['choose_contact']->number ?? '+73472989848'  }}</p>
           </div>
           <div class="footer-contact__email-box email-box">
             <img src="{{ asset('img/mail.svg') }}" alt="" class="email-box__icon">
             <p class="phone-box__phone">{{ $page_settings['choose_contact']->email ?? 'zakaz@oooantares.com'  }}</p>
           </div>
           <div class="footer-contact__social-box social-box">
             <p class="social-box__text">Мы в социальных сетях</p>
             <div class="social-box__flex">
               <div class="social-box__item">
                 <a href="{{$page_settings['links']['tg']}}"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"
                     fill="none">
                     <rect x="3" y="3" width="26" height="26" rx="13" fill="white" />
                     <path
                       d="M15.9993 2.66602C8.63935 2.66602 2.66602 8.63935 2.66602 15.9993C2.66602 23.3593 8.63935 29.3327 15.9993 29.3327C23.3593 29.3327 29.3327 23.3593 29.3327 15.9993C29.3327 8.63935 23.3593 2.66602 15.9993 2.66602ZM22.186 11.7327C21.986 13.8393 21.1193 18.9593 20.6793 21.3193C20.4927 22.3193 20.1193 22.6527 19.7727 22.6927C18.9993 22.7593 18.4127 22.186 17.666 21.6927C16.4927 20.9193 15.826 20.4393 14.6927 19.6927C13.3727 18.826 14.226 18.346 14.986 17.5727C15.186 17.3727 18.5993 14.266 18.666 13.986C18.6753 13.9436 18.674 13.8996 18.6624 13.8578C18.6508 13.8159 18.6292 13.7776 18.5993 13.746C18.5193 13.6793 18.4127 13.706 18.3193 13.7193C18.1993 13.746 16.3327 14.986 12.6927 17.4393C12.1593 17.7993 11.6793 17.986 11.2527 17.9727C10.7727 17.9593 9.86601 17.706 9.18602 17.4793C8.34601 17.2127 7.69268 17.066 7.74602 16.5993C7.77268 16.3593 8.10602 16.1193 8.73268 15.866C12.626 14.1727 15.2127 13.0527 16.506 12.5193C20.2127 10.9727 20.9727 10.706 21.4793 10.706C21.586 10.706 21.8393 10.7327 21.9993 10.866C22.1327 10.9727 22.1727 11.1193 22.186 11.226C22.1727 11.306 22.1993 11.546 22.186 11.7327Z"
                       fill="#E74F42" />
                   </svg></a>
 
               </div>
               <div class="social-box__item">
                 <a href="{{$page_settings['links']['vk']}}">
                   <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                     <rect x="3" y="3" width="26" height="26" rx="6" fill="white" />
                     <path
                       d="M20.0967 2.66602H11.9153C4.44335 2.66602 2.66602 4.44335 2.66602 11.902V20.0833C2.66602 27.554 4.43002 29.3327 11.902 29.3327H20.0833C27.554 29.3327 29.3327 27.5687 29.3327 20.0967V11.9153C29.3327 4.44335 27.5687 2.66602 20.0967 2.66602ZM24.194 21.6927H22.2487C21.5127 21.6927 21.2913 21.0967 19.9713 19.7767C18.8193 18.666 18.3327 18.5273 18.0407 18.5273C17.638 18.5273 17.5273 18.638 17.5273 19.194V20.9433C17.5273 21.4167 17.374 21.694 16.138 21.694C14.9385 21.6134 13.7752 21.249 12.7441 20.6307C11.713 20.0125 10.8436 19.1581 10.2073 18.138C8.69691 16.258 7.64594 14.0515 7.13802 11.694C7.13802 11.402 7.24868 11.138 7.80468 11.138H9.74868C10.2487 11.138 10.4287 11.3607 10.6247 11.874C11.5687 14.6527 13.1793 17.0687 13.8327 17.0687C14.0833 17.0687 14.1927 16.958 14.1927 16.3327V13.4713C14.11 12.166 13.4167 12.0553 13.4167 11.5833C13.4256 11.4589 13.4826 11.3427 13.5757 11.2596C13.6688 11.1764 13.7906 11.1328 13.9153 11.138H16.9713C17.3887 11.138 17.5273 11.346 17.5273 11.846V15.7073C17.5273 16.1247 17.7073 16.2633 17.8327 16.2633C18.0833 16.2633 18.2767 16.1247 18.7353 15.666C19.7205 14.4646 20.5254 13.1261 21.1247 11.6927C21.1859 11.5205 21.3018 11.3731 21.4547 11.2729C21.6076 11.1728 21.789 11.1254 21.9713 11.138H23.9167C24.4993 11.138 24.6233 11.43 24.4993 11.846C23.792 13.4306 22.9168 14.9347 21.8887 16.3327C21.6793 16.6527 21.5953 16.8193 21.8887 17.194C22.082 17.486 22.7633 18.0553 23.222 18.5967C23.8886 19.2615 24.4421 20.0308 24.8607 20.874C25.0273 21.4153 24.7487 21.6927 24.194 21.6927Z"
                       fill="#E74F42" />
                   </svg>
                 </a>
 
               </div>
               <div class="social-box__item">
                 <a href="{{$page_settings['links']['inst']}}"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"
                     fill="none">
                     <rect x="3" y="3" width="26" height="26" rx="7" fill="white" />
                     <path
                       d="M17.3708 2.66766C18.3438 2.66392 19.3167 2.6737 20.2895 2.69699L20.5481 2.70632C20.8468 2.71699 21.1415 2.73032 21.4975 2.74632C22.9161 2.81299 23.8841 3.03699 24.7335 3.36632C25.6135 3.70499 26.3548 4.16366 27.0961 4.90499C27.774 5.57113 28.2986 6.37692 28.6335 7.26632C28.9628 8.11566 29.1868 9.08499 29.2535 10.5037C29.2695 10.8583 29.2828 11.1543 29.2935 11.453L29.3015 11.7117C29.3251 12.6839 29.3354 13.6565 29.3321 14.629L29.3335 15.6237V17.3703C29.3367 18.3433 29.3265 19.3163 29.3028 20.289L29.2948 20.5477C29.2841 20.8463 29.2708 21.141 29.2548 21.497C29.1881 22.9157 28.9615 23.8837 28.6335 24.733C28.2997 25.6233 27.7749 26.4298 27.0961 27.0957C26.4294 27.7734 25.6232 28.298 24.7335 28.633C23.8841 28.9623 22.9161 29.1863 21.4975 29.253C21.1415 29.269 20.8468 29.2823 20.5481 29.293L20.2895 29.301C19.3168 29.3247 18.3438 29.3349 17.3708 29.3317L16.3761 29.333H14.6308C13.6578 29.3363 12.6848 29.3261 11.7121 29.3023L11.4535 29.2943C11.1369 29.2828 10.8205 29.2695 10.5041 29.2543C9.08545 29.1877 8.11745 28.961 7.26678 28.633C6.37703 28.2988 5.5711 27.7741 4.90545 27.0957C4.22685 26.4294 3.70175 25.6231 3.36679 24.733C3.03745 23.8837 2.81345 22.9157 2.74678 21.497C2.73194 21.1806 2.7186 20.8642 2.70678 20.5477L2.70012 20.289C2.67554 19.3163 2.66442 18.3433 2.66678 17.3703V14.629C2.66306 13.6565 2.67284 12.6839 2.69612 11.7117L2.70545 11.453C2.71612 11.1543 2.72945 10.8583 2.74545 10.5037C2.81212 9.08366 3.03612 8.11699 3.36545 7.26632C3.70062 6.37648 4.22674 5.57092 4.90679 4.90632C5.57198 4.22733 6.3774 3.70175 7.26678 3.36632C8.11745 3.03699 9.08412 2.81299 10.5041 2.74632L11.4535 2.70632L11.7121 2.69966C12.6844 2.67509 13.6569 2.66397 14.6295 2.66632L17.3708 2.66766ZM16.0001 9.33432C15.1168 9.32183 14.2398 9.48502 13.4201 9.81441C12.6004 10.1438 11.8543 10.6328 11.2252 11.2531C10.5962 11.8733 10.0967 12.6124 9.7557 13.4273C9.41475 14.2423 9.23917 15.1169 9.23917 16.0003C9.23917 16.8837 9.41475 17.7583 9.7557 18.5733C10.0967 19.3883 10.5962 20.1273 11.2252 20.7476C11.8543 21.3678 12.6004 21.8568 13.4201 22.1862C14.2398 22.5156 15.1168 22.6788 16.0001 22.6663C17.7682 22.6663 19.4639 21.9639 20.7142 20.7137C21.9644 19.4635 22.6668 17.7678 22.6668 15.9997C22.6668 14.2315 21.9644 12.5359 20.7142 11.2856C19.4639 10.0354 17.7682 9.33432 16.0001 9.33432ZM16.0001 12.001C16.5315 11.9912 17.0594 12.0874 17.5532 12.2839C18.0469 12.4805 18.4966 12.7734 18.8758 13.1457C19.2551 13.518 19.5564 13.9621 19.762 14.4521C19.9677 14.9421 20.0737 15.4682 20.0738 15.9996C20.0739 16.5311 19.9681 17.0572 19.7626 17.5473C19.557 18.0374 19.2559 18.4816 18.8768 18.854C18.4976 19.2264 18.0481 19.5195 17.5544 19.7162C17.0607 19.9129 16.5328 20.0093 16.0015 19.9997C14.9406 19.9997 13.9232 19.5782 13.173 18.8281C12.4229 18.0779 12.0015 17.0605 12.0015 15.9997C12.0015 14.9388 12.4229 13.9214 13.173 13.1712C13.9232 12.4211 14.9406 11.9997 16.0015 11.9997L16.0001 12.001ZM23.0001 7.33432C22.57 7.35154 22.1632 7.53452 21.8649 7.84495C21.5667 8.15538 21.4001 8.56917 21.4001 8.99966C21.4001 9.43014 21.5667 9.84393 21.8649 10.1544C22.1632 10.4648 22.57 10.6478 23.0001 10.665C23.4421 10.665 23.8661 10.4894 24.1786 10.1768C24.4912 9.86427 24.6668 9.44035 24.6668 8.99832C24.6668 8.55629 24.4912 8.13237 24.1786 7.81981C23.8661 7.50725 23.4421 7.33166 23.0001 7.33166V7.33432Z"
                       fill="#E74F42" />
                   </svg></a>
 
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
   <div class="footer__company">
     <h2 class="footer__company-name">ООО Антарес</h2>
   </div>
 </footer>
 <div class="scroll-button button-nav">
     <div class="scroll-button__content"></div>
 </div>
 <script>
  (function(w,d,u){
          var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
          var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
  })(window,document,'https://cdn-ru.bitrix24.ru/b12270884/crm/site_button/loader_1_7yezx1.js');
</script>
