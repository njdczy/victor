	//更改根字号方法
	function htmlFontSize() {
		htmlFontScale = document.body.clientWidth / 320
		var font_size = htmlFontScale * 100;
		document.getElementsByTagName('html')[0].style.fontSize = font_size + 'px';
	};
	//设置根字号大小
	htmlFontSize();
	//window窗口变化方法设置
	var resizeFun = window.resize;
	var timer;
	window.onresize = function() {
		clearTimeout(timer);
		timer = setTimeout(function() {
			if (typeof resizeFun == 'function') {
				resizeFun();
			}
			htmlFontSize();
		}, 200);
	};

