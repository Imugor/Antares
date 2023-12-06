<header class="header">
   <div class="header__top-nav">
     <div class="wrapper">
       <div class="top-nav">
         <div class="top-nav__left">
           <a href="{{route('index')}}" class="top-nav__logo"><img src="{{asset('img/logo.png')}}" alt="Логотип Antares"
               class="top-nav__logo"></a>
           <div action="" class="top-nav__location location">

             @include('inc.choose_contact')

           </div>
         </div>
         <div class="top-nav__rigth">
           <div class="top-nav__phone-box phone-box">
             <img src="{{asset('img/phone.svg')}}" alt="" class="phone-box__icon">
             <p class="phone-box__phone">{{ $page_settings['choose_contact']->number ?? '+73472989848' }}</p>
           </div>
           <div class="top-nav__burger burger">
             <span></span>
             <span></span>
             <span></span>
           </div>
           <button class="top-nav__callback button pop-up-start" data-popUp="feedback-pop-up">Обратная связь</button>
         </div>
       </div>
     </div>
   </div>
   <div class="header__bottom-nav">
     <nav class="bottom-nav">
       <ul class="bottom-nav__link drop-down-list">
         <li class="drop-down-list__main">
           <div class="wrapper"><a class="bottom-nav__link bottom-nav__link_arrow ">Каталог</a></div>
         </li>
         <ul class="drop-down-list__links">
            <li class="drop-down-list__link">
               <div class="wrapper"><a href="{{route('catalog')}}" class="bottom-nav__link">Все категории</a></div>
            </li>
            @foreach ($page_settings['parent_categories'] as $item)
            <li class="drop-down-list__link">
               <div class="wrapper"><a href="{{route('catalog_category', ['slug'=>$item->slug, 'page'=>1])}}" class="bottom-nav__link">{{$item->name}}</a></div>
            </li>
           @endforeach
         </ul>
       </ul>
       <ul class="bottom-nav__link drop-down-list">
         <li class="drop-down-list__main">
           <div class="wrapper"><a class="bottom-nav__link bottom-nav__link_drop bottom-nav__link_arrow">О нас</a> </div>
         </li>
         <ul class="drop-down-list__links">
           <li class="drop-down-list__link">
             <div class="wrapper"><a href="{{route('about_company')}}" class="bottom-nav__link">О компании</a></div>
           </li>
           <li class="drop-down-list__link">
             <div class="wrapper"><a href="{{route('our_mission')}}" class="bottom-nav__link">Миссии компании</a></div>
           </li>
           <li class="drop-down-list__link">
             <div class="wrapper"><a href="{{route('contacts')}}" class="bottom-nav__link">Контакты</a></div>
           </li>
           <li class="drop-down-list__link">
             <div class="wrapper"><a href="{{route('reviews')}}" class="bottom-nav__link">Отзывы</a></div>
           </li>
         </ul>
       </ul>
       <ul class="bottom-nav__link drop-down-list">
         <li class="drop-down-list__main">
           <div class="wrapper"><a class="bottom-nav__link bottom-nav__link_drop bottom-nav__link_arrow">Полезно знать
             </a></div>
         </li>
         <ul class="drop-down-list__links">
           <li class="drop-down-list__link">
             <div class="wrapper"><a href="{{route('news')}}" class="bottom-nav__link">Новости</a></div>
           </li>
           <li class="drop-down-list__link">
             <div class="wrapper"><a href="{{route('articles')}}" class="bottom-nav__link">Статьи</a></div>
           </li>
           <li class="drop-down-list__link">
             <div class="wrapper"><a href="{{route('stocks')}}" class="bottom-nav__link">Акции</a></div>
           </li>
         </ul>
       </ul>
       <ul class="bottom-nav__link drop-down-list">
         <li class="drop-down-list__main">
           <div class="wrapper"><a href="{{route('vacancies')}}" class="bottom-nav__link">Вакансии</a></div>
         </li>
       </ul>
       <ul class="bottom-nav__link drop-down-list">
         <li class="drop-down-list__main">
           <div class="wrapper"><a href="{{route('partners')}}" class="bottom-nav__link">Партнеры</a></div>
         </li>
       </ul>
     </nav>
   </div>
 
   <div class="header__fixed-nav">
     <div class="fixed-nav">
       <div class="wrapper">
 
         <div class="fixed-nav__content">
           <a href="{{route('index')}}" class="top-nav__logo"><img src="{{asset('img/logo.png')}}" alt="Логотип Antares"
               class="top-nav__logo"></a>
           <div class="fixed-nav__flex">
             <div action="" class="fixed-nav__location location">
               @include('inc.choose_contact')
             </div>
             <div class="fixed-nav__burger burger">
               <span></span>
               <span></span>
               <span></span>
             </div>
           </div>
           <nav class="fixed-nav__bottom-nav bottom-nav">
             <ul class="bottom-nav__link drop-down-list">
               <li class="drop-down-list__main">
                 <div class="wrapper"><a href="{{route('catalog')}}" class="bottom-nav__link bottom-nav__link_arrow ">Каталог</a></div>
               </li>
               <ul class="drop-down-list__links">
                <li class="drop-down-list__link">
                   <div class="wrapper"><a href="{{route('catalog')}}" class="bottom-nav__link">Все категории</a></div>
                </li>
                  @foreach ($page_settings['parent_categories'] as $item)
                     <li class="drop-down-list__link">
                        <div class="wrapper"><a href="{{route('catalog_category', ['slug'=>$item->slug, 'page'=>1])}}" class="bottom-nav__link">{{$item->name}}</a></div>
                     </li>
                 @endforeach
               </ul>
             </ul>
             <ul class="bottom-nav__link drop-down-list">
               <li class="drop-down-list__main">
                 <div class="wrapper"><a class="bottom-nav__link bottom-nav__link_drop bottom-nav__link_arrow">О нас</a>
                 </div>
               </li>
               <ul class="drop-down-list__links">
                 <li class="drop-down-list__link">
                   <div class="wrapper"><a href="{{route('about_company')}}" class="bottom-nav__link">О компании</a></div>
                 </li>
                 <li class="drop-down-list__link">
                   <div class="wrapper"><a href="{{route('our_mission')}}" class="bottom-nav__link">Миссии компании</a></div>
                 </li>
                 <li class="drop-down-list__link">
                   <div class="wrapper"><a href="{{route('contacts')}}" class="bottom-nav__link">Контакты</a></div>
                 </li>
                 <li class="drop-down-list__link">
                   <div class="wrapper"><a href="{{route('reviews')}}" class="bottom-nav__link">Отзывы</a></div>
                 </li>
               </ul>
             </ul>
             <ul class="bottom-nav__link drop-down-list">
               <li class="drop-down-list__main">
                 <div class="wrapper"><a class="bottom-nav__link bottom-nav__link_drop bottom-nav__link_arrow">Полезно
                     знать </a></div>
               </li>
               <ul class="drop-down-list__links">
                 <li class="drop-down-list__link">
                   <div class="wrapper"><a href="{{route('news')}}" class="bottom-nav__link">Новости</a></div>
                 </li>
                 <li class="drop-down-list__link">
                   <div class="wrapper"><a href="{{route('articles')}}" class="bottom-nav__link">Статьи</a></div>
                 </li>
                 <li class="drop-down-list__link">
                   <div class="wrapper"><a href="{{route('stocks')}}" class="bottom-nav__link">Акции</a></div>
                 </li>
               </ul>
             </ul>
             <ul class="bottom-nav__link drop-down-list">
               <li class="drop-down-list__main">
                 <div class="wrapper"><a href="{{route('vacancies')}}" class="bottom-nav__link">Вакансии</a></div>
               </li>
             </ul>
             <ul class="bottom-nav__link drop-down-list">
               <li class="drop-down-list__main">
                 <div class="wrapper"><a href="{{route('partners')}}" class="bottom-nav__link">Партнеры</a></div>
               </li>
             </ul>
           </nav>
           <button class="fixed-nav__callback button pop-up-start" data-popUp="feedback-pop-up">Обратная связь</button>
         </div>
       </div>
     </div>
   </div>
 </header>