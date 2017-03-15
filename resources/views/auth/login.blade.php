@include('public.header')
<body>
<script src="/static/js/common.js" ></script>
<div class="body_three">
    <div class="wrap_three">
        <p>您好！</p>
        <h3>请输入您的手机号验证身份</h3>

        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="input_three">
                <input type="text" name="mobile" id="" value="" />
            </div>
            <div id="button_three">
                <button type="submit" class="btn btn-primary">验证身份</button>
            </div>
        </form>
    </div>

</div>
</body>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript">
    var Height=$("body").height();
    $(window).resize(function(){
        $('.body').height(Height);
    })
</script>
</html>