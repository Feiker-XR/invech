function showTime()
{
	var now=new Date();
	var year=now.getYear();
	var month=now.getMonth();
	var day=now.getDate();
	var hours=now.getHours();
	var minutes=now.getMinutes();
	var seconds=now.getSeconds();
	if(seconds<10){
		seconds = "0"+seconds;
	}
	var zone=now.getTimezoneOffset()/60*-1;
	if(zone>0){
		zone = "+"+zone;
	}
	var time = "GMT"+zone+": "+hours+":"+minutes+":"+seconds+"";
	
	$(".time").html(time);
}

(function($, root) {
	'use strict';

	var transition = root.Detector.cssSupport('transition');
	
	setInterval("showTime()",1000);

	$('#J_footerTrig').click(function() {
		var _ = $(this);
		var $target = $(_.data('target'));

		if (_.hasClass('closed')) {
			_.removeClass('closed');

			$target.slideDown(600);
			$target.find('.item').animate({
				left: 0,
				opacity: 1
			}, 600);

		} else {

			_.addClass('closed');
			$target.slideUp(600);
			$target.find('.item').animate({
				left: -600,
				opacity: 0
			}, 600);

		}

		$('html,body').animate({
			scrollTop: $(document).height()
		}, 600);
	});

	$('#J_footerInfos').find('.item').each(function(idx, item) {
		$(item).css({
			'opacity': 0,
			'left': -600,
			'position': 'relative'
		});
	});

	// nav border
	$('#J_headerNav').on('mouseover', 'a', function() {
		if (transition) {
			$('#J_headerNavBorder').css('left', (125 * $(this).parent().index()) + 1);
		} else {
			$('#J_headerNavBorder').clearQueue().animate({
				left: (125 * $(this).parent().index()) + 1
			}, 500);
		}
	}).on('mouseout', function() {
		var pos = 125 * $('#J_headerNav').find('li.active').index();
		if (transition) {
			$('#J_headerNavBorder').css('left', pos >= 0 ? pos : -125);
		} else {
			$('#J_headerNavBorder').clearQueue().animate({
				left: pos >= 0 ? pos : -125
			}, 500);
		}
	});
	var pos = 125 * $('#J_headerNav').find('li.active').index();
	$('#J_headerNavBorder').css('left', pos >= 0 ? pos + 1 : -125);


	// broadcast
	var broCtns = $('#J_broadcast').children('a');
	var broadcastPause = false;
	var broIdx = -1;
	setInterval(function() {
		if (broadcastPause) {
			return;
		}
		$(broCtns[++broIdx]).addClass('active').siblings().removeClass('active');
		if (broIdx === broCtns.length - 1) {
			broIdx = -1;
		}
	}, 2000);
	broCtns.bind('mouseover', function() {
		broadcastPause = true;
	}).bind('mouseout', function() {
		broadcastPause = false;
	});

	// back to top
	$('#J_toTop').click(function() {
		$('body').animate({
			scrollTop: 0
		}, 500);
		// for ie8
		if (root.Detector.IEVersion) {
			$(window).scrollTop(0);
		}
		return false;
	});


	// thumnails
	$('#J_p1Thumnails').children().each(function(idx, item) {
		var len = $('#J_p1Thumnails').children().length;
		if (idx < len / 2) {
			$(item).css({
				'position': 'relative',
				'opacity': 0,
				'left': '-600px'
			});
		} else {
			$(item).css({
				'position': 'relative',
				'opacity': 0,
				'left': '600px'
			});
		}
	});

	$('#J_footerFeatures').children().each(function(idx, item) {
		var _ = $(item);
		_.css({
			'position': 'relative',
			'opacity': 0,
			'top': '100px'
		});
		if (item.nodeName === 'A') {
			_.on('mouseover', function() {

				if (transition) {
					$(this).css({
						'top': '-10px'
					});
				} else {
					$(this).clearQueue().animate({
						'top': -10
					}, 500);
				}

			}).on('mouseout', function() {

				if (transition) {
					$(this).css({
						'top': '0px'
					});
				} else {
					$(this).clearQueue().animate({
						'top': 0
					}, 500);
				}

			});
		}
	});

	var p1ThumDisplayed = false;
	var footerFeaturesDisplayed = false;

	function onScroll() {
		var _ = $(document);

		if (!$('#J_p1Thumnails').length) {
			p1ThumDisplayed = true;
		}

		if (!p1ThumDisplayed && $(window).height() + _.scrollTop() > $('#J_p1Thumnails').offset().top + 200) {
			p1ThumDisplayed = true;
			$('#J_p1Thumnails').children().each(function(idx, item) {

				if (transition) {
					$(item).css({
						'opacity': 1,
						'left': 0,
						'transition': 'all .5s ease'
					});
				} else {
					$(item).animate({
						opacity: 1,
						left: 0
					}, 800);
				}

			});
			return false;
		}

		if (!$('#J_footerFeatures').length) {
			footerFeaturesDisplayed = true;
		}

		if (!footerFeaturesDisplayed && $(window).height() + _.scrollTop() > $('#J_footerFeatures').offset().top + 100) {
			footerFeaturesDisplayed = true;
			var delay = 0.1;
			$('#J_footerFeatures').children().each(function(idx, item) {

				if (transition) {
					$(item).css({
						'opacity': 1,
						'top': '0',
						'transition': 'all ' + (++idx * delay) + 's ease'
					});
				} else {
					$(item).animate({
						'opacity': 1,
						'top': '0'
					}, 500 + idx * 100);
				}

			});
			return false;
		}
	}
	$(window).scroll(onScroll);
	onScroll();

	$(document).on('click', '[data-modal]', function() {
		$($(this).data('modal')).show();
		$('body').css('overflow', 'hidden');
	});
	$('.modal').on('click', '.close', function() {
		$($(this).data('target')).hide();
		$('body').css('overflow', 'auto');
	});
	$('.modal').bind('click', function(e) {
		var $tar = $(e.target);
		if ($tar.hasClass('inner') || $tar.parents('.inner').length) {
			// return false;
		} else {
			$(this).hide();
			$('body').css('overflow', 'auto');
			return false;
		}
	});


	$('.j_p3OpenRule').click(function() {
		var _ = $(this);
		var url = _.data('url');
		window.open(url, '规则说明', 'width=830,height=600,left=400');
		return false;
	});

	$('#J_p6Imgs').children('a').each(function(idx, item) {
		$(item).css('transition', 'all ' + (idx + 1) * 0.2 + 's ease');
	});
	
	$('.nav-boxes >li:nth-child(3),#J_headerNav > :last-child').bind('click', function(){
		$('#live800iconlink').trigger('click');
	});  

	if (!transition) {
		$('#J_p1Thumnails').children().each(function() {
			var li = $(this);
			li.children('h2').bind('mouseover', function() {
				$(this).find('.empty').clearQueue().animate({
					width: 20
				}, 500).width(0);
			}).bind('mouseout', function() {
				$(this).find('.empty').clearQueue().animate({
					width: 0
				}, 500);
			});
			li.children('.img-wrap').bind('mouseover', function() {
				var _ = $(this);
				_.find('h3,p,a').clearQueue().animate({
					opacity: 1,
					left: 0
				}, 500);
			}).bind('mouseout', function() {
				var _ = $(this);
				_.find('h3,p,a').clearQueue().animate({
					opacity: 0,
					left: 50
				}, 500);
			});
		});

		$('#J_p3').find('.entrence').each(function() {
			$(this).on('mouseover', function() {
				$(this).clearQueue().animate({
					'top': -10
				}, 500);
			}).on('mouseout', function() {
				$(this).clearQueue().animate({
					'top': 0
				}, 500);
			});
		});

		$('#J_p6Imgs').children('a').on('mouseover', function() {
			$(this).find('.icon').clearQueue().animate({
				'left': 0
			}).css('left', 30);
		}).on('mouseout', function() {
			$(this).find('.icon').clearQueue().animate({
				'left': 30
			});
		});
	}

	if (root.Detector.IEVersion && root.Detector.IEVersion < 10) {
		// placeholder
		var JPlaceHolder = {
			fix: function() {
				$('#J_loginModal input[placeholder]').each(function() {
					var self = $(this);
					var input = $('<input type="text" />');
					var placeholder = self.attr('placeholder');

					self.after(input);
					self.css('display', 'none');
					
					input.val(placeholder);
					input.css('color', '#999');

					input.focus(function() {
						input.css('display', 'none');
						self.css('display', 'inline-block');
						self.focus();
					});

					self.blur(function(){
						if($.trim(self.val()) === ''){
							self.css('display', 'none');
							input.css('display', 'inline-block');
							// input.focus();
						}
					});
				});
			}
		};
		//执行
		JPlaceHolder.fix();
	}
}(jQuery, this));

this.openUrl = function(iframeId, url) {
	$('#' + iframeId)[0].src = url;
}