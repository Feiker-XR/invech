var
// 获取元素
$ = function(element) {
 return (typeof(element) == 'object' ? element : document.getElementById(element));
},
// 判断浏览器
brower = function() {
 var ua = navigator.userAgent.toLowerCase();
 var os = new Object();
 os.isFirefox = ua.indexOf ('gecko') != -1;
 os.isOpera = ua.indexOf ('opera') != -1;
 os.isIE = !os.isOpera && ua.indexOf ('msie') != -1;
 os.isIE7 = os.isIE && ua.indexOf ('7.0') != -1;
 return os;
},
// 获取鼠标位置
getXY = function (e) {
 var XY;
 if(brower().isIE) {
  //XY = new Array(event.clientX, event.clientY);
  var scrollPos;
  if (typeof window.pageYOffset != 'undefined') {
     scrollPos = {x : window.pageXOffset, y : window.pageYOffset};
  }else if(typeof document.compatMode != 'undefined' && document.compatMode != 'BackCompat') {
     scrollPos = {x : document.documentElement.scrollLeft, y : document.documentElement.scrollTop};
  }else if(typeof document.body != 'undefined') {
     scrollPos = {x : document.body.scrollLeft, y : document.body.scrollTop};
  }
  XY = new Array(
   window.event.clientX + scrollPos.x - document.body.clientLeft,
   window.event.clientY + scrollPos.y - document.body.clientTop
  );
 }else{
  XY = new Array(e.pageX, e.pageY);
 }
 return XY;
},
// 获取元素坐标
getCoords = function(node){
 var x = node.offsetLeft;
 var y = node.offsetTop;
 var parent = node.offsetParent;
 while (parent != null){
  x += parent.offsetLeft;
  y += parent.offsetTop;
  parent = parent.offsetParent;
 }
 return {x: x, y: y};
},
EndEvent = function(e) {
 e = e || window.event;
 e.stopPropagation && (e.preventDefault(), e.stopPropagation()) || (e.cancelBubble = true, e.returnValue = false);
},
// 拖动元素
DragEle = function(obj, dObj, area, handler) {
 obj = $(obj);
 dObj = $(dObj);
 //obj.style.cursor = "move";
 
 obj.onmousedown = function(e) {
  var _tX, _tY, _sX, _sY, _mX, _mY
  var minX, minY, maxX, maxY;
  minX = area.minX==undefined ? 0 : area.minX;
  minY = area.minY==undefined ? 0 : area.minY;
  maxX = area.maxX==undefined ? _pageSize[0] : area.maxX;
  maxY = area.maxY==undefined ? _pageSize[1] : area.maxY;
  
  with(dObj) {
   // 记录当前位置
   style.position = 'absolute';
   _tX = offsetLeft;
   _tY = offsetTop;
   _sX = getXY(e)[0];
   _sY = getXY(e)[1];
  }
  if(dObj.setCapture) {
   dObj.setCapture();
  }else if(window.captureEvents) {
   window.captureEvents(Event.MOUSEMOVE|Event.MOUSEUP);
  }
  
  myAddEventListener(document, "selectstart", EndEvent);
  EndEvent(e);
  
  if(handler.down!=undefined) handler.down({x : _sX, y : _sY});
  
  document.onmousemove = function(e){
   // 设置滚动条位置
   _mX = _tX+getXY(e)[0]-_sX;
   _mY = _tY+getXY(e)[1]-_sY;
   _mX = _mX<minX ? minX : _mX;
   _mY = _mY<minY ? minY : _mY;
   _mX = _mX>maxX ? maxX : _mX;
   _mY = _mY>maxY ? maxY : _mY;
   with(dObj){
    style.left = _mX +'px';
    style.top = _mY +'px';
   }
   if(handler.move!=undefined) handler.move({x : _mX, y : _mY});
  };
  
  document.onmouseup = function() {
   if(dObj.releaseCapture) {
    dObj.releaseCapture();
   }else if(window.captureEvents) {
    window.captureEvents(Event.MOUSEMOVE|Event.MOUSEUP);
   }
   document.onmousemove = null;
   document.onmouseup = null;
   myRemoveEventListener(document, "selectstart", EndEvent);
   
   if(handler.up!=undefined) handler.up({x : _mX, y : _mY});
  }
 };
},
// 事件操作(可保留原有事件)
eventListeners = [],
findEventListener = function(node, event, handler){
 var i;
 for (i in eventListeners){
  if (eventListeners[i].node == node && eventListeners[i].event == event && eventListeners[i].handler == handler){
   return i;
  }
 }
 return null;
},
myAddEventListener = function(node, event, handler){
 if (findEventListener(node, event, handler) != null){
  return;
 }
 if (!node.addEventListener){
  node.attachEvent('on' + event, handler);
 }else{
  node.addEventListener(event, handler, false);
 }
 eventListeners.push({node: node, event: event, handler: handler});
},
removeEventListenerIndex = function(index){
 var eventListener = eventListeners[index];
 delete eventListeners[index];
 if (!eventListener.node.removeEventListener){
  eventListener.node.detachEvent('on' + eventListener.event,
  eventListener.handler);
 }else{
  eventListener.node.removeEventListener(eventListener.event,
  eventListener.handler, false);
 }
},
myRemoveEventListener = function(node, event, handler){
 var index = findEventListener(node, event, handler);
 if (index == null) return;
 removeEventListenerIndex(index);
},
cleanupEventListeners = function(){
 var i;
 for (i = eventListeners.length; i > 0; i--){
  if (eventListeners[i] != undefined){
   removeEventListenerIndex(i);
  }
 }
};



