(function() {
	'use strict';

	$('[data-iframe]').click(function() {
		var _ = $(this);
		var iframeIds = _.data('iframe').split(",");
		var urls = _.data('url').split(",");
		if(typeof(_.data('target')) != "undefined") {
			var targets = _.data('target').toString().split(",");
		} else {
			var targets = new Array();
		}
		
		
		for(var i=0;i<iframeIds.length;i++) {
			if(typeof(urls[i]) != "undefined") {
				var url = urls[i];
				var iframeId = iframeIds[i];
				var target = targets[i];
				if(typeof(target) == "undefined") {
					target = "0";
				}
				
				switch(target) {
					case "0":
						window.parent.openUrl(iframeId, url);
					break;
					case "1":
						window.openUrl(iframeId, url);
					break;
				}
				
			}
		}
	});
}());