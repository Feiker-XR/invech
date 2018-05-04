(function($, root){
	'use strict';

	var transition = root.Detector.cssSupport('transition');

	var active = $('.page-slide').find('.page.active')[0];
	if(!active) {
		return;
	}

	var before = {
		'J_p3' : function() {
			$(this)
				.find('.entrence')
				.css('top', 800);
		},
		'J_p6' :  function() {
			$('#J_p6Imgs')
				.children('a')
				.css('top', 800);
		},
		'J_p5' : function() {
			$(this).find('.left').css('left', -800);
			$(this).find('.right').css('right', -800);
		}
	};

	var callback = {
		'J_p3' : function() {
			$(this)
				.find('.entrence')
				.each(function(idx){
					$(this).animate({
						'top' : 0
					}, 800 + idx * 100);
				});
		},
		'J_p6' :  function() {
			$('#J_p6Imgs')
				.children('a')
				.each(function(idx){
					$(this).animate({
						'top' : 0
					}, 800 + idx * 100);
				});
		},
		'J_p5' : function() {
			$(this)
				.find('.left')
				.animate({
					'left' : 0
				}, 700);
			$(this)
				.find('.right')
				.animate({
					'right' : 0
				}, 700);
		}
	};

	var PageSlide = (function(){
		var currentId = active.id;
		var $body = $('body');
		$('.page').on('webkitTransitionEnd transition mozTransitionEnd', function(){
			$body.css('overflow-x', 'auto');
		});
		var duration = 0.5;
		var $toggles = $('[data-slide]');
		var sliding = false;

		function loadImages(id){
			var $imgs = $('#'+id).find('img');
			$imgs.each(function(i, img){
				img.src = img.getAttribute('data-src');
			});
		}

		loadImages(currentId);
		
		return {
			slideTo : function(id) {
				if(!$('#'+id).length || currentId === id || sliding) {
					return false;
				}
				
				loadImages(id);

				sliding = true;

				$body.css('overflow-x', 'hidden');
				var $current = $('#'+currentId);
				var $target = $('#'+id);
				var currentPageIndex = $current.index();
				var targetPageIndex = $target.index();

				if(transition){
					var currentPageStyle = '';
					if(targetPageIndex > currentPageIndex) {
						$target.addClass('active')[0].style.cssText = 'left:100%';
						currentPageStyle = 'left:-100%;transition:all '+duration+'s ease-out;position:absolute;';
					} else {
						$target.addClass('active')[0].style.cssText = 'left:-100%';
						currentPageStyle = 'left:100%;transition:all '+duration+'s ease-out;position:absolute;';
					}
					$current[0].style.cssText = 'left:0;position:absolute';
					setTimeout(function(){
						$target[0].style.cssText = 'left:0;transition:all '+duration+'s ease-out;';
						$current[0].style.cssText = currentPageStyle;
						setTimeout(function(){
							$current.removeClass('active transition');
							$target.addClass('transition');
							sliding = false;
						}, duration * 1000);
					}, 100);
					currentId = id;
				
				} else {

					before[id] && before[id].call($target[0]);
					if(targetPageIndex > currentPageIndex){
						$target.addClass('active')[0].style.cssText = 'left:100%';
						$current[0].style.cssText = 'left:0;position:absolute';
						$current.animate({
							left : '-100%'
						}, duration * 1000);
						$target.animate({
							left : 0
						}, duration * 1000, function(){
							sliding = false;
							$current.removeClass('active');
							callback[currentId] && callback[currentId].call($target[0]);
						});
					}else{
						$target.addClass('active')[0].style.cssText = 'left:-100%';
						$current[0].style.cssText = 'left:0;position:absolute';
						$current.animate({
							left : '100%'
						}, duration * 1000, function(){
							sliding = false;
							$current.removeClass('active');
							callback[currentId] && callback[currentId].call($target[0]);
						});
						$target.animate({
							left : 0
						}, duration * 1000);
					}
					currentId = id;

				}

				// 判断浏览器是否有滚动距离，然后设置为0
				$(window).scrollTop(0);
				
				return true;
			},
			activeToggles : function(id) {
				$toggles.each(function(idx, item) {
					var _ = $(item);
					if(_.data('slide').substring(1) === id || (_.data('slideactive') && _.data('slideactive').indexOf(id) > -1)){
						_.addClass('active');
					}else{
						_.removeClass('active');
					}
				});
			}
		};
	}());

	// 绑定点击切换事件
	$(document).on('click.page-slide.data-api', '[data-slide]', function() {
		var _ = $(this);
		var id = _.data('slide').substring(1);
		if(_.data('iframe') != undefined){
			$('#'+_.data('iframe')).attr('src', _.data('url'));
		}
		if(PageSlide.slideTo(id)) {
			PageSlide.activeToggles(id);			
			var pos = 125 * $('#J_headerNav').find('li.active').index();
			$('#J_headerNavBorder').css('left', pos >= 0 ? pos + 1 : -125);
		}
		return false;
	});
}(jQuery, this));