// JavaScript Document
var dbs  = null;
var data = null;
var window_hight	=	0; //窗口高度
var window_lsm		=	0; //窗口联赛名
function loaded(league,thispage,p){
	var league = encodeURI(league);
	$.getJSON("baseball_zongdefen_data.php?leaguename="+league+"&CurrPage="+thispage+"&callback=?",function(json){
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
			$("#datashow").html("<div id=\"location\"  style='line-height:40px;text-align:center;color:#666; border-bottom:1px solid #999;'>对不起,您点击页面太快,请在60秒后进行操作</div>");
			$("#top").html("");
			check();
		}else if(pagecount == 0){
			$("#datashow").html("<div style='line-height:40px;text-align:center;color:#000000; border-bottom:1px solid #999;'>暂无赛事</div>");
			$("#top").html("");
		}else{
			for(var i=0; i<pagecount; i++){
				if(i != page){
					fenye+="<a href='javascript:NumPage(" + i + ");'><div class=\"sz_0\" id=\"page_this\">" + (i+1) + "</div></a>";
				}else{
					fenye+="<a href='javascript:NumPage(" + i + ");'><div class=\"sz_0\" id=\"page_this\"  style='color:#FFFFFF;background:url(../images/right_4.jpg);'>" + (i+1) + "</div></a>";
				}
			}
			$("#top").html(fenye);
			
			htmls="<div>";
			var lsm = "";
			for(var i=0; i<dbs.length; i++){
				if(dbs[i]["Match_BzM"]!="0"){
				if(lsm != dbs[i]["Match_Name"]){
					lsm = dbs[i]["Match_Name"];
					htmls+="<div class=\"liansai\"><span class=\"spfloatleft\"><a href=\"javascript:void(0)\" title='选择 >> "+lsm+"' onclick=\"javascript:check_one('"+lsm+"');\" style=\"color:#005481;\" >"+lsm+"</a></span><span class=\"spfloatright\"></span></div>";
				}
				htmls+="<div onmouseover=\"this.className='d_over'\" onmouseout=\"this.className='d_out'\">";
				htmls+="<div class=\"bisai_bo\">";
					htmls+="<div class=\"bodan_xx zu_1\"><table width=\"100%\" height=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td align=\"center\" valign=\"middle\">"+dbs[i]["Match_Date"]+"<br />"+dbs[i]["Match_Time"]+(dbs[i]["Match_IsLose"]=1?"<br /> <font color='red'>滚球</font>":"")+"</td></tr></table></div>";
					htmls+="<div class=\"zhudui_bo\">";
						htmls+="<div class=\"bodan_x bq_bodan_2 zu_2Scolor1\">"+dbs[i]["Match_Master"]+"</div>";
						htmls+="<div class=\"bodan_x wq_zongfen_4\">"+(dbs[i]["Match_BzM"]>"0"?"<a href=\"javascript:void(0)\" onclick=\"javascript:setbet('棒球单式','标准盘-"+dbs[i]["Match_Master"]+"-独赢','"+dbs[i]["Match_ID"]+"','Match_BzM','0','"+dbs[i]["Match_Master"]+"');\" style='"+(dbs[i]["Match_BzM"]!=data[i]["Match_BzM"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"' >"+formatNumber(dbs[i]["Match_BzM"],2)+"</a>":"")+"</div>";
						htmls+="<div class=\"bodan_x wq_zongfen_4\"></div>";
						htmls+="<div class=\"bodan_x wq_zongfen_4\"></div>";
						htmls+="<div class=\"bodan_x wq_zongfen_4\"></div>";
						htmls+="<div class=\"bodan_x wq_zongfen_4\"></div>";
						htmls+="<div class=\"bodan_x wq_zongfen_4\"></div>";
						htmls+="<div class=\"bodan_x wq_zongfen_4\"></div>";
						htmls+="<div class=\"bodan_x wq_zongfen_4\"></div>";
						htmls+="<div class=\"bodan_x wq_zongfen_4\"></div>";
						htmls+="<div class=\"bodan_x wq_zongfen_4\"></div>";
						htmls+="<div class=\"bodan_z wq_zongfen_4\"></div>";
					htmls+="</div>";
					htmls+="<div class=\"kedui_bo\">";
						htmls+="<div class=\"bodan_x bq_bodan_2 zu_2Scolor2\">"+dbs[i]["Match_Guest"]+"</div>";
						htmls+="<div class=\"bodan_x wq_zongfen_4\">"+(dbs[i]["Match_BzG"]>"0"?"<a href=\"javascript:void(0)\" onclick=\"javascript:setbet('棒球单式','标准盘-"+dbs[i]["Match_Guest"]+"-独赢','"+dbs[i]["Match_ID"]+"','Match_BzG','0','"+dbs[i]["Match_Guest"]+"');\" style='"+(dbs[i]["Match_BzG"]!=data[i]["Match_BzG"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"' >"+formatNumber(dbs[i]["Match_BzG"],2)+"</a>":"")+"</div>";
						htmls+="<div class=\"bodan_x wq_zongfen_4\"></div>";
						htmls+="<div class=\"bodan_x wq_zongfen_4\"></div>";
						htmls+="<div class=\"bodan_x wq_zongfen_4\"></div>";
						htmls+="<div class=\"bodan_x wq_zongfen_4\"></div>";
						htmls+="<div class=\"bodan_x wq_zongfen_4\"></div>";
						htmls+="<div class=\"bodan_x wq_zongfen_4\"></div>";
						htmls+="<div class=\"bodan_x wq_zongfen_4\"></div>";
						htmls+="<div class=\"bodan_x wq_zongfen_4\"></div>";
						htmls+="<div class=\"bodan_x wq_zongfen_4\"></div>";
						htmls+="<div class=\"bodan_z wq_zongfen_4\"></div>";
					htmls+="</div>";
				htmls+="</div>";
				htmls+="</div>";
			}
			}

			htmls+="</div>";
			if(htmls == "<div></div>"){
				htmls = "<div style='line-height:40px;text-align:center; color:#000000; border-bottom:1px solid #999;'>暂无赛事</div>";
			}
			$("#datashow").html(htmls);
		}
		document.documentElement.scrollTop	=	$("#top_f5").val(); //导航标题高度
		$("#top_f5").val('0');
		gdt();
	})
}

$(document).ready(function(){
	$("#xzls").click(function(){ //选择联赛
		JqueryDialog.Open('棒球总得分', 'dialog.php?lsm='+window_lsm, 600, window_hight);
	});
});