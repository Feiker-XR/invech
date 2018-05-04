function setbet(typename_in, touzhuxiang_in, match_id_in, point_column_in,
		ben_add_in, is_lose_in, xx_in) {
	
	$.ajax({
		url : '/index.php/ajaxleft/islogin.html',
		dataType : 'json',
		success : function(data) {
			if (data.islogin == 1) {
				//alert(arguments[5]);
				//if (!arguments[5])
				//	is_lose_in = 0;
				var touzhutype = parent.leftFrame.touzhutype;
				$.post("/index.php/ajaxleft/bet_match.html", {
					ball_sort : typename_in,
					match_id : match_id_in,
					touzhuxiang : touzhuxiang_in,
					point_column : point_column_in,
					ben_add : ben_add_in,
					is_lose : is_lose_in,
					xx : xx_in,
					touzhutype : touzhutype,
					rand : Math.random()
				}, function(data) {
					parent.leftFrame.bet(data);
				});
			} else {
				alert('请登陆后操作！');
			}
		}
	})
}