// JavaScript Document
var dbs  = null;
var data = null;
var window_hight	=	0; //窗口高度
var window_lsm		=	0; //窗口联赛名
function loaded(league,thispage,p){
	var league = encodeURI(league);
	$.getJSON("/index.php/sport/FT_1_1.html?leaguename="+league+"&CurrPage="+thispage+"&callback=?",function(json){	
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
		
		if(pagecount == 0){
			$("#datashow").html('<table class="table table-bordered table-hover"><thead><tr class="success"><th data-toggle="true">赛程<br>点击每行展开</th><th>时间<br>主队 / 客队</th><th data-hide="phone,tablet">全场[1X2]</th><th data-hide="phone,tablet">全场[让球]</th><th data-hide="phone,tablet">全场[大小]</th><th data-hide="phone,tablet">上半场[1X2]</th><th data-hide="phone,tablet">上半场[让球]</th><th data-hide="phone,tablet">上半场[大小]</th></tr></thead><tbody><tr><td height="100" colspan="8" align="center" bgcolor="#FFFFFF"><img src="/images/loading.gif" border="0" />暂无任何赛事</td></tr></tbody></table>');
			$("#top").html('');
		}else{
			for(var i=0; i<pagecount; i++){
				if(i != page){
					fenye+="<li><a href='javascript:NumPage(" + i + ");' id=\"page_this\">" + (i+1) + "</a></li>";
				}else{
					fenye+="<li class='active'><a href='javascript:NumPage(" + i + ");' id=\"page_this\">" + (i+1) + "</a></li>";
				}
			}
			$("#top").html(fenye);
			
			var htmls='<table class="table table-bordered table-hover"><thead><tr class="success"><th data-toggle="true">赛程<br>点击每行展开</th><th>时间<br>主队 / 客队</th><th data-hide="phone,tablet">全场[1X2]</th><th data-hide="phone,tablet">全场[让球]</th><th data-hide="phone,tablet">全场[大小]</th><th data-hide="phone,tablet">上半场[1X2]</th><th data-hide="phone,tablet">上半场[让球]</th><th data-hide="phone,tablet">上半场[大小]</th></tr></thead><tbody>';
			var lsm = "";
			for(var i=0; i<dbs.length; i++){
				if(dbs[i]["Match_BzM"]!="0" || dbs[i]["Match_Ho"]!=0 || dbs[i]["Match_DxXpl"]!="0" || dbs[i]["Match_DsDpl"]!="0"){
				lsm = dbs[i]["Match_Name"];
				htmls+="<tr>";
				htmls+="<td><a href=\"javascript:void(0)\" title='选择 >> "+lsm+"' onclick=\"javascript:check_one('"+lsm+"');\" >"+lsm+"</a></td>";
				htmls+="<td><span class=\"red\">"+dbs[i]["Match_Date"]+"</span><br><span class='zhu'>"+dbs[i]["Match_Master"]+"</span>-<span class='ke'>"+dbs[i]["Match_Guest"]+"</span>-<span class='he'>和局</span></td>";
				htmls+="<td><div class=\"btn-group\">"+(dbs[i]["Match_BzM"]=="0" ? "" :("<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Master"]+"\" onclick=\"javascript:setbet('足球单式','标准盘-"+dbs[i]["Match_Master"]+"-独赢','"+dbs[i]["Match_ID"]+"','Match_BzM','0','0','"+dbs[i]["Match_Master"]+"');\" style='"+(dbs[i]["Match_BzM"]!=data[i]["Match_BzM"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f;":"")+"'>"+formatNumber(dbs[i]["Match_BzM"],2)+"</a>"))+(dbs[i]["Match_BzG"]=="0" ? "" :("<a class=\"btn btn-lg btn-info\" href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Guest"]+"\" onclick=\"javascript:setbet('足球单式','标准盘-"+dbs[i]["Match_Guest"]+"-独赢','"+dbs[i]["Match_ID"]+"','Match_BzG','0','0','"+dbs[i]["Match_Guest"]+"');\" style='"+(dbs[i]["Match_BzG"]!=data[i]["Match_BzG"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f;":"")+"'>"+formatNumber(dbs[i]["Match_BzG"],2)+"</a>"))+((dbs[i]["Match_BzH"]==null || (dbs[i]["Match_BzH"]-0.05<=0)) ? "" :("<a class=\"btn btn-lg btn-warning\" href=\"javascript:void(0)\" title=\"和局\" onclick=\"javascript:setbet('足球单式','标准盘-和局','"+dbs[i]["Match_ID"]+"','Match_BzH','0','0','和局');\" style='"+(dbs[i]["Match_BzH"]!=data[i]["Match_BzH"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f;":"")+"'>"+formatNumber(dbs[i]["Match_BzH"],2)+"</a>"))+"</div></td>";
				htmls+="<td><div class='rangqiu_odds'><span class='odds'>"+(dbs[i]["Match_Ho"]==null ? "" :("<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Master"]+"\" onclick=\"javascript:setbet('足球单式','让球-"+(dbs[i]["Match_ShowType"]=="H" ? "主让" :"客让")+dbs[i]["Match_RGG"]+"-"+dbs[i]["Match_Master"]+"','"+dbs[i]["Match_ID"]+"','Match_Ho','1','0','"+dbs[i]["Match_Master"]+"');\" style='"+(dbs[i]["Match_Ho"]!=data[i]["Match_Ho"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f;":"")+"'>"+formatNumber(dbs[i]["Match_Ho"],2)+"</a>"))+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">"+((dbs[i]["Match_ShowType"]=="H" && dbs[i]["Match_Ho"]!="0") ?dbs[i]["Match_RGG"] : "")+"</a></span><br><span class='odds'>"+(dbs[i]["Match_Ao"]!=null ?("<a class=\"btn btn-lg btn-info\" href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Guest"]+"\" onclick=\"javascript:setbet('足球单式','让球-"+(dbs[i]["Match_ShowType"]=="H" ? "主让" :"客让")+dbs[i]["Match_RGG"]+"-"+dbs[i]["Match_Guest"]+"','"+dbs[i]["Match_ID"]+"','Match_Ao','1','0','"+dbs[i]["Match_Guest"]+"');\" style='"+(dbs[i]["Match_Ao"]!=data[i]["Match_Ao"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f;":"")+"'>"+formatNumber(dbs[i]["Match_Ao"],2)+"</a>") : "")+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">"+((dbs[i]["Match_ShowType"]=="C" && dbs[i]["Match_Ao"]!="0") ?dbs[i]["Match_RGG"] : "")+"</a></span><br>&nbsp;</div></td>";
				htmls+="    <td><div class='rangqiu_odds'><span class='odds'>"+(dbs[i]["Match_DxDpl"]==null || dbs[i]["Match_DxXpl"]=="0" ? "" :("<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\"大\" onclick=\"javascript:setbet('足球单式','大小-"+dbs[i]["Match_DxGG1"]+"','"+dbs[i]["Match_ID"]+"','Match_DxDpl','1','0','"+dbs[i]["Match_DxGG1"]+"');\" style='"+(dbs[i]["Match_DxGG1"]!=data[i]["Match_DxGG1"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f;":"")+"'>"+formatNumber(dbs[i]["Match_DxDpl"],2)+"</a>"))+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">"+(dbs[i]["Match_DxGG1"]!="0" ? dbs[i]["Match_DxGG1"] :"")+"</a></span><br><span class='odds'>"+(dbs[i]["Match_DxXpl"]==null || dbs[i]["Match_DxXpl"]=="0" ? "" :("<a class=\"btn btn-lg btn-info\" href=\"javascript:void(0)\" title=\"小\" onclick=\"javascript:setbet('足球单式','大小-"+dbs[i]["Match_DxGG2"]+"','"+dbs[i]["Match_ID"]+"','Match_DxXpl','1','0','"+dbs[i]["Match_DxGG2"]+"');\" style='"+(dbs[i]["Match_DxXpl"]!=data[i]["Match_DxXpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f;":"")+"'>"+formatNumber(dbs[i]["Match_DxXpl"],2)+"</a>"))+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">"+(dbs[i]["Match_DxGG1"]=="0" ? "" :dbs[i]["Match_DxGG2"])+"</a></span><br>&nbsp;</div></td>";
				htmls+="<td><div class=\"btn-group\">"+(dbs[i]["Match_Bmdy"] !=null?"<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Master"]+"\" onclick=\"setbet('足球上半场','上半场标准盘-"+ dbs[i]["Match_Master"] +"-独赢','" + dbs[i]["Match_ID"] + "','Match_Bmdy','0','0','"+dbs[i]["Match_Master"]+"-[上半]');\" style='"+(dbs[i]["Match_Bmdy"]!=data[i]["Match_Bmdy"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f;":"")+"'>"+(dbs[i]["Match_Bmdy"]!="0"?formatNumber(dbs[i]["Match_Bmdy"],2):"")+"</a>":"")+"</a>"+(dbs[i]["Match_Bgdy2"] !=null?"<a class=\"btn btn-lg btn-info\" href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Guest"]+"\" onclick=\"setbet('足球上半场','上半场标准盘-"+ dbs[i]["Match_Guest"] +"-独赢','" + dbs[i]["Match_ID"] + "','Match_Bgdy','0','0','"+dbs[i]["Match_Guest"]+"-[上半]');\" style='"+(dbs[i]["Match_Bgdy2"]!=data[i]["Match_Bgdy2"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f;":"")+"'>"+(dbs[i]["Match_Bgdy2"]!="0"?formatNumber(dbs[i]["Match_Bgdy2"],2):"")+"</a>":"")+"</a>"+(dbs[i]["Match_Bhdy2"] !=null?((dbs[i]["Match_Bhdy2"]-0.05)>0 ?"<a class=\"btn btn-lg btn-warning\" href=\"javascript:void(0)\"  title=\"和局\" onclick=\"setbet('足球上半场','上半场标准盘-和局','" + dbs[i]["Match_ID"] + "','Match_Bhdy','0','0','和局');\" style='"+(dbs[i]["Match_Bhdy2"]!=data[i]["Match_Bhdy2"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f;":"")+"'>"+(dbs[i]["Match_Bhdy2"]!="0"?formatNumber(dbs[i]["Match_Bhdy2"],2):"")+"</a>":""):"")+"</a></div></td>";
				htmls+="    <td><div class='rangqiu_odds'><span class='odds'>"+(dbs[i]["Match_BHo"] !=null?"<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Master"]+"\" onclick=\"setbet('足球上半场','上半场让球-"+(dbs[i]["Match_Hr_ShowType"] =="H"?"主让":"客让")+dbs[i]["Match_BRpk"]+"-"+dbs[i]["Match_Master"] + "','" + dbs[i]["Match_ID"] + "','Match_BHo','1','0','"+dbs[i]["Match_Master"]+"-[上半]'); \"style='"+(dbs[i]["Match_BHo"]!=data[i]["Match_BHo"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f;":"")+"'>"+(dbs[i]["Match_BHo"]!="0"?formatNumber(dbs[i]["Match_BHo"],2):"")+"</a>":"")+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">"+((dbs[i]["Match_Hr_ShowType"] =="H" && dbs[i]["Match_BHo"] !=0)?dbs[i]["Match_BRpk"]:"")+"</a></span><br><span class='odds'>"+(dbs[i]["Match_BAo"] !=null?"<a class=\"btn btn-lg btn-info\" href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Guest"]+"\" onclick=\"setbet('足球上半场','上半场让球-"+(dbs[i]["Match_Hr_ShowType"] =="H"?"主让":"客让")+dbs[i]["Match_BRpk"]+"-"+dbs[i]["Match_Guest"] + "','" + dbs[i]["Match_ID"] + "','Match_BAo','1','0','"+dbs[i]["Match_Guest"]+"-[上半]');\" style='"+(dbs[i]["Match_BAo"]!=data[i]["Match_BAo"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f;":"")+"'>"+(dbs[i]["Match_BAo"]!="0"?formatNumber(dbs[i]["Match_BAo"],2):"")+"</a>":"")+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">"+((dbs[i]["Match_Hr_ShowType"] =="C" && dbs[i]["Match_BAo"] !="0")?dbs[i]["Match_BRpk"]:"")+"</a></span><br>&nbsp;</div></td>";
				htmls+="    <td><div class='rangqiu_odds'><span class='odds'>"+(dbs[i]["Match_Bdpl"] !=null?"<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\"大\" onclick=\"setbet('足球上半场','上半场大小-"+dbs[i]["Match_Bdxpk1"]+"','" + dbs[i]["Match_ID"] + "','Match_Bdpl','1','0','"+dbs[i]["Match_Bdxpk1"].replace("@","")+"');\" style='"+(dbs[i]["Match_Bdpl"]!=data[i]["Match_Bdpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f;":"")+"'>"+(dbs[i]["Match_Bdpl"]!="0"?formatNumber(dbs[i]["Match_Bdpl"],2):"")+"</a>":"")+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">"+((dbs[i]["Match_Bdxpk1"]!="O")?dbs[i]["Match_Bdxpk1"].replace("@",""):"")+"</a></span><br><span class='odds'>"+(dbs[i]["Match_Bxpl"] !=null?"<a class=\"btn btn-lg btn-info\" href=\"javascript:void(0)\" title=\"小\" onclick=\"setbet('足球上半场','上半场大小-"+dbs[i]["Match_Bdxpk2"]+"','" + dbs[i]["Match_ID"] + "','Match_Bxpl','1','0','"+dbs[i]["Match_Bdxpk2"].replace("@","")+"');\" style='"+(dbs[i]["Match_Bxpl"]!=data[i]["Match_Bxpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f;":"")+"'>"+(dbs[i]["Match_Bxpl"]!="0"?formatNumber(dbs[i]["Match_Bxpl"],2):"")+"</a>":"")+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">"+((dbs[i]["Match_Bdxpk2"]!="U")?dbs[i]["Match_Bdxpk2"].replace("@",""):"")+"</a></span><br>&nbsp;</div></td>";
				htmls+=" </tr>"; 
			}
			}
			htmls+="</tbody></table>";
			if(htmls == '<table class="table table-bordered table-hover"><thead><tr class="success"><th data-toggle="true">赛程<br>点击每行展开</th><th>时间<br>主队 / 客队</th><th data-hide="phone,tablet">全场[1X2]</th><th data-hide="phone,tablet">全场[让球]</th><th data-hide="phone,tablet">全场[大小]</th><th data-hide="phone,tablet">上半场[1X2]</th><th data-hide="phone,tablet">上半场[让球]</th><th data-hide="phone,tablet">上半场[大小]</th></tr></thead><tbody></tbody></table>'){
				htmls = '<table class="table table-bordered table-hover"><thead><tr class="success"><th data-toggle="true">赛程<br>点击每行展开</th><th>时间<br>主队 / 客队</th><th data-hide="phone,tablet">全场[1X2]</th><th data-hide="phone,tablet">全场[让球]</th><th data-hide="phone,tablet">全场[大小]</th><th data-hide="phone,tablet">上半场[1X2]</th><th data-hide="phone,tablet">上半场[让球]</th><th data-hide="phone,tablet">上半场[大小]</th></tr></thead><tbody><tr><td height="100" colspan="8" align="center" bgcolor="#FFFFFF"><img src="/images/loading.gif" border="0" />暂无任何赛事</td></tr></tbody></table>';
			}
			$("#datashow").html(htmls);
			//$(".panel").width(dbwidth);
			$('.table').footable();
			$("#datashow a").each(function(i, e) {
                var t=$(this).html();
                if(t==''||t=='&nbsp;'){
                    $(this).remove();
                }
            });
		}
	})
}


$(document).ready(function(){
	$("#xzls").click(function(){ //选择联赛
		if(window_lsm.length > 2000){
			if(window.XMLHttpRequest){ //Mozilla, Safari, IE7 
				if(!window.ActiveXObject){ // Mozilla, Safari, 
					JqueryDialog.Open('足球单式', 'dialog.php?lsm='+window_lsm, 300, window_hight);
				}else{ //IE7
					JqueryDialog.Open('足球单式', 'dialog.php?lsm=zqds', 300, window_hight);
				}
			}else{ //IE6
				JqueryDialog.Open('足球单式', 'dialog.php?lsm=zqds', 300, window_hight);
			}
		}else{
			JqueryDialog.Open('足球单式', 'dialog.php?lsm='+window_lsm, 300, window_hight);
		}
	});
});