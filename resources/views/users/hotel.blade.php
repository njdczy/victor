@include('public.header')
    <body>
    <script src="/static/js/common.js"></script>
    <div class="contain_five">
        <div class="pos_1 position on"></div>
        <div class="pos_2 position"></div>
        <div class="pos_3 position"></div>
        <img src="/static/img/top-hotel.jpg"/>
        <p><span>会场与酒店信息</span></p>

        <!--百度地图容器-->
        <div id="dituContent_1" class="maps show"></div>
        <div id="dituContent_2" class="maps"></div>
        <div id="dituContent_3" class="maps"></div>
        <div class="main">主会场地址</div>
        <p class="main-pos">南京国际青年文化中心</p>
        <p class="main-pos">南京建邺区金沙江西街9号</p>
        <div class="cheer">欢迎晚宴</div>
        <p class="cheer-pos">南京国际博览会议中心（金陵会议中心） 三楼钟山厅</p>
        <p class="cheer-pos_1">地址：建邺区江东中路300号（近白龙江西街）</p>
        <div class="hotel">经销商入住酒店</div>
        <p class="main-pos">{{$hotel->name}}</p>
        <p  class="hotel-pos">地址：
            @if (strpos($hotel->name,'粤海国际酒店'))
                建邺区江东中路363号
            @elseif (strpos($hotel->name,'金陵江滨酒店'))
                建邺区扬子江大道260号
            @elseif (strpos($hotel->name,'博览中心酒店'))
                建邺区金沙江西街16号（国际博览中心南门）
            @else
                无
            @endif
        </p>
    </div>
    </body>
    <script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
    <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
    <!--地图1-->
    <script type="text/javascript">
        //创建和初始化地图函数：
        function initMap(){
            createMap();//创建地图
            setMapEvent();//设置地图事件
        }

        //创建地图函数：
        function createMap(){
            var map = new BMap.Map("dituContent_1");//在百度地图容器中创建一个地图
            var point = new BMap.Point(118.714877,31.996774);//定义一个中心点坐标
            map.centerAndZoom(point,17);//设定地图的中心点和坐标并将地图显示在地图容器中
            window.map = map;//将map变量存储在全局
        }

        //地图事件设置函数：
        function setMapEvent(){
            map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
            map.enableScrollWheelZoom();//启用地图滚轮放大缩小
            map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
            map.enableKeyboard();//启用键盘上下左右键移动地图
        }

        initMap();//创建和初始化地图
    </script>
    <!--地图2-->
    <script type="text/javascript">
        //创建和初始化地图函数：
        function initMap(){
            createMap();//创建地图
            setMapEvent();//设置地图事件
        }

        //创建地图函数：
        function createMap(){
            var map = new BMap.Map("dituContent_2");//在百度地图容器中创建一个地图
            var point = new BMap.Point(118.721357,31.997904);//定义一个中心点坐标
            map.centerAndZoom(point,17);//设定地图的中心点和坐标并将地图显示在地图容器中
            window.map = map;//将map变量存储在全局
        }

        //地图事件设置函数：
        function setMapEvent(){
            map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
            map.enableScrollWheelZoom();//启用地图滚轮放大缩小
            map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
            map.enableKeyboard();//启用键盘上下左右键移动地图
        }
        initMap();//创建和初始化地图
    </script>
    <!--地图3-->
    <script type="text/javascript">
        //创建和初始化地图函数：
        function initMap(){
            createMap();//创建地图
            setMapEvent();//设置地图事件
        }

        //创建地图函数：
        function createMap(){
            var map = new BMap.Map("dituContent_3");//在百度地图容器中创建一个地图
            var point = new BMap.Point(118.718146,31.996958);//定义一个中心点坐标
            map.centerAndZoom(point,19);//设定地图的中心点和坐标并将地图显示在地图容器中
            window.map = map;//将map变量存储在全局
        }

        //地图事件设置函数：
        function setMapEvent(){
            map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
            map.enableScrollWheelZoom();//启用地图滚轮放大缩小
            map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
            map.enableKeyboard();//启用键盘上下左右键移动地图
        }

        initMap();//创建和初始化地图
    </script>
    <!--地图切换-->
    <script type="text/javascript">
        $(function(){
            $(".position").click(function(){
                $(this).addClass("on").siblings().removeClass("on");
                var index=$(this).index();
                $(".maps").eq(index).addClass("show").siblings().removeClass("show");
            })
        })
    </script>
</html>