function simScroll(inits) {
 var _o = this;
 var _i = inits;
 if(typeof(_i) != "object" || _i._objFor==null || _i._objSimS==null){
//  alert("simScroll初始化失败。");
//  return;
 }
 _o.init = function() {
  // 初始化simScroll
  _o._objSimS  = _i._objSimS;   // 滚动条对象
  _o._objFor  = _i._objFor;   // 滚动对象
  _o._objSync  = _i. _objSync;   // 同步滚动对象
  _o._syncCount = typeof(_o._objSync)!="object" ? -1 : _o._objSync.length; // 同步滚动对象总数
  
  // 初始化的时候隐藏滚动条
  _o._objSimS.style.visibility = 'hidden';
  
  // 初始化控件
  var _objEle = _o._objSimS.getElementsByTagName("div");
  for(var i=0; i<_objEle.length; i++) {
   var _objTag = _objEle[i].getAttribute("tag");
   _objTag = _objTag.toLowerCase();
   if(_objTag=="simup")  _o._objUp = _objEle[i];
   if(_objTag=="simdown")  _o._objDown = _objEle[i];
   if(_objTag=="simarea")  _o._objArea = _objEle[i];
   if(_objTag=="simdrag")  _o._objDrag = _objEle[i];
  }
  
  // 初始化滚动条高度
  _o._sclTH = _o._objUp==null ? 0 : _o._objUp.offsetHeight;   // 头部高度(向上按钮)
  _o._sclFH = _o._objDown==null ? 0 : _o._objDown.offsetHeight;  // 底部高度(向上按钮)
  _o._sclSP = 0;             // 控件间隔
  _o._sclPH = _o._objFor.offsetHeight/_o._objFor.scrollHeight;  // 滚动对象滚动比例(Opera下 _objFor设置padding会导致计算不正确.待解决)
  _o._sclPH = _o._sclPH>1 ? 1 : _o._sclPH;
  _o._sclBH = _o._objFor.offsetHeight-_o._sclTH-_o._sclFH;   // 滚动区域高度
  _o._sclDH = parseInt((_o._sclBH-_o._sclSP*2)*_o._sclPH);   // 滚动条高度
  _o._sclDH = _o._sclDH<20 ? 20 : _o._sclDH;      // 滚动条最小高度20
  _o._moveSH = _o._objFor.scrollHeight-_o._objFor.offsetHeight;  // 滚动对象可滚动高度
  
  // 初始化参数
  _o._simToQD = 300; // 切换到快速滚动间隔
  _o._simQS = 50; // 快速滚动速度
  _o._simSLH = 20; // 滚动行距
  _o._simSH = 0; // 滚动距离
  
  // 初始化计时器
  _o._simDoT = null; // setTimeout
  _o._simDoI = null; // setInterval
  
  // 设置拖动范围
  _o._minX = 0;
  _o._minY = _o._sclTH+_o._sclSP;
  _o._maxY = _o._sclBH-_o._sclDH-_o._sclSP+_o._sclTH;
  _o._maxX = 0;
  
  // 设置滚动区域、滚动条高度
  with(_o._objArea) {
   style.height = _o._sclBH +"px";
  }
  with(_o._objDrag) {
   style.position = "absolute";
   style.top = _o._minY +"px";
   style.width = _o._objSimS.offsetWidth +"px";
   style.height = _o._sclDH +"px";
  }
  
  // 初始化事件
  // 向上
  if(_o._objUp!=null) {
   _o._objUp.onmouseover = function() {this.className = "simScrollUp_Over";}
   _o._objUp.onmouseout = function() {this.className = "simScrollUp"; _o.simStopScroll();}
   _o._objUp.onmousedown = function() {_o.simSetScroll(-1);}
   _o._objUp.onmouseup  = function() {_o.simStopScroll();}
  }
  // 向下
  if(_o._objDown!=null) {
   _o._objDown.onmouseover = function() {this.className = "simScrollDown_Over";}
   _o._objDown.onmouseout = function() {this.className = "simScrollDown"; _o.simStopScroll();}
   _o._objDown.onmousedown = function() {_o.simSetScroll(1);}
   _o._objDown.onmouseup = function() {_o.simStopScroll();}
  }
  // 滚动条
  _o._objDrag.onmouseover = function() {
   this.className = "simScrollDrag_Over";
   DragEle(
    _o._objDrag,
    _o._objDrag,
    {minX : _o._minX, minY : _o._minY, maxX : _o._maxX, maxY : _o._maxY},
    {down : _o.simStartDrag, move : _o.simDragScroll, up : _o.simEndDrag}
   );
  }
  _o._objDrag.onmouseout = function() {if(!_o._isDrag) this.className = "simScrollDrag";}
  // 滚动区域
  _o._objArea.onmousedown = function(e) {_o.simPageScroll(e);}
  _o._objArea.onmouseup = _o._objArea.onmouseout = function() {_o.simStopScroll();}
  // 滚动对象(用来同步绑定的对象)
  _o._objFor.onscroll = function() {_o.simPositioning();}
  if(_o._syncCount!=-1) myAddEventListener(_o._objFor, "scroll", _o.simSyncScroll);
  
  // 添加鼠标滚轮监听(除了IE.其他浏览器页面都会跟着跑...待完善)
  if (window.addEventListener) {
   _o._objFor.addEventListener('DOMMouseScroll', _o.simWheel, false);
   _o._objSimS.addEventListener('DOMMouseScroll', _o.simWheel, false);
  }
  myAddEventListener(_o._objFor, "mousewheel", _o.simWheel);
  myAddEventListener(_o._objSimS, "mousewheel", _o.simWheel);
  
  // 设置滚动条初始位置。解决刷新的时候会导致滚动条复位的问题。
  _o.simSetScroll(0);
  
  // 初始化完了.可以显示了.
  _o._objSimS.style.visibility = 'visible';
 };
 
 // 点击滚动区域翻页滚动
 _o.simPageScroll = function(e) {
  // 检测是否点击滚动条
  var E = e || event;
  var _chkObj = E.target || E.srcElement;
  if(_chkObj==_o._objDrag) return;
  // 获取鼠标位置与当前滚动条位置进行比较
  var _mouseY = getXY(e)[1];
  _mouseY = _mouseY-getCoords(_o._objSimS).y;
  var _objDragTop = parseInt(_o._objDrag.style.top);
  // 滚动...
  if(_objDragTop>_mouseY) {
   _o.simSetScroll(-3);
  }else{
   _o.simSetScroll(3);
  }
 }
 
 // 拖动滚动条滚动
 _o.simDragScroll = function(coords) {
  _o._movePY = (coords.y-_o._sclTH-_o._sclSP)/(_o._maxY-_o._sclTH-_o._sclSP);
  _o._moveY = _o._moveSH*_o._movePY;
  _o._moveY = parseInt(_o._moveY);
  _o._objFor.scrollTop = _o._moveY;
 }
 
 // 滚动对象滚动
 _o.simDoScroll = function() {
  _o._objFor.scrollTop += _o._simSH;
 }
 // 定位滚动条
 _o.simPositioning = function() {
  if(_o._isDrag) return;
  _o._movePY = _o._objFor.scrollTop/_o._moveSH;
  _o._moveY = (_o._maxY-_o._sclTH-_o._sclSP)*_o._movePY;
  _o._moveY = parseInt(_o._moveY);
  _o._moveY += _o._sclTH+_o._sclSP;
  _o._objDrag.style.top = _o._moveY +"px";
 };
 
 // 同步滚动
 _o.simSyncScroll = function() {
  var _top = _o._objFor.scrollTop;
  for(var i=0; i<_o._syncCount; i++) {
   _o._objSync[i].scrollTop = _top;
  }
 }
 
 // 开始拖动滚动条
 _o.simStartDrag = function() {
  _o._isDrag = true;
 }
 // 结束拖动滚动条
 _o.simEndDrag = function() {
  _o._isDrag = false;
  _o._objDrag.className = "simScrollDrag";
 }
 
 // 切换快速滚动
 _o.simDefer = function() {
  clearInterval(_o._simDoI);
  _o._simDoI = setInterval(function() {_o.simDoScroll();}, _o._simQS);
 };
 
 // 停止滚动
 _o.simStopScroll = function() {
  clearTimeout(_o._simDoT);
  clearInterval(_o._simDoI);
 };
 
 // 设置滚动对象滚动模式
 _o.simSetScroll = function(_m) {
  var _doDefer = false;
  switch(_m) {
   case -3 : // 向上翻页
    _o._simSH = -(_o._objFor.offsetHeight-_o._simSLH);
    _doDefer = true;
    break;
   case -2 : // 向上滚轮
    _o._simSH = -_o._simSLH*3;
    break;
   case -1 : // 向上按钮
    _o._simSH = -_o._simSLH*3;
    _doDefer = true;
    break;
   case 0 : // 设置滚动条位置
    _o._simSH = 0;
    _o.simPositioning();
    return;
    break;
   case 1 : // 向下按钮
    _o._simSH = _o._simSLH*3;
    _doDefer = true;
    break;
   case 2 : // 向下滚轮
    _o._simSH = _o._simSLH*3;
    break;
   case 3 : // 向下翻页
    _o._simSH = _o._objFor.offsetHeight-_o._simSLH;
    _doDefer = true;
    break;
  }
  
  _o.simDoScroll();
  if(_doDefer) {
   clearTimeout(_o._simDoT);
   _o._simDoT = setTimeout(_o.simDefer, _o._simToQD);
  }
 };
 
 // 鼠标滚轮
 _o.simWheel = function(e){
  var delta = 0;
  e = window.event || e;
  if (e.wheelDelta) { // IE或者Opera.
   delta = e.wheelDelta/120;
   // 在Opera9中，事件处理不同于IE
   // 貌似以前是相反的.可我下最新版又没有了...
   //if (window.opera) delta = -delta;
  } else if (e.detail) { //  兼容Mozilla.
   delta = -e.detail/3;
  }
  
  if(delta>0) {
   _o.simSetScroll(-2);
  }else{
   _o.simSetScroll(2);
  }
  
  EndEvent(e);
 };
}


window.onload = function() {
 var simScrollTest = new simScroll({
  _objFor  : $("simTestContent"),
  _objSimS : $("simScrollTest")
 });
 simScrollTest.init();
 
 // 没有上下按钮，直接把[_objSimS]HTML里tag为"simUp"跟"simDown"删除即可
 var simScrollTest2 = new simScroll({
  _objFor  : $("simTestContent2"),
  _objSimS : $("simScrollTest2")
 });
 simScrollTest2.init();
 
 // 绑定同步滚动
 var simScrollTest3 = new simScroll({
  _objFor  : $("simTestContent3"),
  _objSimS : $("simScrollTest3"),
  _objSync : new Array($("simTestContent4"))
 });
 simScrollTest3.init();
 var simScrollTest4 = new simScroll({
  _objFor : $("simTestContent4"),
  _objSimS  : $("simScrollTest4"),
  _objSync : new Array($("simTestContent3"))
 });
 simScrollTest4.init();
}