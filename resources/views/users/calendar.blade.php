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

    <link rel="stylesheet" type="text/css" href="/static/html/calendar/calendar.css" />
    <link rel="stylesheet" href="/static/css/common.css" />
    <link rel="stylesheet" href="/static/css/swiper.css" />
</head>
<body>

<div class="calendar">
    <div class="header-box"></div>
    <div class="content">
        <h2>
            <svg class="icon" aria-hidden="true">
                <use xlink:href="#icon-calendar"></use>
            </svg>
            <span>会议日程</span>
        </h2>
        <div class="day-panel">
            <div class="panel-header">
                2017-02-20
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-down"></use>
                </svg>
            </div>
            <div class="panel-content">
                <ul>
                    <li>
                        <span class="time">12:00 - 22:00</span>
                        <span class="desc">午餐</span>
                        <span class="event">酒店入住签到</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="day-panel">
            <div class="panel-header">
                2017-02-20
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-down"></use>
                </svg>
            </div>
            <div class="panel-content">
                <ul>
                    <li>
                        <span class="time">12:00 - 22:00</span>
                        <span class="desc">午餐</span>
                        <span class="event">酒店入住签到</span>
                    </li>
                    <li>
                        <span class="time">12:00 - 22:00</span>
                        <span class="desc">午餐午餐午餐午餐午餐</span>
                        <span class="event">酒店入住签到酒店入住签到酒店入住签到酒店入住签到</span>
                    </li>
                    <li>
                        <span class="time">12:00 - 22:00</span>
                        <span class="desc">午餐</span>
                        <span class="event">酒店入住签到</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="day-panel">
            <div class="panel-header">
                2017-02-20
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-down"></use>
                </svg>
            </div>
            <div class="panel-content">
                <ul>
                    <li>12:00 - 22:00</li>
                </ul>
            </div>
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

    main.Toggle.init('.panel-header','.panel-content','show','rotate');
</script>
</body>
</html>
