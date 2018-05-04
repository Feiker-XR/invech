// JavaScript Document
var dbs  = null;
var data = null;
var window_hight	=	0; //窗口高度
var window_lsm		=	0; //窗口联赛名
function loaded(league,thispage,p){
	var league = encodeURI(league);
	$.getJSON("volleyball_bodan_data.php?leaguename="+league+"&CurrPage="+thispage+"&callback=?&randomNum="+Math.random(),function(json){
		var pagecount	=	json.fy.p_page;
		var page		=	json.fy.page;
		var fenye		=	"";
		window_hight	=	json.dh;
		window_lsm		=	json.lsm;
		var dbwidth = $(parent.window).width()-10;
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
		}else{
			for(var i=0; i<pagecount; i++){
				if(i != page){
					fenye+="<a href='javascript:NumPage(" + i + ");'><div class=\"sz_0\" id=\"page_this\">" + (i+1) + "</div></a>";
				}else{
					fenye+="<a href='javascript:NumPage(" + i + ");'><div class=\"sz_0\" id=\"page_this\"  style='color:#FFFFFF;background:url(../images/right_4.jpg);'>" + (i+1) + "</div></a>";
				}
			}
			$("#top").html(fenye);
			
			html="<div>";
			var lsm = "";
			for(var i=0; i<dbs.length; i++){
				
			if(lsm != dbs[i]["Match_Name"]){
					lsm = dbs[i]["Match_Name"];
					htmls+="<div class=\"liansai\"><span class=\"spfloatleft\"><a href=\"javascript:void(0)\" title='选择 >> "+lsm+"' onclick=\"javascript:check_one('"+lsm+"');\" style=\"color:#005481;\" >"+lsm+"</a></span><span class=\"spfloatright\"></span></div>";
			}
		htmls+="<div onmouseover=\"this.className='d_over'\" onmouseout=\"this.className='d_out'\">";	
  			html +="<div class='bisai_bo'>";
    			html +="<div class='bodan_xx zu_1'><table width=\"100%\" height=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td align=\"center\" valign=\"middle\">"+dbs[i]["Match_Date"]+"<br />"+dbs[i]["Match_Time"]+"<br />"+dbs[i]["str"]+"</td></tr></table></div>";
				html +="<div class='zhudui_bo'>";
	  				html +="<div class='bodan_x pq_bodan_2 zu_2Scolor1'>"+dbs[i]["Match_Master"]+"</div>";      
	  				html +="<div class='bodan_x zu_ruqiu_3'><a href=\"javascript:void(0)\" onclick=\"setbet('排球','波胆-2:0',"+dbs[i]["Match_ID"]+",'Match_Bd20','0','0','"+dbs[i]["Match_Master"]+"')\" style='"+(dbs[i]["Match_Bd20"]!=data[i]["Match_Bd20"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_Bd20"]=null ? " " : formatNumber(dbs[i]["Match_Bd20"],2))+"</a></div>";                   
	  				html +="<div class='bodan_x zu_ruqiu_3'><a href=\"javascript:void(0)\" onclick=\"setbet('排球','波胆-2:1',"+dbs[i]["Match_ID"]+",'Match_Bd21','0','0','"+dbs[i]["Match_Master"]+"')\" style='"+(dbs[i]["Match_Bd21"]!=data[i]["Match_Bd21"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_Bd21"]=null ? " " : formatNumber(dbs[i]["Match_Bd21"],2))+"</a></div>";	  
	  				html +="<div class='bodan_x zu_ruqiu_3'><a href=\"javascript:void(0)\" onclick=\"setbet('排球','波胆-3:0,"+dbs[i]["Match_ID"]+",'Match_Bd30','0','0','"+dbs[i]["Match_Master"]+"')\" style='"+(dbs[i]["Match_Bd30"]!=data[i]["Match_Bd30"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"' >"+(dbs[i]["Match_Bd30"]=null ? " " : formatNumber(dbs[i]["Match_Bd30"],2))+"</a></div>";
	  	  				html +="<div class='bodan_x zu_ruqiu_3'><a href=\"javascript:void(0)\" onclick=\"setbet('排球','波胆-3:1',"+dbs[i]["Match_ID"]+",'Match_Bd31','0','0','"+dbs[i]["Match_Master"]+"')\" style='"+(dbs[i]["Match_Bd31"]!=data[i]["Match_Bd31"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_Bd31"]=null ? " " : formatNumber(dbs[i]["Match_Bd31"],2))+"</a></div>";						
	  				html +="<div class='bodan_z zu_ruqiu_3'><a href=\"javascript:void(0)\" onclick=\"setbet('排球','波胆-3:2',"+dbs[i]["Match_ID"]+",'Match_Bd32','0','0','"+dbs[i]["Match_Master"]+"')\" style='"+(dbs[i]["Match_Bd32"]!=data[i]["Match_Bd32"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_Bd32"]=null ? " " : formatNumber(dbs[i]["Match_Bd32"],2))+"</a></div>";
				html +="</div>";
				html +="<div class='kedui_bo'>";
	  				html +="<div class='bodan_x pq_bodan_2 zu_2Scolor2'> "+dbs[i]["Match_Guest"]+"</div>";	  
	  				html +="<div class='bodan_x zu_ruqiu_3'><a href=\"javascript:void(0)\" onclick=\"setbet('排球','波胆-0:2',"+dbs[i]["Match_ID"]+",'Match_Bdg20','0','0','"+dbs[i]["Match_Guest"]+"')\" style='"+(dbs[i]["Match_Bdg20"]!=data[i]["Match_Bdg20"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_Bdg20"]=null ? " " : formatNumber(dbs[i]["Match_Bdg20"],2))+"</a></div>";
	  				html +="<div class='bodan_x zu_ruqiu_3'><a href=\"javascript:void(0)\" onclick=\"javascript:setbet('排球','波胆-1:2',"+dbs[i]["Match_ID"]+",'Match_Bdg21','0','0','"+dbs[i]["Match_Guest"]+"')\" style='"+(dbs[i]["Match_Bdg21"]!=data[i]["Match_Bdg21"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_Bdg21"]=null ? " " : formatNumber(dbs[i]["Match_Bdg21"],2))+"</a></div>";	 
	 				html +="<div class='bodan_x zu_ruqiu_3'><a href=\"javascript:void(0)\" onclick=\"setbet('排球','波胆-0:3',"+dbs[i]["Match_ID"]+",'Match_Bdg30','0','0','"+dbs[i]["Match_Guest"]+"')\" style='"+(dbs[i]["Match_Bdg30"]!=data[i]["Match_Bdg30"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_Bdg30"]=null ? " " : formatNumber(dbs[i]["Match_Bdg30"],2))+"</a></div>";
	 				html +="<div class='bodan_x zu_ruqiu_3'><a  href=\"javascript:void(0)\" onclick=\"setbet('排球','波胆-1:3',"+dbs[i]["Match_ID"]+",'Match_Bdg31','0','0','"+dbs[i]["Match_Guest"]+"')\" style='"+(dbs[i]["Match_Bdg31"]!=data[i]["Match_Bdg31"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_Bdg31"]=null ? " " : formatNumber(dbs[i]["Match_Bdg31"],2))+"</a></div>";
	 	  				html +="<div class='bodan_z zu_ruqiu_3'><a href=\"javascript:void(0)\"  onclick=\"setbet('排球','波胆-2:3',"+dbs[i]["Match_ID"]+",'Match_Bdg32','0','0','"+dbs[i]["Match_Guest"]+"')\" style='"+(dbs[i]["Match_Bdg32"]!=data[i]["Match_Bdg32"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_Bdg32"]=null ? " " : formatNumber(dbs[i]["Match_Bdg32"],2))+"</a></div>";
				html +="</div>";
			html +=" </div>";
		html +=" </div>";	
			
		}
			html +="</div>";
			
			if(html == "<div></div>"){
				html = "<div style='line-height:40px;text-align:center;color:#000000; border-bottom:1px solid #999;'>暂无赛事</div>";
			}
			$("#datashow").html(html);
			$(".panel").width(dbwidth);
		}
		//document.documentElement.scrollTop	=	$("#top_f5").val(); //导航标题高度
		$("#top_f5").val('0');
		gdt();
	});
}

$(document).ready(function(){
	$("#xzls").click(function(){ //选择联赛
		JqueryDialog.Open('排球波胆', 'dialog.php?lsm='+window_lsm, 600, window_hight);
	});
});