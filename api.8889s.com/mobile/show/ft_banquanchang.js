// JavaScript Document
var dbs  = null;
var data = null;
var window_hight	=	0; //窗口高度
var window_lsm		=	0; //窗口联赛名
function loaded(league,thispage,p){
	var league = encodeURI(league);
	$.getJSON("/index.php/sport/FT_1_3.html?leaguename="+league+"&CurrPage="+thispage+"&callback=?",function(json){
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
			$("#datashow").html('<table class="table table-bordered table-hover"><thead><tr class="success"><th data-toggle="true">赛程<br>点击每行展开</th><th>时间<br>主队 / 客队</th><th data-hide="phone,tablet">主/主</th><th data-hide="phone,tablet">主/和</th><th data-hide="phone,tablet">主/客</th><th data-hide="phone,tablet">和/主</th><th data-hide="phone,tablet">和/和</th><th data-hide="phone,tablet">和/客</th><th data-hide="phone,tablet">客/主</th><th data-hide="phone,tablet">客/和</th><th data-hide="phone,tablet">客/客</th></tr></thead><tbody><tr><td height="100" colspan="11" align="center" bgcolor="#dfdfdf" style="line-height:25px;">暂无任何赛事</td></tr></tbody></table>');
			$("#top").html('');
		}else {
			for(var i=0; i<pagecount; i++){
				if(i != page){
					fenye+="<li><a href='javascript:NumPage(" + i + ");' id=\"page_this\">" + (i+1) + "</a></li>";
				}else{
					fenye+="<li class='active'><a href='javascript:NumPage(" + i + ");' id=\"page_this\">" + (i+1) + "</a></li>";
				}
			}
			$("#top").html(fenye);
			
			var htmls='<table class="table table-bordered table-hover"><thead><tr data-toggle="true"><th data-toggle="true">赛程<br>点击每行展开</th><th>时间<br>主队 / 客队</th><th data-hide="phone,tablet">主/主</th><th data-hide="phone,tablet">主/和</th><th data-hide="phone,tablet">主/客</th><th data-hide="phone,tablet">和/主</th><th data-hide="phone,tablet">和/和</th><th data-hide="phone,tablet">和/客</th><th data-hide="phone,tablet">客/主</th><th data-hide="phone,tablet">客/和</th><th data-hide="phone,tablet">客/客</th></tr></thead><tbody>';
			var lsm = "";
			for(var i=0; i<dbs.length; i++){
				if(dbs[i]["Match_BqMM"]!="0" || dbs[i]["Match_BqMH"]!="0" || dbs[i]["Match_BqMG"]!="0" || dbs[i]["Match_BqHM"]!="0" || dbs[i]["Match_BqHH"]!="0" || dbs[i]["Match_BqHG"]!="0" || dbs[i]["Match_BqGM"]!="0" || dbs[i]["Match_BqGH"]!="0" || dbs[i]["Match_BqGG"]!="0"){
				lsm=dbs[i]["Match_Name"];
				htmls+="<tr>";
				htmls+="<td><a href=\"javascript:void(0)\" title='选择 >> "+lsm+"' onclick=\"javascript:check_one('"+lsm+"');\" >"+lsm+"</a></td>";
				htmls +="<td><span class=\"red\">"+dbs[i]["Match_Date"]+"</span><br><span class='zhu'>"+dbs[i]["Match_Master"]+"</span>-<span class='ke'>"+dbs[i]["Match_Guest"]+"</span></td>";
				htmls +="<td>"+(dbs[i]["Match_BqMM"] !=null?"<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\"主/主\" onclick=\"setbet('足球单式','半全场-主/主','" + dbs[i]["Match_ID"] + "','Match_BqMM','0','0','主/主');\" style='"+(dbs[i]["Match_BqMM"]!=data[i]["Match_BqMM"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>"+(dbs[i]["Match_BqMM"]!="0"?dbs[i]["Match_BqMM"]:"")+"</a>":"")+"</td>";
				htmls +="  <td>"+(dbs[i]["Match_BqMH"] !=null?"<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\"主/和\" onclick=\"setbet('足球单式','半全场-主/和','" + dbs[i]["Match_ID"] + "','Match_BqMH','0','0','主/和');\" style='"+(dbs[i]["Match_BqMH"]!=data[i]["Match_BqMH"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>"+(dbs[i]["Match_BqMH"]!="0"?dbs[i]["Match_BqMH"]:"")+"</a>":"")+"</td>";
				htmls +="  <td>"+(dbs[i]["Match_BqMG"] !=null?"<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\"主/客\" onclick=\"setbet('足球单式','半全场-主/客','" + dbs[i]["Match_ID"] + "','Match_BqMG','0','0','主/客');\" style='"+(dbs[i]["Match_BqMG"]!=data[i]["Match_BqMG"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>"+(dbs[i]["Match_BqMG"]!="0"?dbs[i]["Match_BqMG"]:"")+"</a>":"")+"</td>";
				htmls +="  <td>"+(dbs[i]["Match_BqHM"] !=null?"<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\"和/主\" onclick=\"setbet('足球单式','半全场-和/主','" + dbs[i]["Match_ID"] + "','Match_BqHM','0','0','和/主');\" style='"+(dbs[i]["Match_BqHM"]!=data[i]["Match_BqHM"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>"+(dbs[i]["Match_BqHM"]!="0"?dbs[i]["Match_BqHM"]:"")+"</a>":"")+"</td>";
				htmls +="  <td>"+(dbs[i]["Match_BqHH"] !=null?"<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\"和/和\" onclick=\"setbet('足球单式','半全场-和/和','" + dbs[i]["Match_ID"] + "','Match_BqHH','0','0','和/和');\" style='"+(dbs[i]["Match_BqHH"]!=data[i]["Match_BqHH"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>"+(dbs[i]["Match_BqHH"]!="0"?dbs[i]["Match_BqHH"]:"")+"</a>":"")+"</td>";
				htmls +="  <td>"+(dbs[i]["Match_BqHG"] !=null?"<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\"和/客\" onclick=\"setbet('足球单式','半全场-和/客','" + dbs[i]["Match_ID"] + "','Match_BqHG','0','0','和/客');\" style='"+(dbs[i]["Match_BqHG"]!=data[i]["Match_BqHG"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>"+(dbs[i]["Match_BqHG"]!="0"?dbs[i]["Match_BqHG"]:"")+"</a>":"")+"</td>";
				htmls +="  <td>"+(dbs[i]["Match_BqGM"] !=null?"<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\"客/主\" onclick=\"setbet('足球单式','半全场-客/主','" + dbs[i]["Match_ID"] + "','Match_BqGM','0','0','客/主');\" style='"+(dbs[i]["Match_BqGM"]!=data[i]["Match_BqGM"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>"+(dbs[i]["Match_BqGM"]!="0"?dbs[i]["Match_BqGM"]:"")+"</a>":"")+"</td>";
				htmls +="  <td>"+(dbs[i]["Match_BqGH"] !=null?"<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\"客/和\" onclick=\"setbet('足球单式','半全场-客/和','" + dbs[i]["Match_ID"] + "','Match_BqGH','0','0','客/和');\" style='"+(dbs[i]["Match_BqGH"]!=data[i]["Match_BqGH"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>"+(dbs[i]["Match_BqGH"]!="0"?dbs[i]["Match_BqGH"]:"")+"</a>":"")+"</td>";
				htmls +="  <td>"+(dbs[i]["Match_BqGG"] !=null?"<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\"客/客\" onclick=\"setbet('足球单式','半全场-客/客','" + dbs[i]["Match_ID"] + "','Match_BqGG','0','0','客/客');\" style='"+(dbs[i]["Match_BqGG"]!=data[i]["Match_BqGG"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>"+(dbs[i]["Match_BqGG"]!="0"?dbs[i]["Match_BqGG"]:"")+"</a>":"")+"</td>";
				htmls +="</tr>";
			}
			}
			htmls+="</tbody></table>";
			if(htmls == '<table class="table table-bordered table-hover"><thead><tr class="success"><th data-toggle="true">赛程<br>点击每行展开</th><th>时间<br>主队 / 客队</th><th data-hide="phone,tablet">主/主</th><th data-hide="phone,tablet">主/和</th><th data-hide="phone,tablet">主/客</th><th data-hide="phone,tablet">和/主</th><th data-hide="phone,tablet">和/和</th><th data-hide="phone,tablet">和/客</th><th data-hide="phone,tablet">客/主</th><th data-hide="phone,tablet">客/和</th><th data-hide="phone,tablet">客/客</th></tr></thead><tbody></tbody></table>'){
				htmls = '<table class="table table-bordered table-hover"><thead><tr class="success"><th data-toggle="true">赛程<br>点击每行展开</th><th>时间<br>主队 / 客队</th><th data-hide="phone,tablet">主/主</th><th data-hide="phone,tablet">主/和</th><th data-hide="phone,tablet">主/客</th><th data-hide="phone,tablet">和/主</th><th data-hide="phone,tablet">和/和</th><th data-hide="phone,tablet">和/客</th><th data-hide="phone,tablet">客/主</th><th data-hide="phone,tablet">客/和</th><th data-hide="phone,tablet">客/客</th></tr></thead><tbody><tr><td height="100" colspan="11" align="center" bgcolor="#dfdfdf" style="line-height:25px;">暂无任何赛事</td></tr></tbody></table>';
			}
			$("#datashow").html(htmls);
			//$(".panel").width(dbwidth);
			$('.table').footable();
		}
	});
}

$(document).ready(function(){
	$("#xzls").click(function(){ //选择联赛
		JqueryDialog.Open('足球半全场', 'dialog.php?lsm='+window_lsm, 300, window_hight);
	});
});