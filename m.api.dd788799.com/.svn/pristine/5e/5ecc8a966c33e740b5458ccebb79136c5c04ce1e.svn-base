// JavaScript Document
var dbs  = null;
var data = null;
var window_hight	=	0; //窗口高度
var window_lsm		=	0; //窗口联赛名
function loaded(league,thispage,p){
	var league = encodeURI(league);
	$.getJSON("ft_shangbanchang_data.php?leaguename="+league+"&CurrPage="+thispage+"&callback=?",function(json){
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
				if(dbs[i]["Match_Bmdy"]!="0" || dbs[i]["Match_BHo"]!="0" || dbs[i]["Match_Bdpl"]!="0"){
				if(lsm != dbs[i]["Match_Name"]){
					lsm = dbs[i]["Match_Name"];
					htmls+="<div class=\"liansai\"><span class=\"spfloatleft\"><a href=\"javascript:void(0)\" title='选择 >> "+lsm+"' onclick=\"javascript:check_one('"+lsm+"');\" style=\"color:#005481;\" >"+lsm+"</a></span><span class=\"spfloatright\"></span></div>";
				}
				htmls+="<div onmouseover=\"this.className='d_over'\" onmouseout=\"this.className='d_out'\">";
				htmls +="<div class='bisai'>";
					htmls +="<div class='hui_xx zu_1'><table width=\"100%\" height=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td align=\"center\" valign=\"middle\">"+dbs[i]["Match_Date"]+"</td></tr></table></div>";
					htmls +="<div class='zhudui'>";
						htmls +="<div class='hui_x zu_shang_2 zu_2Scolor1'>"+dbs[i]["Match_Master"]+"-[上半]</div>";
						htmls +="<div class='hui_x zu_3'>"+(dbs[i]["Match_Bmdy"] !=null?"<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Master"]+"\" onclick=\"setbet('足球上半场','上半场标准盘-"+ dbs[i]["Match_Master"] +"-独赢','" + dbs[i]["Match_ID"] + "','Match_Bmdy','0','0','"+dbs[i]["Match_Master"]+"-[上半]');\" style='"+(dbs[i]["Match_Bmdy"]!=data[i]["Match_Bmdy"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_Bmdy"]!="0"?formatNumber(dbs[i]["Match_Bmdy"],2):"")+"</a>":"")+"</div>";
						htmls +="<div class='hui_x zu_4'>";
							htmls +="<div class='hui_z zu_4_1'>"+((dbs[i]["Match_Hr_ShowType"] =="H" && dbs[i]["Match_BHo"] !=0)?dbs[i]["Match_BRpk"]:"")+"</div>";
							htmls +="<div class='hui_z zu_4_2'>"+(dbs[i]["Match_BHo"] !=null?"<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Master"]+"\" onclick=\"setbet('足球上半场','上半场让球-"+(dbs[i]["Match_Hr_ShowType"] =="H"?"主让":"客让")+dbs[i]["Match_BRpk"]+"-"+dbs[i]["Match_Master"] + "','" + dbs[i]["Match_ID"] + "','Match_BHo','1','0','"+dbs[i]["Match_Master"]+"-[上半]'); \"style='"+(dbs[i]["Match_BHo"]!=data[i]["Match_BHo"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_BHo"]!="0"?formatNumber(dbs[i]["Match_BHo"],2):"")+"</a>":"")+"</div>";
						htmls +="</div>";
						htmls +="<div class='hui_z zu_4'>";
							htmls +="<div class='hui_z zu_4_1'>"+((dbs[i]["Match_Bdxpk1"]!="O")?dbs[i]["Match_Bdxpk1"].replace("@",""):"")+"</div>";
							htmls +="<div class='hui_z zu_4_2'>"+(dbs[i]["Match_Bdpl"] !=null?"<a href=\"javascript:void(0)\" title=\"大\" onclick=\"setbet('足球上半场','上半场大小-"+dbs[i]["Match_Bdxpk1"]+"','" + dbs[i]["Match_ID"] + "','Match_Bdpl','1','0','"+dbs[i]["Match_Bdxpk1"].replace("@","")+"');\" style='"+(dbs[i]["Match_Bdpl"]!=data[i]["Match_Bdpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_Bdpl"]!="0"?formatNumber(dbs[i]["Match_Bdpl"],2):"")+"</a>":"")+"</div>";
						htmls +="</div>";
					htmls +="</div>";
					htmls +="<div class='kedui'>";
						htmls +="<div class='hui_x zu_shang_2 zu_2Scolor2'>"+dbs[i]["Match_Guest"]+"-[上半]</div>";
						htmls +="<div class='hui_x zu_3'>"+(dbs[i]["Match_Bgdy2"] !=null?"<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Guest"]+"\" onclick=\"setbet('足球上半场','上半场标准盘-"+ dbs[i]["Match_Guest"] +"-独赢','" + dbs[i]["Match_ID"] + "','Match_Bgdy','0','0','"+dbs[i]["Match_Guest"]+"-[上半]');\" style='"+(dbs[i]["Match_Bgdy2"]!=data[i]["Match_Bgdy2"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_Bgdy2"]!="0"?formatNumber(dbs[i]["Match_Bgdy2"],2):"")+"</a>":"")+"</div>";
						htmls +="<div class='hui_x zu_4'>";
							htmls +="<div class='hui_z zu_4_1'>"+((dbs[i]["Match_Hr_ShowType"] =="C" && dbs[i]["Match_BAo"] !="0")?dbs[i]["Match_BRpk"]:"")+"</div>";
							htmls +="<div class='hui_z zu_4_2'>"+(dbs[i]["Match_BAo"] !=null?"<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Guest"]+"\" onclick=\"setbet('足球上半场','上半场让球-"+(dbs[i]["Match_Hr_ShowType"] =="H"?"主让":"客让")+dbs[i]["Match_BRpk"]+"-"+dbs[i]["Match_Guest"] + "','" + dbs[i]["Match_ID"] + "','Match_BAo','1','0','"+dbs[i]["Match_Guest"]+"-[上半]');\" style='"+(dbs[i]["Match_BAo"]!=data[i]["Match_BAo"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_BAo"]!="0"?formatNumber(dbs[i]["Match_BAo"],2):"")+"</a>":"")+"</div>";
						htmls +="</div>";
						htmls +="<div class='hui_z zu_4'>";
							htmls +="<div class='hui_z zu_4_1'>"+((dbs[i]["Match_Bdxpk2"]!="U")?dbs[i]["Match_Bdxpk2"].replace("@",""):"")+"</div>";
							htmls +="<div class='hui_z zu_4_2'>"+(dbs[i]["Match_Bxpl"] !=null?"<a href=\"javascript:void(0)\" title=\"小\" onclick=\"setbet('足球上半场','上半场大小-"+dbs[i]["Match_Bdxpk2"]+"','" + dbs[i]["Match_ID"] + "','Match_Bxpl','1','0','"+dbs[i]["Match_Bdxpk2"].replace("@","")+"');\" style='"+(dbs[i]["Match_Bxpl"]!=data[i]["Match_Bxpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_Bxpl"]!="0"?formatNumber(dbs[i]["Match_Bxpl"],2):"")+"</a>":"")+"</div>";
						htmls +="</div>";
					htmls +="</div>";
					htmls +="<div class='kedui'>";
						htmls +="<div class='hui_x zu_shang_2 zu_2Scolor3'>和局</div>";
						htmls +="<div class=\"heju_1\">"+(dbs[i]["Match_Bhdy2"] !=null?((dbs[i]["Match_Bhdy2"]-0.05)>0 ?"<a href=\"javascript:void(0)\"  title=\"和局\" onclick=\"setbet('足球上半场','上半场标准盘-和局','" + dbs[i]["Match_ID"] + "','Match_Bhdy','0','0','和局');\" style='"+(dbs[i]["Match_Bhdy2"]!=data[i]["Match_Bhdy2"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_Bhdy2"]!="0"?formatNumber(dbs[i]["Match_Bhdy2"],2):"")+"</a>":""):"")+"</div><div class='hui_d zu_shang_5'></div>";
					htmls +="</div>";
				htmls +="</div>";
			htmls+="</div>";
			}
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
		if(window_lsm.length > 2000){
			if(window.XMLHttpRequest){ //Mozilla, Safari, IE7 
				if(!window.ActiveXObject){ // Mozilla, Safari, 
					JqueryDialog.Open('足球上半场', 'dialog.php?lsm='+window_lsm, 600, window_hight);
				}else{ //IE7
					JqueryDialog.Open('足球上半场', 'dialog.php?lsm=zqsbc', 600, window_hight);
				}
			}else{ //IE6
				JqueryDialog.Open('足球上半场', 'dialog.php?lsm=zqsbc', 600, window_hight);
			}
		}else{
			JqueryDialog.Open('足球上半场', 'dialog.php?lsm='+window_lsm, 600, window_hight);
		}
	});
});