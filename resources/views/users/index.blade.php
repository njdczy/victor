<!DOCTYPE html>
<html lang="zh-cmn-Hans" class="onepage">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width,initial-scale=1.0" name="viewport"/>
    <meta content="telephone=no" name="format-detection"/>
    <meta content="address=no" name="format-detection"/>
    <meta name="apple-mobile-web-app-capable" content="no" />

    <title>YONEX-尤里克斯</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="HOMOLO">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />

    <link rel="apple-touch-icon-precomposed" href="" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="" />

    <link rel="stylesheet" type="text/css" href="/static/html/index/index.css" />
    <link rel="stylesheet" href="/static/css/common.css" />
    <link rel="stylesheet" href="/static/css/swiper.css" />
</head>
<body class="onepage">

<div class="msg-box clearfix">
    <div class="brand pull-right">
        <img src="/static/images/brand.jpg" alt="">
    </div>
    <div class="msg-list">
        <dl class="clearfix">
            <dt class="photo-box pull-left"><img src="/static/images/photo.jpg" alt="photo"></dt>
            <dd><h2>李帅</h></dd>
            <dd><p class="company">江苏南京聚力</p></dd>
            <dd><p class="tel">18515684</p></dd>
        </dl>
    </div>
</div>

<div class="main" style="background-image: url(/static/images/main.jpg);">
    <!-- <img src="images/main.jpg" alt=""> -->
</div>

<div class="annouce-wrapper">
    <svg class="icon" aria-hidden="true">
        <use xlink:href="#icon-notice"></use>
    </svg>
    <span>公告:</span>
    <div class="swiper-container2 annouce">
        <div class="swiper-wrapper">
            <div class="swiper-slide">123456</div>
            <div class="swiper-slide">1265656456</div>
            <div class="swiper-slide">1247894856</div>
        </div>
    </div>
</div>

<div class="menu">
    <ul class="clearfix">
        <li>
            <a href="calendar">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-calendar"></use>
                </svg>
                <span>会议日程</span>
            </a>
        </li>
        <li>
            <a href="hotel">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-hotel"></use>
                </svg>
                <span>酒店信息</span>
            </a>
        </li>
        <li>
            <a href="#">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-QR_code"></use>
                </svg>
                <span>入场凭证</span>
            </a>
        </li>

        <li>
            <a href="bus">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-bus"></use>
                </svg>
                <span>班车时刻表</span>
            </a>
        </li>
        <li>
            <a href="#">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-search"></use>
                </svg>
                <span>座位查询</span>
            </a>
        </li>
        <li>
            <a href="#">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-website"></use>
                </svg>
                <span>官方网站</span>
            </a>
        </li>
    </ul>
</div>

<div class="overlay">
    <div class="modal">
        <div class="modal-header">
            <span class="close">X</span>
        </div>
        <div class="modal-content">
            <h2>公告</h2>
            <ul>
                <li>123456</li>
                <li>123456</li>
                <li>123456</li>
            </ul>
        </div>
    </div>
</div>
<script src="/static/lib/mod.js"></script>
<script type="text/javascript">/*resourcemap*/
    require.resourceMap({
        "res": {
            "modules/js/swiper": {
                "url": "/static/js/swiper.js",
                "type": "js"
            },
            "components/zepto/zepto": {
                "url": "/static/components/zepto/zepto.js",
                "type": "js"
            },
            "components/zepto/event": {
                "url": "/static/components/zepto/event.js",
                "type": "js",
                "deps": [
                    "components/zepto/zepto"
                ]
            },
            "components/zepto/ajax": {
                "url": "/static/components/zepto/ajax.js",
                "type": "js",
                "deps": [
                    "components/zepto/zepto"
                ]
            },
            "components/zepto/form": {
                "url": "/static/components/zepto/form.js",
                "type": "js",
                "deps": [
                    "components/zepto/zepto"
                ]
            },
            "components/zepto/ie": {
                "url": "/static/components/zepto/ie.js",
                "type": "js",
                "deps": [
                    "components/zepto/zepto"
                ]
            },
            "components/zepto/main": {
                "url": "/static/components/zepto/main.js",
                "type": "js",
                "deps": [
                    "components/zepto/event",
                    "components/zepto/ajax",
                    "components/zepto/form",
                    "components/zepto/ie",
                    "components/zepto/zepto"
                ]
            },
            "components/zepto/touch": {
                "url": "/static/components/zepto/touch.js",
                "type": "js",
                "deps": [
                    "components/zepto/zepto"
                ]
            },
            "modules/js/drawer": {
                "url": "/static/js/drawer.js",
                "type": "js",
                "deps": [
                    "components/zepto/main"
                ]
            }
        },
        "pkg": {}
    });</script>
<script type="text/javascript" src="/static/js/main.js"></script>
<script src="/static/lib/iconfont.js"></script>
<script>
    var main = require('modules/js/main');

    main.Slide2.init();
    main.Show.init('.annouce','.close','.overlay');
</script>
</body>
</html>
