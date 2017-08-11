@include('public.header')
    <body style="overflow: hidden;">
    <script src="/static/js/common.js" ></script>
    <!--人物信息-->
    <div class="bg_four">
        <div class="head" align="center">
			<img src="http://v.xhbuy.cn/upload/{{$user->gravatar}}" alt="" />
        </div>
        <p>{{$user->name}}</p>
        <h3>{{$user->company}}</h3>
    </div>
    <!--中间蓝色长条-->
    <div class="border_four"></div>
    <!--底部链接部分-->
    <div class="footer_four">
        <a href="{{ route('conference') }}" >
            <img src="/static/img/icon-huiyi.png"/>
            <p>会议日程</p>
        </a>
        <a href="{{ route('hotel') }}">
            <img src="/static/img/icon-hotel.png"/>
            <p>会场与酒店</p>
        </a>
        <!--<a href="{{ route('intro') }}">
            <img src="/static/img/grand.png" style="margin-top: 0.37rem;"/>
            <p style="margin-top: 0.04rem;">品牌简介</p>
        </a>
        <a href="{{ route('bus') }}" style="border-right:1px solid #c9d2e5 ;border-top:1px solid #c9d2e5 ;" >
            <img src="/static/img/car.png" style="margin-top: 0.40rem;"/>
            <p style="margin-top: 0.05rem;">班车时刻表</p>
        </a>-->
        <a href="{{ route('seat') }}"  >
            <img src="/static/img/seat-icon.png" style="width: 29%;"/>
            <p>座位查询</p>
        </a>
        <a href="http://www.victorsport.com.cn/" >
            <img src="/static/img/www.png"/>
            <p style="margin-top: 0.077rem;">官方网站</p>
        </a>
    </div>
    </body>
</html>