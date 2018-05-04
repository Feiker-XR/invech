/**
 *  浮動 (預設右上 top:150)
 *  @example   $("#id").Float();
 *  @param {topSide:150,floatRight:0|1,side:5,close:ID}
 */
$.fn.Float = function(obj){

	var $win = $(window),
		// 讓廣告區塊變透明且顯示出來
		$ad = $(this).css('opacity', 0).show();

	var data = {
		topSide : 150,
		floatRight : 1,
		// 距離右及上方邊距
		// _diffY : 150,
		_diffX : 5,
		// 移動的速度
		_moveSpeed : (window.floatAnimate != null  && window.floatAnimate.Speed ) ? (floatAnimate.Speed) : 500,
		// 動畫類型
		_animateEasig: (window.floatAnimate != null  && window.floatAnimate.Easing) ? (floatAnimate.Easing) : 'swing'
	}

	if (obj) $.extend(data, obj);

	// 先把 #abgne_float_ad 移動到定點
	$ad.css({
		'top': data._diffY,	// 往上
		'opacity': 1,
		'position':'absolute',
		'z-index':'1000'
	});

	// 幫網頁加上 scroll 及 resize 事件
	$win.bind('scroll resize', function(e){
		var $this = $(this) ,
			initd = {};

		initd['top'] = $this.scrollTop() + data.topSide;	// 往上

		if(data.floatRight == 1){
			if (e.type == 'resize') {
				initd['right'] = data._diffX;
				$win.scrollLeft(0);
			} else  {
			initd['right'] =  data._diffX - $this.scrollLeft();
			}
		}else{
			initd['left'] = $this.scrollLeft() + data._diffX;
		}

		// 優惠區上邊距 及各點擊區的高度，加判斷是保護 IE 不噴錯
		var exclusiveTop = ($('#MemberExclusive_area').length >0)?($('#MemberExclusive_area').offset().top):0,
			exclusiveHeight = $('#MemberExclusive_area div[id^="MemberExclusive"]:eq(0)').height();

		// 強制捲動至點擊事件所在，藉以規避 jQuery animate 瞬間高度差的動畫延遲狀況
		$('#MemberExclusive_area div[id^="MemberExclusive"]').click(function(){
			$('html, body').scrollTop( ($(this).index()) * exclusiveHeight + exclusiveTop );
		});

		// 控制 #abgne_float_ad 的移動
		$ad.stop().animate( initd , data._moveSpeed, data._animateEasig);

	}).scroll();	// 觸發一次 scroll()

	// setInterval(function(){
	// 	$('#ie8').html($(document).innerHeight()).css('color','#FFF');
	// },20);

	// 關閉廣告
	if(data.close){
		if(!/^[#.]\w*/.test(data.close)){
			data.close = "#"+data.close;
		}
		$(data.close).click(function(){
    		$ad.hide();
    	}).css('cursor','pointer');
    }

};

