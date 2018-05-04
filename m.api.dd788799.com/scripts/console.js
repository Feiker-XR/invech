(function(root){
	'use strict';

	if(!root.console || /iphone|ios|android/i.test(root.navigator.userAgent)){
		root.console = (function () {
			var div = document.createElement('div');
			document.body.appendChild(div);
			div.style.cssText = 'overflow:hidden;display:none;position:fixed;width:100%;height:30px;line-height:15px;font-size:12px;background:rgba(0,0,0,.7);color:#eee;z-index:100;top:0;left:0;text-align:left;box-sizing:border-box;padding:0 .5em;';

			function print(){
				div.style.display = 'block';
				var text = '';
				for(var i = 0,l = arguments.length; i<l ;i++){
					text += arguments[i]+',';
				}
				div.innerHTML = text + '<br />' + div.innerHTML;
			}

			return {
				log : print,
				info : print
			};
		}());
	}

}(this));