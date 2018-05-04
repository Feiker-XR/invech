(function($){
	'use strict';

	// nav tab
	$('.nav-tab').children('li').click(function() {
		var _ = $(this);
		_.addClass('active').siblings().removeClass('active');
		_.parents('.tab-content').find('.tab-item').removeClass('active');
		$(_.data('target')).addClass('active');
		return false;
	});

	// menu-list
	$('.menu-list').children('li').click(function(){
		$(this).addClass('active').siblings().removeClass('active');
		return false;
	});

}(jQuery));