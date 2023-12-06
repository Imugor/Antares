<nav class="breadcrumb">
    <a href="{{route('index')}}" class="breadcrumb__link">Главная</a>
    @if (isset($page_settings['breadcrumbs']) && $page_settings['breadcrumbs'] != null)
    {!!$page_settings['breadcrumbs']!!}
    @endif
</nav>