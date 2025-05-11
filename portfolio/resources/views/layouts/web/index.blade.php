<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <link rel="icon" href="{{asset('assets/web/hostit/images/fevicon.png')}}" type="image/gif" />
    <title>Appiki</title>
    @include('layouts.web.header_css')
    @include('layouts.web.seo_meta')
    @stack('header_css')
</head>

<body>
    <!-- Theme Options -->
    <div class="hero_area">
        @include('layouts.web.header')
        @include('layouts.web.banner')
    </div>
    @yield('content')
    @include('layouts.web.footer')
    @include('layouts.web.footer_js')
    @stack('footer_js')
</body>

</html>
