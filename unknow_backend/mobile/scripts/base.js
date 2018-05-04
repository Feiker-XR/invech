(function(root) {
	'use strict';

	// 浏览器版本及支持判断
	var div = document.createElement('div');
	var vendors = 'Khtml Ms O Moz Webkit'.split(' ');
	function cssSupport(prop) {
		if (prop in div.style) {
			return true;
		}

		prop = prop.replace(/^[a-z]/, function(v) {
			return v.toUpperCase();
		});

		var len = vendors.length;

		while (len--) {
			if (vendors[len] + prop in div.style) {
				return true;
			}
		}

		return false;
	}

	var IEVersion = false;
	if (!/msie/i.test(window.navigator.userAgent)) {
		IEVersion = false;
	} else {
		var v = 3,
			div = document.createElement('div'),
			all = div.getElementsByTagName('i');
		while (
			div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->',
			all[0]
		);
		IEVersion = v > 4 ? v : 10;
	}
	
	root.Detector = {
		IEVersion : IEVersion,
		Bom : {
			isMobile : /iphone|ios|android/i.test(root.navigator.userAgent)
		},
		xhr2: !!new XMLHttpRequest().upload,
		cssSupport : cssSupport
	};
	
}(this));