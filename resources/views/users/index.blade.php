@include('public.header')
    <body style="overflow: hidden;">
    <script src="/static/js/common.js" ></script>
    <!--人物信息-->
    <div class="bg_four">
        <div class="head" style="background: url(http://v.xhbuy.cn/upload/{{$user->gravatar}}) 0 0 no-repeat;background-size: cover;">

        </div>
        <p>{{$user->name}}</p>
        <h3>{{$user->company}}</h3>
    </div>
    <!--中间蓝色长条-->
    <div class="border_four"></div>
    <!--底部链接部分-->
    <div class="footer_four">
        <a href="{{ route('conference') }}" style="border-right:1px solid #c9d2e5 ;">
            <img src="/static/img/huiyi.png"/>
            <p>会议日程</p>
        </a>
        <a href="{{ route('hotel') }}" style="border-right:1px solid #c9d2e5 ;">
            <img src="/static/img/hotel.png"/>
            <p style="margin-top: 0.03rem;">会场与酒店</p>
        </a>
        <a href="{{ route('intro') }}">
            <img src="/static/img/grand.png" style="margin-top: 0.37rem;"/>
            <p style="margin-top: 0.04rem;">品牌简介</p>
        </a>
        <a href="{{ route('bus') }}" style="border-right:1px solid #c9d2e5 ;border-top:1px solid #c9d2e5 ;" >
            <img src="/static/img/car.png" style="margin-top: 0.40rem;"/>
            <p style="margin-top: 0.05rem;">班车时刻表</p>
        </a>
        <a href="{{ route('seat') }}" style="border-right:1px solid #c9d2e5 ;border-top:1px solid #c9d2e5 ;" >
            <img src="/static/img/query.png" style="width: 36%;"/>
            <p style="margin-top: 0.03rem;">座位查询</p>
        </a>
        <a href="" style="border-top:1px solid #c9d2e5 ;" >
            <img src="/static/img/site.png"/>
            <p style="margin-top: 0.077rem;">官方网站</p>
        </a>
    </div>
    </body>
</html>