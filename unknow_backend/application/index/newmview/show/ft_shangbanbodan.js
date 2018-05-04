// JavaScript Document
var dbs  = null;
var data = null;
var window_hight	=	0; //窗口高度
var window_lsm		=	0; //窗口联赛名
function loaded(league,thispage,p){
	var league = encodeURI(league);
	$.getJSON("ft_shangbanbodan_data.php?leaguename="+league+"&CurrPage="+thispage+"&callback=?",function(json){
		var pagecount	=	json.fy.p_page;
		var messagecount=	json.fy.count_num;
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
			$("#top").html('');
		}else{
			for(var i=0; i<pagecount; i++){
				if(i != page){
					fenye+="<a href='javascript:NumPage(" + i + ");'><div class=\"sz_0\" id=\"page_this\">" + (i+1) + "</div></a>";
				}else{
					fenye+="<a href='javascript:NumPage(" + i + ");'><div class=\"sz_0\" id=\"page_this\"  style='color:#FFFFFF;background:url(../images/right_4.jpg);'>" + (i+1) + "</div></a>";
				}
			}
			$("#top").html(fenye);
			
			var htmls="<div>";
			var lsm = "";
			for(var i=0; i<dbs.length; i++){
				if(lsm != dbs[i]["Match_Name"]){
					lsm = dbs[i]["Match_Name"];
					htmls+="<div class=\"liansai\"><span class=\"spfloatleft\"><a href=\"javascript:void(0)\" title='选择 >> "+lsm+"' onclick=\"javascript:check_one('"+lsm+"');\" style=\"color:#005481;\" >"+lsm+"</a></span><span class=\"spfloatright\"></span></div>";
				}
				htmls+="<div onmouseover=\"this.className='d_over'\" onmouseout=\"this.className='d_out'\">";
				htmls+="<div class='bisai_bo'>";
					htmls+="<div class='bodan_xx zu_1'><table width=\"100%\" height=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td align=\"center\" valign=\"middle\">"+dbs[i]["Match_Date"]+"</td></tr></table></div>";
					htmls+="<div class='zhudui_bo_1'>"
						htmls+="<div class='zhudui_bo'>";
							htmls+="<div class='bodan_x zu_bodan_2 zu_2Scolor1'>"+dbs[i]["Match_Master"]+"</div>";
							htmls+="<div class='bodan_x zu_bodan_4'>"+((dbs[i]["Match_Bd10"] !=null && dbs[i]["Match_Bd10"]!="0") ? "<a onclick=\"javascript:setbet('足球单式','上半波胆-1:0','" + dbs[i]["Match_ID"] + "','Match_Hr_Bd10','0','0','"+dbs[i]["Match_Master"]+"');\" href=\"javascript:void(0)\" title=\"1:0\" style='"+(dbs[i]["Match_Bd10"]!=data[i]["Match_Bd10"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+dbs[i]["Match_Bd10"]+"</a>":"")+"</div>";
							htmls+="<div class='bodan_x zu_bodan_4'>"+((dbs[i]["Match_Bd20"] !=null && dbs[i]["Match_Bd20"] !="0") ? "<a href=\"javascript:void(0)\" title=\"2:0\" onclick=\"javascript:setbet('足球单式','上半波胆-2:0','" + dbs[i]["Match_ID"] + "','Match_Hr_Bd20','0','0','"+dbs[i]["Match_Master"]+"');\" style='"+(dbs[i]["Match_Bd20"]!=data[i]["Match_Bd20"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+dbs[i]["Match_Bd20"]+"</a>":"")+"</div>";
							htmls+="<div class='bodan_x zu_bodan_4'>"+((dbs[i]["Match_Bd21"] !=null && dbs[i]["Match_Bd21"] !="0")?"<a href=\"javascript:void(0)\" title=\"2:1\" onclick=\"javascript:setbet('足球单式','上半波胆-2:1','" + dbs[i]["Match_ID"] + "','Match_Hr_Bd21','0','0','"+dbs[i]["Match_Master"]+"');\" style='"+(dbs[i]["Match_Bd21"]!=data[i]["Match_Bd21"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_Bd21"])+"</a>":"")+"</div>";
							htmls+="<div class=\"bodan_x zu_bodan_4\">"+((dbs[i]["Match_Bd30"] !=null && dbs[i]["Match_Bd30"] !="0")?"<a href=\"javascript:void(0)\" title=\"3:0\" onclick=\"javascript:setbet('足球单式','上半波胆-3:0','" + dbs[i]["Match_ID"] + "','Match_Hr_Bd30','0','0','"+dbs[i]["Match_Master"]+"');\" style='"+(dbs[i]["Match_Bd30"]!=data[i]["Match_Bd30"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_Bd30"])+"</a>":"")+"</div>";
							htmls+="<div class=\"bodan_x zu_bodan_4\">"+((dbs[i]["Match_Bd31"] !=null && dbs[i]["Match_Bd31"] !="0")?"<a href=\"javascript:void(0)\" title=\"3:1\" onclick=\"javascript:setbet('足球单式','上半波胆-3:1','" + dbs[i]["Match_ID"] + "','Match_Hr_Bd31','0','0','"+dbs[i]["Match_Master"]+"');\" style='"+(dbs[i]["Match_Bd31"]!=data[i]["Match_Bd31"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+dbs[i]["Match_Bd31"]+"</a>":"")+"</div>";
							htmls+="<div class=\"bodan_x zu_bodan_4\">"+((dbs[i]["Match_Bd32"] !=null && dbs[i]["Match_Bd32"] !="0")?"<a href=\"javascript:void(0)\" title=\"3:2\" onclick=\"javascript:setbet('足球单式','上半波胆-3:2','" + dbs[i]["Match_ID"] + "','Match_Hr_Bd32','0','0','"+dbs[i]["Match_Master"]+"');\" style='"+(dbs[i]["Match_Bd32"]!=data[i]["Match_Bd32"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+dbs[i]["Match_Bd32"]+"</a>":"")+"</div>";
							htmls+="<div class=\"bodan_x zu_bodan_4\">"+((dbs[i]["Match_Bd40"] !=null && dbs[i]["Match_Bd40"] !="0")?"<a href=\"javascript:void(0)\" title=\"4:0\" onclick=\"javascript:setbet('足球单式','上半波胆-4:0','" + dbs[i]["Match_ID"] + "','Match_Hr_Bd40','0','0','"+dbs[i]["Match_Master"]+"');\" style='"+(dbs[i]["Match_Bd40"]!=data[i]["Match_Bd40"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+dbs[i]["Match_Bd40"]+"</a>":"")+"</div>";
							htmls+="<div class=\"bodan_x zu_bodan_4\">"+((dbs[i]["Match_Bd41"] !=null && dbs[i]["Match_Bd41"] !="0")?"<a href=\"javascript:void(0)\" title=\"4:1\" onclick=\"javascript:setbet('足球单式','上半波胆-4:1','" + dbs[i]["Match_ID"] + "','Match_Hr_Bd41','0','0','"+dbs[i]["Match_Master"]+"');\" style='"+(dbs[i]["Match_Bd41"]!=data[i]["Match_Bd41"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+dbs[i]["Match_Bd41"]+"</a>":"")+"</div>";
							htmls+="<div class=\"bodan_x zu_bodan_4\">"+((dbs[i]["Match_Bd42"] !=null && dbs[i]["Match_Bd42"] !="0")?"<a href=\"javascript:void(0)\" title=\"4:2\" onclick=\"javascript:setbet('足球单式','上半波胆-4:2','" + dbs[i]["Match_ID"] + "','Match_Hr_Bd42','0','0','"+dbs[i]["Match_Master"]+"');\" style='"+(dbs[i]["Match_Bd42"]!=data[i]["Match_Bd42"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+dbs[i]["Match_Bd42"]+"</a>":"")+"</div>";
							htmls+="<div class=\"bodan_x zu_bodan_4\">"+((dbs[i]["Match_Bd43"] !=null && dbs[i]["Match_Bd43"] !="0")?"<a href=\"javascript:void(0)\" title=\"4:3\" onclick=\"javascript:setbet('足球单式','上半波胆-4:3','" + dbs[i]["Match_ID"] + "','Match_Hr_Bd43','0','0','"+dbs[i]["Match_Master"]+"');\" style='"+(dbs[i]["Match_Bd43"]!=data[i]["Match_Bd43"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+dbs[i]["Match_Bd43"]+"</a>":"")+"</div>";
						htmls+="</div>";
						htmls+="<div class=\"kedui_bo\">";
							htmls+="<div class=\"bodan_x zu_bodan_2 zu_2Scolor2\">"+dbs[i]["Match_Guest"]+"</div>";
							htmls+="<div class=\"bodan_x zu_bodan_4\">"+((dbs[i]["Match_Bdg10"] !=null && dbs[i]["Match_Bdg10"] !="0")?"<a href=\"javascript:void(0)\" title=\"0:1\" onclick=\"javascript:setbet('足球单式','上半波胆-0:1','" + dbs[i]["Match_ID"] + "','Match_Hr_Bdg10','0','0','"+dbs[i]["Match_Guest"]+"');\" style='"+(dbs[i]["Match_Bdg10"]!=data[i]["Match_Bdg10"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+dbs[i]["Match_Bdg10"]+"</a>":"")+"</div>";
							htmls+="<div class=\"bodan_x zu_bodan_4\">"+((dbs[i]["Match_Bdg20"] !=null && dbs[i]["Match_Bdg20"] !="0")?"<a href=\"javascript:void(0)\" title=\"0:2\" onclick=\"javascript:setbet('足球单式','上半波胆-0:2','" + dbs[i]["Match_ID"] + "','Match_Hr_Bdg20','0','0','"+dbs[i]["Match_Guest"]+"');\" style='"+(dbs[i]["Match_Bdg20"]!=data[i]["Match_Bdg20"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+dbs[i]["Match_Bdg20"]+"</a>":"")+"</div>";
							htmls+="<div class=\"bodan_x zu_bodan_4\">"+((dbs[i]["Match_Bdg21"] !=null && dbs[i]["Match_Bdg21"] !="0")?"<a href=\"javascript:void(0)\" title=\"1:2\" onclick=\"javascript:setbet('足球单式','上半波胆-1:2','" + dbs[i]["Match_ID"] + "','Match_Hr_Bdg21','0','0','"+dbs[i]["Match_Guest"]+"');\" style='"+(dbs[i]["Match_Bdg21"]!=data[i]["Match_Bdg21"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+dbs[i]["Match_Bdg21"]+"</a>":"")+"</div>";
							htmls+="<div class=\"bodan_x zu_bodan_4\">"+((dbs[i]["Match_Bdg30"] !=null && dbs[i]["Match_Bdg30"] !="0")?"<a href=\"javascript:void(0)\" title=\"0:3\" onclick=\"javascript:setbet('足球单式','上半波胆-0:3','" + dbs[i]["Match_ID"] + "','Match_Hr_Bdg30','0','0','"+dbs[i]["Match_Guest"]+"');\" style='"+(dbs[i]["Match_Bdg30"]!=data[i]["Match_Bdg30"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+dbs[i]["Match_Bdg30"]+"</a>":"")+"</div>";
							htmls+="<div class=\"bodan_x zu_bodan_4\">"+((dbs[i]["Match_Bdg31"] !=null && dbs[i]["Match_Bdg31"] !="0")?"<a href=\"javascript:void(0)\" title=\"1:3\" onclick=\"javascript:setbet('足球单式','上半波胆-1:3','" + dbs[i]["Match_ID"] + "','Match_Hr_Bdg31','0','0','"+dbs[i]["Match_Guest"]+"');\" style='"+(dbs[i]["Match_Bdg31"]!=data[i]["Match_Bdg31"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+dbs[i]["Match_Bdg31"]+"</a>":"")+"</div>";
							htmls+="<div class=\"bodan_x zu_bodan_4\">"+((dbs[i]["Match_Bdg32"] !=null && dbs[i]["Match_Bdg32"] !="0")?"<a href=\"javascript:void(0)\" title=\"2:3\" onclick=\"javascript:setbet('足球单式','上半波胆-2:3','" + dbs[i]["Match_ID"] + "','Match_Hr_Bdg32','0','0','"+dbs[i]["Match_Guest"]+"');\" style='"+(dbs[i]["Match_Bdg32"]!=data[i]["Match_Bdg32"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+dbs[i]["Match_Bdg32"]+"</a>":"")+"</div>";
							htmls+="<div class=\"bodan_x zu_bodan_4\">"+((dbs[i]["Match_Bdg40"] !=null && dbs[i]["Match_Bdg40"] !="0")?"<a href=\"javascript:void(0)\" title=\"0:4\" onclick=\"javascript:setbet('足球单式','上半波胆-0:4','" + dbs[i]["Match_ID"] + "','Match_Hr_Bdg40','0','0','"+dbs[i]["Match_Guest"]+"');\" style='"+(dbs[i]["Match_Bdg40"]!=data[i]["Match_Bdg40"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+dbs[i]["Match_Bdg40"]+"</a>":"")+"</div>";
							htmls+="<div class=\"bodan_x zu_bodan_4\">"+((dbs[i]["Match_Bdg41"] !=null && dbs[i]["Match_Bdg41"] !="0")?"<a href=\"javascript:void(0)\" title=\"1:4\" onclick=\"javascript:setbet('足球单式','上半波胆-1:4','" + dbs[i]["Match_ID"] + "','Match_Hr_Bdg41','0','0','"+dbs[i]["Match_Guest"]+"');\" style='"+(dbs[i]["Match_Bdg41"]!=data[i]["Match_Bdg41"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+dbs[i]["Match_Bdg41"]+"</a>":"")+"</div>";
							htmls+="<div class=\"bodan_x zu_bodan_4\">"+((dbs[i]["Match_Bdg42"] !=null && dbs[i]["Match_Bdg42"] !="0")?"<a href=\"javascript:void(0)\" title=\"2:4\" onclick=\"javascript:setbet('足球单式','上半波胆-2:4','" + dbs[i]["Match_ID"] + "','Match_Hr_Bdg42','0','0','"+dbs[i]["Match_Guest"]+"');\" style='"+(dbs[i]["Match_Bdg42"]!=data[i]["Match_Bdg42"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+dbs[i]["Match_Bdg42"]+"</a>":"")+"</div>";
							htmls+="<div class=\"bodan_x zu_bodan_4\">"+((dbs[i]["Match_Bdg43"] !=null && dbs[i]["Match_Bdg43"] !="0")?"<a href=\"javascript:void(0)\" title=\"3:4\" onclick=\"javascript:setbet('足球单式','上半波胆-3:4','" + dbs[i]["Match_ID"] + "','Match_Hr_Bdg43','0','0','"+dbs[i]["Match_Guest"]+"');\" style='"+(dbs[i]["Match_Bdg43"]!=data[i]["Match_Bdg43"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+dbs[i]["Match_Bdg43"]+"</a>":"")+"</div>";
						htmls+="</div>";
					htmls+="</div>";
					htmls+="<div class=\"bodan_xx zu_bodan_6\">"+((dbs[i]["Match_Bd00"] !=null && dbs[i]["Match_Bd00"] !="0")?"<a href=\"javascript:void(0)\" title=\"0:0\" onclick=\"javascript:setbet('足球单式','上半波胆-0:0','" + dbs[i]["Match_ID"] + "','Match_Hr_Bd00','0','0','0:0');\" style='"+(dbs[i]["Match_Bd00"]!=data[i]["Match_Bd00"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+dbs[i]["Match_Bd00"]+"</a>":"")+"</div>";
					htmls+="<div class=\"bodan_xx zu_bodan_6\">"+((dbs[i]["Match_Bd11"] !=null && dbs[i]["Match_Bd11"] !="0")?"<a href=\"javascript:void(0)\" title=\"1:1\" onclick=\"javascript:setbet('足球单式','上半波胆-1:1','" + dbs[i]["Match_ID"] + "','Match_Hr_Bd11','0','0','1:1');\" style='"+(dbs[i]["Match_Bd11"]!=data[i]["Match_Bd11"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+dbs[i]["Match_Bd11"]+"</a>":"")+"</div>";
					htmls+="<div class=\"bodan_xx zu_bodan_6\">"+((dbs[i]["Match_Bd22"] !=null && dbs[i]["Match_Bd22"] !="0")?"<a href=\"javascript:void(0)\" title=\"2:2\" onclick=\"javascript:setbet('足球单式','上半波胆-2:2','" + dbs[i]["Match_ID"] + "','Match_Hr_Bd22','0','0','2:2');\" style='"+(dbs[i]["Match_Bd22"]!=data[i]["Match_Bd22"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+dbs[i]["Match_Bd22"]+"</a>":"")+"</div>";
					htmls+="<div class=\"bodan_xx zu_bodan_6\">"+((dbs[i]["Match_Bd33"] !=null && dbs[i]["Match_Bd33"] !="0")?"<a href=\"javascript:void(0)\" title=\"3:3\" onclick=\"javascript:setbet('足球单式','上半波胆-3:3','" + dbs[i]["Match_ID"] + "','Match_Hr_Bd33','0','0','3:3');\" style='"+(dbs[i]["Match_Bd33"]!=data[i]["Match_Bd33"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+dbs[i]["Match_Bd33"]+"</a>":"")+"</div>";
					htmls+="<div class=\"bodan_xx zu_bodan_6\">"+((dbs[i]["Match_Bd44"] !=null && dbs[i]["Match_Bd44"] !="0")?"<a href=\"javascript:void(0)\" title=\"4:4\" onclick=\"javascript:setbet('足球单式','上半波胆-4:4','" + dbs[i]["Match_ID"] + "','Match_Hr_Bd44','0','0','4:4');\" style='"+(dbs[i]["Match_Bd44"]!=data[i]["Match_Bd44"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+dbs[i]["Match_Bd44"]+"</a>":"")+"</div>";
					htmls+="<div class=\"bodan_zz zu_bodan_6\">"+((dbs[i]["Match_Bdup5"] !=null && dbs[i]["Match_Bdup5"] !="0")?"<a href=\"javascript:void(0)\" title=\"其它比分\" onclick=\"javascript:setbet('足球单式','上半波胆-UP5','" + dbs[i]["Match_ID"] + "','Match_Hr_Bdup5','0','0','UP5');\" style='"+(dbs[i]["Match_Bdup5"]!=data[i]["Match_Bdup5"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+dbs[i]["Match_Bdup5"]+"</a>":"")+"</div>";
				htmls+="</div>";
				htmls+="</div>";
			}

			htmls+="</div>";
			if(htmls == "<div></div>"){
				htmls = "<div style='line-height:40px;text-align:center;color:#000000; border-bottom:1px solid #999;'>暂无赛事</div>";
			}
			$("#datashow").html(htmls);
			$(".panel").width(dbwidth);
		}
		//document.documentElement.scrollTop	=	$("#top_f5").val(); //导航标题高度
		$("#top_f5").val('0');
		gdt();
	})
}

$(document).ready(function(){
	$("#xzls").click(function(){ //选择联赛
		JqueryDialog.Open('足球上半波胆', 'dialog.php?lsm='+window_lsm, 600, window_hight);
	});
});