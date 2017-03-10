<!DOCTYPE html>
<html lang="zh-cmn-Hans" class="onepage">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width,initial-scale=1.0" name="viewport"/>
    <meta content="telephone=no" name="format-detection"/>
    <meta content="address=no" name="format-detection"/>
    <meta name="apple-mobile-web-app-capable" content="no" />

    <title>VICTOR</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="HOMOLO">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />

    <link rel="apple-touch-icon-precomposed" href="" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="" />

    <link rel="stylesheet" type="text/css" href="/static/html/welcome/welcome.css" />
    <link rel="stylesheet" href="/static/css/common.css" />
    <link rel="stylesheet" href="/static/css/swiper.css" />
</head>
<body class="onepage">

<div class="swiper-container welcome">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <img src="/static/images/logo.jpg" alt="">
            <div class="title">
                <h1>2017 VICTOR品牌大会</h1>
                <h2>暨新品发布会</h2>
            </div>

            <div class="greeting">
                <p>尊敬的来宾:</p>
                <p>2017 VICTOR品牌大会暨秋冬新品发布会欢迎您！感谢您始终如一的支持与付出</p>
                <p>2017,让我们继续精诚合作，相携与共，共创“胜利”辉煌！</p>
            </div>

            <span>获取入场凭证</span>
        </div>
        <div class="swiper-slide">
            <img src="/static/images/logo.jpg" alt="">
            <div class="title">
                <h1>你好</h1>
            </div>

            <form action="{{ url('vusers') }}" method="POST">
                <ul>
                    <li><p>请输入您的手机号验证身份</p></li>
                    <li><input type="text" name="verification"></li>
                </ul>
                {{ csrf_field() }}
                <button type="submit">验证身份</button>
            </form>

        </div>
        <div class="swiper-slide">
            <img src="/static/images/logo.jpg" alt="">
            <div class="title">
                <h1>2017 VICTOR品牌大会</h1>
                <h2>暨秋冬新品发布会</h2>
            </div>

            <div class="greeting">
                <p>尊敬的来宾:</p>
                <p>2017 VICTOR品牌大会暨秋冬新品发布会欢迎您！感谢您始终如一的支持与付出</p>
                <p>2017,让我们继续精诚合作，相携与共，共创“胜利”辉煌！</p>
            </div>

            <span>获取入场凭证</span>
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
    main.Slide.init();
</script>
</body>
</html>
