var _prefixURL={
    common:"/assets/statics/images/common",
    statics:"/assets/statics/images",
    plugins:"/assets/js/plugins"
};
var _gameObj={};
try{
    _gameObj=gameObj;
}catch(e){
    _gameObj.lotteryType="SSC";
}
requirejs.config({ //配置
    baseUrl: '/assets/js/application',
    paths: {
        jquery: '../plugins/jquery/jquery.min',   
        layer: '../plugins/layer/layer',
        jqueryui:'../plugins/jqueryui/jquery-ui',
        qrcode:'../plugins/qrcode/jquery.qrcode',
        qrutf:'../plugins/qrcode/utf',
        gameCM:'../plugins/game/gameCM',
        gameList:'../plugins/game/gameList',
        face:'../plugins/game/face'+_gameObj.lotteryType,
        game:'../plugins/game/game'+_gameObj.lotteryType,
        HKSIX:'../plugins/game/HKSIX',
        gameInfo:'../plugins/game/gameInfo'
    },
    urlArgs: "v=2.10",
    shim:{
        common:["jquery"],
        layer:{
            deps:["jquery",'css!../plugins/layer/need/layer.css'],
            exports:"layer"
        },
        qrcode:["jquery", "qrutf"],
        jqueryui:["jquery","css!../plugins/jqueryui/jquery-ui.css"],
        gameCM:["jquery","jqueryui","face"],
        gameInfo:["jquery"],
        game:["jquery","gameCM","jqueryui","face"],
        gameList:["jquery","face"],
        HKSIX:["jquery","jqueryui"],
    },
    map: {
        '*': {
            'css': '../require-css/css'
        }
    }
});
function add0(m){return m<10?'0'+m:m };  
function getLocalTime(shijianchuo) {  
  //shijianchuo是整数，否则要parseInt转换  
  var time = new Date(shijianchuo*1000);  
  var y = time.getFullYear();  
  var m = time.getMonth()+1;  
  var d = time.getDate();  
  var h = time.getHours();  
  var mm = time.getMinutes();  
  var s = time.getSeconds();  
  return y+'-'+add0(m)+'-'+add0(d)+' '+add0(h)+':'+add0(mm)+':'+add0(s);  
};   
