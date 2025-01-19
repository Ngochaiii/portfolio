<!-- Favicon -->
<link href="{{ $config->favicon ?? 'favicon.ico' }}" rel="icon" type="image/x-icon">

<!-- Language and Canonical -->
<link href="{{ $config->url ?? url()->current() }}" hreflang="x-default" rel="alternate">
<link href="{{ $config->url ?? url()->current() }}" rel="canonical">

<!-- RSS Feeds -->
@if ($config->enable_rss ?? false)
    <link rel="alternate" type="application/atom+xml" title="{{ $config->site_name ?? 'Shop Công Nghệ' }} - Atom"
        href="{{ $config->url ?? url()->current() }}/feeds/posts/default">
    <link rel="alternate" type="application/rss+xml" title="{{ $config->site_name ?? 'Shop Công Nghệ' }} - RSS"
        href="{{ $config->url ?? url()->current() }}/feeds/posts/default?alt=rss">
@endif

<!-- Blog Service (nếu có) -->
@if ($config->blog_service_url ?? false)
    <link rel="service.post" type="application/atom+xml" title="{{ $config->site_name ?? 'Shop Công Nghệ' }} - Atom"
        href="{{ $config->blog_service_url }}">
@endif

<!-- Profile Links -->
@if ($config->profile_url ?? false)
    <link rel="me" href="{{ $config->profile_url }}">
@endif

<!-- Google Services -->
<link href="//fonts.googleapis.com" rel="dns-prefetch">
<link href="//ajax.googleapis.com" rel="dns-prefetch">
<link href="//www.google-analytics.com" rel="dns-prefetch">
<link href="//www.googletagservices.com" rel="dns-prefetch">
@if ($config->enable_adsense ?? false)
    <link href="//pagead2.googlesyndication.com" rel="dns-prefetch">
    <link href="//googleads.g.doubleclick.net" rel="dns-prefetch">
    <link href="//tpc.googlesyndication.com" rel="dns-prefetch">
@endif
<link href="//www.gstatic.com" rel="preconnect">

<!-- CDN Resources -->
<link href="//maxcdn.bootstrapcdn.com" rel="dns-prefetch">
<link href="//cdnjs.cloudflare.com" rel="dns-prefetch">
<link href="//use.fontawesome.com" rel="dns-prefetch">

<!-- Social Media -->
<link href="//www.facebook.com" rel="dns-prefetch">
<link href="//connect.facebook.net" rel="dns-prefetch">
<link href="//static.xx.fbcdn.net" rel="dns-prefetch">
@if ($config->enable_twitter ?? false)
    <link href="//twitter.com" rel="dns-prefetch">
    <link href="//platform.twitter.com" rel="dns-prefetch">
@endif
@if ($config->enable_youtube ?? false)
    <link href="//www.youtube.com" rel="dns-prefetch">
@endif
@if ($config->enable_instagram ?? false)
    <link href="//www.instagram.com" rel="dns-prefetch">
    <link href="//platform.instagram.com" rel="dns-prefetch">
@endif
@if ($config->enable_pinterest ?? false)
    <link href="//www.pinterest.com" rel="dns-prefetch">
    <link href="//i.pinimg.com" rel="dns-prefetch">
    <link href="//assets.pinterest.com" rel="dns-prefetch">
@endif
@if ($config->enable_linkedin ?? false)
    <link href="//www.linkedin.com" rel="dns-prefetch">
@endif

<!-- Additional Services -->
@if ($config->enable_disqus ?? false)
    <link href="//disqus.com" rel="dns-prefetch">
@endif
@if ($config->enable_github ?? false)
    <link href="//github.com" rel="dns-prefetch">
@endif
@if ($config->enable_gravatar ?? false)
    <link href="//s.gravatar.com" rel="dns-prefetch">
@endif
<!-- Font Awesome Free 5.15.2 -->
<link href="{{asset('assets/web/css/fontawesome.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/web/css_global/style.css')}}" rel="stylesheet">

