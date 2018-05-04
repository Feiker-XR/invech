// JavaScript Document
var dbs =null;
var data =null;
function loaded(league,thispage){
	var league = encodeURI(league);
	$.getJSON("jinrong_result_data.php?leaguename="+league+"&CurrPage="+thispage+"&callback=?",function(json){
		
		var pagecount = json.fy.p_page;
		var messagecount = json.fy.count_num;
		var page = json.fy.page;
		var fenye = "";
		var opt = json.dh;
		if(dbs !=null)
        {
			data = dbs;
			dbs  = json.db;         
		}else{
			dbs  = json.db;
			data = dbs;
		}
		
		var league = json.leaguename;
		var timename = json.timename;
		if(league != ""){
			$("#league").val(timename);
		}
		var tday = json.tday
		if(pagecount!="error2"){
			if(tday[0] != "no"){
				var tdaystr = "<a href=\"javascript:void(0)\" onclick=\"return Wleague('"+tday[0]+"')\">昨日</a> / <a href=\"javascript:void(0)\" onclick=\"return Wleague('"+tday[1]+"')\">明日</a>"
			}else{
				var tdaystr = "<a href=\"javascript:void(0)\" onclick=\"return Wleague('"+league+"')\">昨日</a>"
			}
			$("#tday").html(tdaystr);
		}
		if(pagecount == "error1"){
			$("#datashow").html("<div style='line-height:40px;text-align:center;color:#000000; border-bottom:1px solid #999;'>末登录,无法查看赛事信息.</div>");
			$("#top").html("");
		}else if(pagecount == "error2"){
			$("#datashow").html("<div id=\"location\"  style='line-height:40px;text-align:center;color:#666; border-bottom:1px solid #999;'>对不起,您点击页面太快,请在60秒后进行操作</div><script>check();</script>");
			$("#top").html("");
		}else if(pagecount == 0){
			$("#datashow").html("<div style='line-height:40px;text-align:center;color:#000000; border-bottom:1px solid #999;'>暂无结果</div>");
			$("#top").html("");
		}else{
			var tem_arr = new Array();
			tem_arr = opt.split("|");
			var tem_arr2 = new Array();
			var htmls = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"778\" class=\"ttt\">";
			for(var i=0; i<dbs.length; i++){
				htmls+="<tr class='d_out1' onmouseover=\"this.className='d_over1'\" onmouseout=\"this.className='d_out1'\">"
				htmls+="<td align=\"center\" class=\"bai_x zu_1\" style='border-bottom: 1px solid #999; border-right: 1px solid #999;'>"+dbs[i]["Match_Date"]+"</td>";
				htmls+="<td align=\"center\" class=\"bai_x lan_danshi_2\" style='border-bottom: 1px solid #999; border-right: 1px solid #999;'>"+"金融<br>"+dbs[i]["x_title"]+"<br>"+dbs[i]["Match_Name"]+"</td>";
				htmls+="<td>"
				htmls+="<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\" style='border-bottom: 1px solid #999; border-right: 1px solid #999;width:245px;'>"
				var team_name = dbs[i]["team_name"].split(",")
				for(var ss=0; ss<team_name.length; ss++){
					htmls+="<tr>"
					htmls+="<td class=\"bai_x gzu_4\" >"
					htmls+=team_name[ss]
					htmls+="</td>"
					htmls+="</tr>"
				}
				htmls+="</table>";
				htmls+="</td>";
				htmls+="<td class=\"bai_z gzu_5\"  style='border-bottom: 1px solid #999; color:#890209;'>"+dbs[i]["x_result"]+"</td>"
				htmls+="</tr>"
			}
			htmls+="</table>";
			$("#datashow").html(htmls);
		}
	
	})
}