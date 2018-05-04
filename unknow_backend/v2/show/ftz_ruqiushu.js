// JavaScript Document
var dbs  = null;
var data = null;
var window_hight	=	0; //窗口高度
var window_lsm		=	0; //窗口联赛名
function loaded(league,thispage,p){
	var league = encodeURI(league);
	$.getJSON("/index.php/sport/FT_2_2.html?leaguename="+league+"&CurrPage="+thispage+"&callback=?",function(json){
		var pagecount	=	json.fy.p_page;
		var page		=	json.fy.page;
		var fenye		=	"";
		window_hight	=	json.dh;
		window_lsm		=	json.lsm;
		var dbwidth = $(parent.window).width()-10;
		
		if(dbs !=null) {
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
			$("#datashow").html('<table class="table table-bordered table-hover"><thead><tr class="success"><th data-toggle="true">赛程<br>点击每行展开</th><th>时间<br>主队 / 客队</th><th data-hide="phone,tablet">单</th><th data-hide="phone,tablet">双</th><th data-hide="phone,tablet">0 - 1</th><th data-hide="phone,tablet">2 - 3</th><th data-hide="phone,tablet">4 - 6</th><th data-hide="phone,tablet">7或以上</th></tr></thead><tbody><tr><td height="100" colspan="8" align="center" bgcolor="#FFFFFF" style="line-height:25px;">暂无任何赛事</td></tr></tbody></table>');
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
			
			var htmls='<table class="table table-bordered table-hover"><thead><tr class="success"><th data-toggle="true">赛程<br>点击每行展开</th><th>时间<br>主队 / 客队</th><th data-hide="phone,tablet">单</th><th data-hide="phone,tablet">双</th><th data-hide="phone,tablet">0 - 1</th><th data-hide="phone,tablet">2 - 3</th><th data-hide="phone,tablet">4 - 6</th><th data-hide="phone,tablet">7或以上</th></tr></thead><tbody>';
			var lsm = "";
			for(var i=0; i<dbs.length; i++){
				if(dbs[i]["Match_Bd10"] !="0" || dbs[i]["Match_Total01Pl"] !="0" || dbs[i]["Match_Total23Pl"] !="0" || dbs[i]["Match_Total46Pl"] !="0" || dbs[i]["Match_Total7upPl"] !="0"){
				lsm = dbs[i]["Match_Name"];
				htmls+="<tr>";
				htmls+="<td><a href=\"javascript:void(0)\" title='选择 >> "+lsm+"' onclick=\"javascript:check_one('"+lsm+"');\" >"+lsm+"</a></td>";
				htmls +="<td><span class=\"red\">"+dbs[i]["Match_Date"]+"</span><br><span class='zhu'>"+dbs[i]["Match_Master"]+"</span> <span class='ke'>"+dbs[i]["Match_Guest"]+"</span></td>";
				htmls +="<td>"+((dbs[i]["Match_DsDpl"]==null || dbs[i]["Match_DsDpl"]=="0") ? "" :("<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\"单\" onclick=\"javascript:setbet('足球早餐','单双-单','"+dbs[i]["Match_ID"]+"','Match_DsDpl','0','0','单');\" style='"+(dbs[i]["Match_DsDpl"]!=data[i]["Match_DsDpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>"+formatNumber(dbs[i]["Match_DsDpl"],2)+"</a>"))+"</td>";
				htmls +="  <td>"+((dbs[i]["Match_DsSpl"]==null || dbs[i]["Match_DsSpl"]=="0") ? "" :("<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\"双\" onclick=\"javascript:setbet('足球早餐','单双-双','"+dbs[i]["Match_ID"]+"','Match_DsSpl','0','0','双');\" style='"+(dbs[i]["Match_DsSpl"]!=data[i]["Match_DsSpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>"+formatNumber(dbs[i]["Match_DsSpl"],2)+"</a>"))+"</td>";
				htmls +="  <td>"+((dbs[i]["Match_Total01Pl"] !=null && dbs[i]["Match_Total01Pl"] !="0")?"<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\"0~1\" onclick=\"setbet('足球早餐','入球数-0~1','" + dbs[i]["Match_ID"] + "','Match_Total01Pl','0',0,'0~1');\" style='"+(dbs[i]["Match_Total01Pl"]!=data[i]["Match_Total01Pl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>"+formatNumber(dbs[i]["Match_Total01Pl"],2)+"</a>":"")+"</td>";
				htmls +="  <td>"+((dbs[i]["Match_Total23Pl"] !=null && dbs[i]["Match_Total23Pl"] !="0")?"<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\"2~3\" onclick=\"setbet('足球早餐','入球数-2~3','" + dbs[i]["Match_ID"] + "','Match_Total23Pl','0',0,'2~3');\" style='"+(dbs[i]["Match_Total23Pl"]!=data[i]["Match_Total23Pl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>"+formatNumber(dbs[i]["Match_Total23Pl"],2)+"</a>":"")+"</td>";
				htmls +="  <td>"+((dbs[i]["Match_Total46Pl"] !=null && dbs[i]["Match_Total46Pl"] !="0")?"<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\"4~6\" onclick=\"setbet('足球早餐','入球数-4~6','" + dbs[i]["Match_ID"] + "','Match_Total46Pl','0',0,'4~6');\" style='"+(dbs[i]["Match_Total46Pl"]!=data[i]["Match_Total46Pl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>"+formatNumber(dbs[i]["Match_Total46Pl"],2)+"</a>":"")+"</td>";
				htmls +="  <td>"+((dbs[i]["Match_Total7upPl"] !=null && dbs[i]["Match_Total7upPl"] !="0")?"<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\"7以上\" onclick=\"setbet('足球早餐','入球数-7UP','" + dbs[i]["Match_ID"] + "','Match_Total7upPl','0',0,'7UP');\" style='"+(dbs[i]["Match_Total7upPl"]!=data[i]["Match_Total7upPl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>"+formatNumber(dbs[i]["Match_Total7upPl"],2)+"</a>":"")+"</td>";
				htmls +="</tr>";
			}
			}
			htmls+="</tbody></table>";
			if(htmls == '<table class="table table-bordered table-hover"><thead><tr class="success"><th data-toggle="true">赛程<br>点击每行展开</th><th>时间<br>主队 / 客队</th><th data-hide="phone,tablet">单</th><th data-hide="phone,tablet">双</th><th data-hide="phone,tablet">0 - 1</th><th data-hide="phone,tablet">2 - 3</th><th data-hide="phone,tablet">4 - 6</th><th data-hide="phone,tablet">7或以上</th></tr></thead><tbody></tbody></table>'){
				htmls = '<table class="table table-bordered table-hover"><thead><tr class="success"><th data-toggle="true">赛程<br>点击每行展开</th><th>时间<br>主队 / 客队</th><th data-hide="phone,tablet">单</th><th data-hide="phone,tablet">双</th><th data-hide="phone,tablet">0 - 1</th><th data-hide="phone,tablet">2 - 3</th><th data-hide="phone,tablet">4 - 6</th><th data-hide="phone,tablet">7或以上</th></tr></thead><tr><td height="100" colspan="8" align="center" bgcolor="#FFFFFF" style="line-height:25px;">暂无任何赛事</td></tr></table>';
			}
			$("#datashow").html(htmls);
			//$(".panel").width(dbwidth);
			$('.table').footable();
		}
	})
}


$(document).ready(function(){
	$("#xzls").click(function(){ //选择联赛
		JqueryDialog.Open('足球早餐入球数', 'dialog.php?lsm='+window_lsm, 300, window_hight);
	});
});