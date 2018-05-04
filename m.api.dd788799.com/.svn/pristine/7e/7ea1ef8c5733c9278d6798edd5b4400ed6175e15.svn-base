// JavaScript Document
var dbs  = null;
var data = null;
var window_hight	=	0; //窗口高度
var window_lsm		=	0; //窗口联赛名
function loaded(league,thispage,p){
	var league = encodeURI(league);
	league = league.replace("&","|-|")
	$.getJSON("jinrong_data.php?leaguename="+league+"&CurrPage="+thispage+"&callback=?",function(json){
		var pagecount	=	json.fy.p_page;
		var page		=	json.fy.page;
		var fenye		=	"";
		window_hight	=	json.dh;
		window_lsm		=	json.lsm;
		if(dbs !=null){
			if(thispage==0 && p!='p'){	
				data = dbs;
				dbs  = json.db;  
			}else{
				dbs  = json.db;  
				data = dbs;
			}
		}else{
			dbs  = json.db;
			data = dbs;
		}
		
		if(pagecount == "error1"){
			$("#datashow").html("<div style='line-height:40px;text-align:center;color:#000000; border-bottom:1px solid #999;'>末登录,无法查看赛事信息.</div>");
			$("#top").html("");
		}else if(pagecount == "error2"){
			$("#datashow").html("<div id=\"location\"  style='line-height:40px;text-align:center;color:#666; border-bottom:1px solid #999;'>对不起,您点击页面太快,请在60秒后进行操作</div><script>check();</script>");
			$("#top").html("");
		}else if(pagecount == 0){
			$("#datashow").html("<div style='line-height:40px;text-align:center;color:#000000; border-bottom:1px solid #999;'>暂无赛事</div>");
			$("#top").html("");
		}else{
			var lsm = "";
			var htmls = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"778\" class=\"ttt\">";
			for(var i=0; i<dbs.length; i++){
				
				htmls+="<tr><td  colspan=\"4\" class=\"liansai\" style='border-bottom: 1px solid #999;'><span class=\"spfloatleft\"><a href=\"javascript:void(0)\" title='选择 >> "+lsm+"' onclick=\"javascript:check_one('"+lsm+"');\" style=\"color:#005481;\" >"+lsm+"</a></span><span class=\"spfloatright\"></span></td></tr>";
			
				htmls+="<tr style='border-bottom: 1px solid #999;' class=\"d_out1\"  onmouseover=\"this.className='d_over1'\" onmouseout=\"this.className='d_out1'\">";
				htmls+="<td align=\"center\" class=\"bai_xx zu_1\" style='border-bottom: 1px solid #999; color:#424242'>"+dbs[i]["Match_Date"]+"</td>";
				htmls+="<td align=\"left\" class=\"bai_xx lan_danshi_2\" style='border-bottom: 1px solid #999; '>"+dbs[i]["Match_Name"]+"</td>";
				htmls+="<td colspan=\"2\" >"
				htmls+="<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\"style='border-bottom: 1px solid #999;'>"
					var team_name = dbs[i]["team_name"].split(",")
					var point = dbs[i]["point"].split(",")
					var tid = dbs[i]["tid"].split(",")
					var point2 = data[i]["point"].split(",")
					var tid2 = data[i]["tid"].split(",")
					
					for(var ss=0; ss<team_name.length; ss++){
						if(point[ss] != 0 && point[ss] != ""){
						htmls+="<tr>"
						htmls+="<td align=\"left\" class=\"bai_xx gzu_4\" >"
						htmls+=team_name[ss]
						htmls+="</td>"
						htmls+="<td align=\"left\" class=\"bai_z gzu_5\"><a href=\"javascript:void(0)\" onclick=\"setbet('"+dbs[i]["Match_ID"]+"','"+tid[ss]+"')\" style='"+(point[ss]!=point2[ss] && data[i]["Match_ID"]==dbs[i]["Match_ID"] && tid[ss]==tid2[ss]?"background:#FFCC00":"")+"' >"
						htmls+=formatNumber(point[ss],2)
						htmls+="</a></td>"
						htmls+="</tr>"
						}
					}
				htmls+="</table>";
				htmls+="</td>";
				htmls+="</tr>"
				
			}
			htmls+="</table>";
			$("#datashow").html(htmls);
		}
		document.documentElement.scrollTop	=	$("#top_f5").val(); //导航标题高度
		$("#top_f5").val('0');
		gdt();
	})
}

$(document).ready(function(){
	$("#xzls").click(function(){ //选择联赛
		JqueryDialog.Open('金融指数', 'dialog.php?lsm='+window_lsm, 600, window_hight);
	});
});