<!DOCTYPE html>
<html lang="en">

<head>
    <title>Appiki</title>
    @include('layouts.web.header_css')
    @include('layouts.web.seo_meta')
    @stack('header_css')
</head>

<body class="index home main-wrapper" id="mainContent">
    <script type="text/javascript">
        //<![CDATA[
        (localStorage.getItem('mode')) === 'darkmode' ? document.querySelector('#mainContent').classList.add('dark'):
            document.querySelector('#mainContent').classList.remove('dark')
        //]]>
    </script>
    <!-- Theme Options -->
    <div class="admin-area" style="display:none">
        <div class="admin-section section" id="admin" name="Theme Options (Admin Panel)">
            <div class="widget LinkList" data-version="2" id="LinkList25">

                <script type="text/javascript">
                    //<![CDATA[


                    var disqusShortname = "pikitemplates";


                    var commentsSystem = "blogger";


                    var noThumb = "//3.bp.blogspot.com/-Yw8BIuvwoSQ/VsjkCIMoltI/AAAAAAAAC4c/s55PW6xEKn0/s1600-r/nth.png";


                    //]]>
                </script>

            </div>
            <div class="widget LinkList" data-version="2" id="LinkList26">

                <script type="text/javascript">
                    //<![CDATA[


                    var followByEmailText = "Get Notified About Next Update.";


                    var relatedPostsText = "You May Like";


                    var relatedPostsNum = 4;


                    var loadMorePosts = "Load More";


                    //]]>
                </script>

            </div>
            <div class="widget LinkList" data-version="2" id="LinkList27">

                <script type="text/javascript">
                    //<![CDATA[


                    var fixedSidebar = true;


                    var fixedMenu = true;


                    var showMoreText = "Show More";


                    //]]>
                </script>

            </div>
        </div>
    </div>
    <div id="outer-wrapper">
        @include('layouts.web.nav')
        @include('layouts.web.header')
        @include('layouts.web.banner')
        <div class="clearfix"></div>
        <div class="mega-wrap-center">
            <div class="container">
                <div class="main-ads-pikihome section" id="main-ads1" name="Ads Placement">
                    <div class="widget HTML" data-version="2" id="HTML14">
                        <div class="widget-title icon">
                            <h3 class="title">
                                test
                            </h3>
                        </div>
                        <div class="widget-content">
                            <a class="piki-ads" href="javascript:;">Your Responsive Ads code (Google Ads)</a>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="flex-top">
                    <div class="xx0ooj-wrap section" id="top-NewsPro-main-widget-2" name="Featured Posts Section">
                        <div class="widget HTML" data-version="2" id="HTML42">
                            <div class="widget-title icon">
                                <h3 class="title">
                                    Most Downloaded
                                </h3>
                            </div>
                            <div class="widget-content">
                                7/sgrid/recent
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        @yield('content')
        <div class="clearfix"></div>
        @include('layouts.web.footer')
    </div>
    @include('layouts.web.footer_js')
    @stack('footer_js')
</body>

</html>
