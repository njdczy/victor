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
    <link rel="stylesheet" type="text/css" href="/static/html/hotel/hotel.css" />
    <link rel="stylesheet" href="/static/css/common.css" />
    <link rel="stylesheet" href="/static/css/swiper.css" />
</head>
<body class="onepage">

<div class="hotel">
    <div class="header-box"></div>
    <div class="content">
        <h2>
            <svg class="icon" aria-hidden="true">
                <use xlink:href="#icon-hotel"></use>
            </svg>
            <span>会场与酒店信息</span>
        </h2>
        <div id="map"></div>
        <div class="msg-panel">
            <div class="panel-header">
                <span>主会场地点</span>
            </div>
            <div class="panel-content">
                <p>南京国际博览会议中心</p>
                <p>地址:南京建邺区金沙江西街9号</p>
            </div>
        </div>
        <div class="msg-panel">
            <div class="panel-header">
                <span>主会场地点</span>
            </div>
            <div class="panel-content">
                <p>南京国际博览会议中心</p>
                <p>地址:南京建邺区金沙江西街9号</p>
            </div>
        </div>
        <div class="msg-panel">
            <div class="panel-header">
                <span>主会场地点</span>
            </div>
            <div class="panel-content">
                <p>南京国际博览会议中心</p>
                <p>地址:南京建邺区金沙江西街9号</p>
            </div>
        </div>
        <div class="msg-panel">
            <div class="panel-header">
                <span>主会场地点</span>
            </div>
            <div class="panel-content">
                <p>南京国际博览会议中心</p>
                <p>地址:南京建邺区金沙江西街9号</p>
            </div>
        </div>
    </div>

</div>
<script src="/static/lib/mod.js"></script>
<script>/*resourcemap*/
</script>
<script src="/static/lib/iconfont.js"></script>
<script src="http://webapi.amap.com/maps?v=1.3&key=af0be466fd170e098a0b928be57c8d9d"></script>
<script>
    var map = new AMap.Map('map',{
        resizeEnable: true,
        zoom: 18,
        resizeEnable: false,
        dragEnable:false,

        center: [118.706905,31.991327],
    });
    new AMap.Marker({
        map: map,
        position: [118.706905,31.991327],
        icon: new AMap.Icon({
            size: new AMap.Size(40, 50),  //图标大小
            image: "http://webapi.amap.com/theme/v1.3/images/newpc/way_btn2.png",
            imageOffset: new AMap.Pixel(0, -60)
        })
    });

    // var main = require('js/main');
    // main.Slide.init();
</script>
</body>
</html>
