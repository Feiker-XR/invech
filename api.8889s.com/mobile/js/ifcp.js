function autofitframe(fid){
	var hb=$('body').height();
	$(fid,parent.document).height(hb);
}
$(document).ready(function() {
	autofitframe('#J_GamesFrame');
	setInterval(function(){
		autofitframe('#J_GamesFrame');
	},1000);
	$(parent.document).scrollTop(0);
});