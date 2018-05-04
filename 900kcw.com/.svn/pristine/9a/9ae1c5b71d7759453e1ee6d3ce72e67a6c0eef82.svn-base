
ESUNChart = {};
ESUNChart.previewCode = [];
ESUNChart.on = function (c, b, a) {
	c.attachEvent ? c.attachEvent("on" + b, function () {
		a.call(c);
	}) : c.addEventListener(b, a, false);
};
ESUNChart.ini = {default_has_line:true, default_spaceLine:true, default_yl_Line:true, map:[], initShow:"", stop_buy_re:/sina|tenpay|youa/, no_show_news:/paipai|youa/};
ESUNChart.CSS = function (d, b) {
	var a = d.style;
	if (a[b]) {
		return a[b];
	}
	if (d.currentStyle) {
		return d.currentStyle[b];
	}
	if (document.defaultView && document.defaultView.getComputedStyle) {
		b = b.replace(/([A-Z])/g, "-$1").toLowerCase();
		var c = document.defaultView.getComputedStyle(d, "");
		return c && c.getPropertyValue(b);
	}
	return null;
};
ESUNChart.stop = function (a) {
	if (a.stopPropagation) {
		a.stopPropagation();
		a.preventDefault();
	} else {
		a.cancelBubble = true;
		a.returnValue = false;
	}
};
ESUNChart.insertAfter = function (c, a) {
	var b = a.parentNode;
	if (b.lastChild == a) {
		return b.appendChild(c);
	} else {
		return b.insertBefore(c, a.nextSibling);
	}
};
SG = function (A, z, v, r, t, c) {
	this.cloner = false;
	this.ballKey = "chartBall";
	this.isBall = /chartBall|cbg|hot/i;
	this.ylKey = "yl";
	this.isHiddenYL = false;
	this.onlySplaceLine = false;
	this.defCSS = "q_lan";
	this.gYLCSS = "q_hong";
	this.gHCSS = "chartBall05";
	this.gH3CSS = "chartBall06";
	this.gVCSS = "chartBall03";
	this.gV3CSS = "chartBall04";
	this.gXCSS = "chartBall04";
	this.gX3CSS = "chartBall08";
	this.gXLCSS = "hot";
	this.gXL3CSS = "yhot";
	this.gXRCSS = "hot";
	this.gXR3CSS = "yhot";
	this.gTBCSS = "chartBall02";
	this.gDefaultShowCSS = "chartBall07";
	this.gpaceLineCSS = "ldh";
	this.gV = [];
	this.gV3 = [];
	this.gH = [];
	this.gH3 = [];
	this.gXL = [];
	this.gXL3 = [];
	this.gXR = [];
	this.gXR3 = [];
	this.gX = [];
	this.gX3 = [];
	this.gYL = [];
	this.gAll = [];
	this.gTB = [];
	this.gDefaultShow = [];
	this.gCustom = [];
	this.spaceLine = [];
	this.notEnd = [];
	this.hasBollLine = [];
	var o = document.getElementById(A).rows;
	var b = {x:z || 0, y:v || 0, w:r || 0, oh:t || 0};
	var g = b.y < 0 ? (o.length + b.y) : b.y;
	var p = o.length - b.oh;
	try {
		var f = b.x < 0 ? (o[g].cells.length + b.x) : b.x;
		var s = f + b.w;
		if (s > o[g].cells.length) {
			s = o[g].cells.length;
		}
		if (b.w <= 0) {
			s = o[g].cells.length + b.w;
		}
	}
	catch (B) {
		return;
	}
	this.check = c || function () {
	};
	for (var w = g; w < p; w++) {
		var a = o[w].cells;
		if (o[w].className == "tdbck") {
			this.spaceLine.push(o[w]);
		}
		for (var u = f; u < s; u++) {
			var d = a[u];
			if (d === undefined) {
				continue;
			}
			if (this.check(d, u, w) === false) {
				continue;
			}
			if (this.check(d, u, w) == "onlyNullLine") {
				this.onlySplaceLine = true;
			}
			if (null != d.getAttribute("tb")) {
				this.gTB.push(d);
			}
			if (this.onlySplaceLine) {
				var q = 0, l = u, h = w;
				while ((--l) >= f && a[l] && a[l].className.indexOf("yl") != -1) {
					q++;
				}
				l = u;
				while ((++l) < s && a[l] && a[l].className.indexOf("yl") != -1) {
					q++;
				}
				if (q == r - 1 && d.className.indexOf("yl") != -1) {
					this.notEnd.push(d);
					continue;
				} else {
					this.hasBollLine.push(d);
				}
			}
			if (!this.isBall.test(d.className)) {
				this.gYL.push(d);
				d._bgColor = ESUNChart.CSS(d, "backgroundColor");
				if (d._bgColor == "transparent") {
					d._bgColor = "#F3F2F2";
				}
				d._color = ESUNChart.CSS(d, "color");
				d.value = d.innerHTML;
				continue;
			}
			this.gAll.push(d);
			var l = u, h = w, k = 0, m = 0;
			while ((--h) >= g) {
				if (o[h].cells[l]) {
					if (this.isBall.test(o[h].cells[l].className)) {
						k++;
					} else {
						break;
					}
				} else {
					if (o[h].cells[0] && o[h].cells[0].parentNode.className == "tdbck") {
						continue;
					} else {
						break;
					}
				}
			}
			h = w;
			while ((++h) < p) {
				if (o[h].cells[l]) {
					if (this.isBall.test(o[h].cells[l].className)) {
						m++;
					} else {
						break;
					}
				} else {
					if (o[h].cells[0] && o[h].cells[0].parentNode.className == "tdbck") {
						continue;
					} else {
						break;
					}
				}
			}
			if (k + m > 1) {
				this.gV3.push(d);
			}
			if (k > 0) {
				this.gV.push(d);
			}
			l = u, h = w, k = 0, m = 0;
			while ((--l) >= f && this.isBall.test(o[h].cells[l].className)) {
				k++;
			}
			l = u;
			while ((++l) < s && this.isBall.test(o[h].cells[l].className)) {
				m++;
			}
			if (k + m > 1) {
				this.gH3.push(d);
			}
			if (k > 0) {
				this.gH.push(d);
			}
			l = u, h = w, k = 0, m = 0;
			while ((--h) >= g && (--l) >= f) {
				if (o[h].cells[l]) {
					if (this.isBall.test(o[h].cells[l].className)) {
						k++;
					} else {
						break;
					}
				} else {
					if (o[h].cells[0] && o[h].cells[0].parentNode.className == "tdbck") {
						l++;
						continue;
					} else {
						break;
					}
				}
			}
			l = u;
			h = w;
			while ((++h) < p && (++l) < s) {
				if (o[h].cells[l]) {
					if (this.isBall.test(o[h].cells[l].className)) {
						m++;
					} else {
						break;
					}
				} else {
					if (o[h].cells[0] && o[h].cells[0].parentNode.className == "tdbck") {
						l--;
						continue;
					} else {
						break;
					}
				}
			}
			if (k + m > 1) {
				this.gXL3.push(d);
			}
			if (k > 0) {
				this.gXL.push(d);
			}
			l = u, h = w, k = 0, m = 0;
			while ((--h) >= g && (++l) < s) {
				if (o[h].cells[l]) {
					if (this.isBall.test(o[h].cells[l].className)) {
						k++;
					} else {
						break;
					}
				} else {
					if (o[h].cells[0] && o[h].cells[0].parentNode.className == "tdbck") {
						l--;
						continue;
					} else {
						break;
					}
				}
			}
			l = u;
			h = w;
			while ((++h) < p && (--l) >= f) {
				if (o[h].cells[l]) {
					if (this.isBall.test(o[h].cells[l].className)) {
						m++;
					} else {
						break;
					}
				} else {
					if (o[h].cells[0] && o[h].cells[0].parentNode.className == "tdbck") {
						l++;
						continue;
					} else {
						break;
					}
				}
			}
			if (k + m > 1) {
				this.gXR3.push(d);
			}
			if (k > 0) {
				this.gXR.push(d);
			}
			this.gX = this.gXL.concat(this.gXR);
			this.gX3 = this.gXL3.concat(this.gXR3);
		}
	}
	this.gDefaultShow = this.gDefaultShow.concat(this.gV3, this.gH3, this.gX3);
};
SG.prototype = {show:function (type, yes) {
	if (!this[type]) {
		return;
	}
	var fLen = this[type].length;
	for (var i = 0; i < fLen; i++) {
		var _this = this[type][i];
		switch (type) {
		  case "gYL":
			if (!yes) {
				if (_this.className.indexOf(this.gTBCSS) == -1) {
					_this.style.color = _this._bgColor;
				}
			} else {
				if (_this.className.indexOf(this.gTBCSS) == -1) {
					_this.style.color = _this._color;
				}
			}
			this.isHiddenYL = yes;
			break;
		  case "gTB":
			if (yes) {
				_this.className += " " + this.gTBCSS;
				_this.innerHTML = _this.getAttribute("tb");
			} else {
				_this.className = _this.className.replace(eval("/" + this.gTBCSS + " | " + this.gTBCSS + "$/"), "");
				_this.innerHTML = !this.isHiddenYL ? _this.value : "<span style='visibility:hidden'>" + _this.value + "</span>";
			}
			break;
		  case "spaceLine":
			_this.style.display = yes ? "" : "none";
			break;
		  default:
			if (yes) {
				_this.className += " " + this[type + "CSS"];
			} else {
				_this.className = _this.className.replace(eval("/" + this[type + "CSS"] + " | " + this[type + "CSS"] + "$/"), "");
			}
		}
	}
}, 
addClick:function (b, a) {
	b.style.cursor = "pointer";
	if (typeof (a) == "function") {
		return (b.onclick = a);
	}
	b.onclick = function (c) {
		if (this.className.indexOf(a) + 1) {
			if (this.className == "") {
				this.innerHTML = "&nbsp;";
			}
			this.className = this.className.replace(new RegExp("(^|\\s)" + a + "(\\s|$)", "g"), " ");
		} else {
			if (this.innerHTML = "&nbsp;") {
				this.innerHTML = this.number;
			}
			this.className += " " + a;
		}
		ESUNChart.onPreviewAreaClick && ESUNChart.onPreviewAreaClick.call(this);
	};
}, 
set_on_off:function (a, f) {
	var e = a.split(",");
	var c = f.split(",");
	var d = this;
	for (var b = 0; b < e.length; b++) {
		(function (g) {
			document.getElementById(e[g]).onclick = function () {
				d.show(c[g], this.checked);
			};
		})(b);
	}
}};
oNullLine = {fg:[], defaultArray:"notEnd", table:false, color:"#D16630", bgColor:"#FDD2C6", selector:function () {
	return "onlyNullLine";
}, 
setSrc:function (a) {
	this.defaultArray = a;
	return this;
}, 
setColor:function (a, b) {
	if (a) {
		this.bgColor = a;
	}
	if (b) {
		this.color = b;
	}
	return this;
}, 
add:function (a, e, b, d) {
	var c = (new SG(this.table, a, e, b, d, this.selector))[this.defaultArray];
	c.bg = this.bgColor;
	c.color = this.color;
	this.fg.push(c);
	return this;
}, 
bind:function (b, a) {
	this.table = b;
	if (a !== true) {
		document.getElementById(a).onclick = oNullLine.show;
	}
	return this;
}, 
show:function (b) {
	var a = oNullLine.fg;
	for (var d = 0; d < a.length; d++) {
		var e = a[d];
		for (var c = 0; c < e.length; c++) {
			if (this.checked || b == true) {
				if (!/^cbg/i.test(e[c].className)) {
					e[c].style.backgroundColor = e.bg;
				}
				if (!/^chartBall/i.test(e[c].className)) {
					e[c].style.color = e.color;
				}
			} else {
				e[c].removeAttribute("style");
			}
		}
	}
}};
oDFZ = {vg:[], fg:[], table:false, add:function (a, d, b, c) {
	this.fg.push(new SG(this.table, a, d, b, c));
	return this;
}, 
about:function (a) {
	this.table = a;
	return this;
}, 
bind:function (b, h) {
	var g = b.split(",");
	var e = h.split(",");
	var f = this;
	for (var d = 0; d < g.length; d++) {
		var a = document.getElementById(g[d]);
		(function (j) {
			document.getElementById(g[j]).onclick = function () {
				for (var i = 0; i < f.fg.length; i++) {
					f.fg[i].show(e[j], this.checked);
				}
				oDFZ.onChange && oDFZ.onChange(e[j]);
			};
		})(d);
		if (ESUNChart.ini.initShow.indexOf(String(a.id)) != -1) {
			a.checked = true;
			for (var c = 0; c < f.fg.length; c++) {
				f.fg[c].show(e[d], true);
			}
		}
	}
	return this;
}, 
showDefault:function (d) {
	if (!ESUNChart.ini.default_spaceLine) {
		return;
	}
	var c = document.getElementById("help_line");
	if (!c) {
		return;
	}
	c.checked = "checked";
	if (!ESUNChart.ini.default_yl_Line) {
		return;
	}
	var a = document.getElementById("no_yl");
	if (!a) {
		return;
	}
	a.checked = "checked";
	for (var b = 0; b < this.fg.length; b++) {
		this.fg[b].show(d, true);
	}
}};
JoinLine = function (a, b) {
	this.color = a || "#000000";
	this.size = b || 1;
	this.lines = [];
	this.tmpDom = null;
	this.visible = true;
	var c = document.getElementById("container");
	this.box = document.body;
	if (c) {
		this.wrap = c.getElementsByTagName("DIV")[0];
		if (this.wrap) {
			this.box = this.wrap;
			this.wrap.style.position = "relative";
		}
	}
};
JoinLine.prototype = {
	show:function (b) {
		for (var a = 0; a < this.lines.length; a++) {
			this.lines[a].style.visibility = b ? "visible" : "hidden";
		}
	}, 
	remove:function () {
		for (var a = 0; a < this.lines.length; a++) {
			this.lines[a].parentNode.removeChild(this.lines[a]);
		}
		this.lines = [];
	}, 
	join:function (h, f, g) {
		this.remove();
		this.visible = f ? "visible" : "hidden";
		this.tmpDom = document.createDocumentFragment();
		for (var e = 0; e < h.length - 1; e++) {
			var d = this.pos(h[e]);
			var c = this.pos(h[e + 1]);
			if (g && g(d, c) === false) {
				continue;
			}
			if (document.all) {
				this.IELine(d.x, d.y, c.x, c.y);
			} else {
				this.FFLine(d.x, d.y, c.x, c.y);
			}
		}
		document.getElementById("chartLinediv").appendChild(this.tmpDom);
	}, 
	pos:function (c) {
		if (c.nodeType == undefined) {
			return c;
		}
		var d = {x:0, y:0}, b = c;
		for (; b; b = b.offsetParent) {
			d.x += b.offsetLeft;
			d.y += b.offsetTop;
			if (this.wrap && b.offsetParent === this.wrap) {
				break;
			}
		}
		var waitBox = document.getElementById("waitBox");
		if (document.getElementById("chartLinediv")) {
			d.x -= waitBox.offsetLeft;
			d.y -= waitBox.offsetTop;
		}
		d.x += parseInt(c.offsetWidth / 2);
		d.y += parseInt(c.offsetHeight / 2);
		return d;
	}, 
	_oldDot:function (a, e, c, d) {
		var b = document.createElement("DIV");
		b.style.cssText = "z-index:3;position: absolute; left: " + a + "px; top: " + e + "px;background: " + c + ";width:" + d + "px;height:" + d + "px;font-size:1px;overflow:hidden";
		b.style.visibility = this.visible;
		this.lines.push(this.tmpDom.appendChild(b));
	}, 
	_oldLine:function (c, g, b, f) {
		var a = Math.floor(Math.sqrt((b - c) * (b - c) + (f - g) * (f - g)));
		var d = Math.atan((b - c) / (f - g));
		if (((f - g) < 0 && (b - c) > 0) || ((f - g) < 0 && (b - c) < 0)) {
			d = Math.PI + d;
		}
		var j = Math.sin(d), h = Math.cos(d), e = 0;
		do {
			this.FFDot(c + e * j, g + e * h, this.color, this.size);
		} while (e++ < a);
	}, 
	FFLine:function (c, g, b, f) {
		if (Math.abs(g - f) < (JoinLine.indent * 2) && c == b) {
			return;
		}
		var h = this.nPos(c, g, b, f, JoinLine.indent);
		c = h[0];
		g = h[1];
		b = h[2];
		f = h[3];
		var d = document.createElement("canvas");
		d.style.position = "absolute";
		d.style.zIndex = "1";
		d.style.visibility = this.visible;
		d.width = Math.abs(c - b) || this.size;
		d.height = Math.abs(g - f) || this.size;
		var i = Math.min(g, f);
		var a = Math.min(c, b);
		d.style.top = i + "px";
		d.style.left = a + "px";
		var e = d.getContext("2d");
		e.save();
		e.strokeStyle = this.color;
	//	e.lineWidth = this.size;
		e.lineWidth = 1;
		e.beginPath();
		e.moveTo(c - a, g - i);
		e.lineTo(b - a, f - i);
		e.closePath();
		e.stroke();
		e.restore();
		this.lines.push(d);
		this.tmpDom.appendChild(d);
	}, 
	IELine:function (c, e, b, d) {
		if (Math.abs(e - d) < (JoinLine.indent * 2) && c == b) {
			return;
		}
		var f = this.nPos(c, e, b, d, JoinLine.indent);
		c = f[0];
		e = f[1];
		b = f[2];
		d = f[3];
		var a = document.createElement("<esun:line></esun:line>");
		a.from = c + "," + e;
		a.to = b + "," + d;
		a.strokeColor = this.color;
//		a.strokeWeight = this.size + "px";
		a.strokeWeight = "1.5px";
		a.style.cssText = "position:absolute;z-index:3;top:0;left:0;behavior: url(#default#VML);";
		a.style.visibility = this.visible;
		a.coordOrigin = "0,0";
		this.lines.push(a);
		this.tmpDom.appendChild(a);
	}, 
	nPos:function (g, o, f, m, e) {
		var p = g - f, n = o - m;
		var k = Math.round(Math.sqrt(Math.pow(p, 2) + Math.pow(n, 2)));
		var d, j, q, h;
		var l = Math.round((p * e) / k);
		var i = Math.round((n * e) / k);
		return [f + l, m + i, g - l, o - i];
	}
};

JoinLine.indent = 8;
LG = function (r, o, m, b, p, h) {
	var n = {x:o || 0, y:m || 0, w:b || 0, oh:p || 0};
	var g = document.getElementById(r).rows;
	var c = n.y < 0 ? (g.length + n.y) : n.y;
	var a = g.length - n.oh;
	var l = n.x < 0 ? (g[c].cells.length + n.x) : n.x;
	var q = l + n.w;
	if (q > g[c].cells.length) {
		q = g[c].cells.length;
	}
	if (n.w == 0) {
		q = g[c].cells.length;
	}
	this.g = [];
	for (var f = c; f < a; f++) {
		var k = g[f].cells;
		for (var e = l; e < q; e++) {
			var d = k[e];
			if (d) {
				if (h(d, e, f) === true) {
					this.g.push(d);
				}
			}
		}
	}
	if (LG.autoDraw) {
		this.draw();
	}
};

LG.color = "#009944";
LG.size = 2;
LG.autoDraw = true;
LG.isShow = true;
LG.filter = function () {
};
LG.prototype = {
	draw:function (a, b, c) {
		this.line = new JoinLine(a || LG.color, b || LG.size);
		if (!c) {
			c = LG.filter;
		}
		this.line.join(this.g, LG.isShow, c);
	}, 
	clear:function () {
		this.line.remove();
	}, 
	show:function (a) {
		this.line.show(a);
	}
};

oZXZ = {
	vg:[], lg:[], _vg:[], _lg:[], table:false, 
	check:function (a) {
		return /^(chartBall|cbg|hot)/i.test(a.className);
	}, 
	on_off:true, _on:true, novl:false, bind:function (b, a) {
		this.table = b;
		this.on_off = a;
		return this;
	}, 
	color:function (a) {
		LG.color = a;
		return this;
	}, 
	newCheck:function (a) {
		this.check = a;
		return this;
	}, 
	draw:function (d) {
		if (!this.table) {
			return;
		}
		if (d) {
			var c = this.vg.length;
			for (var a = 0; a < c; a++) {
				var b = this.vg[a];
				LG.color = b.color;
				JoinLine.indent = b.indent;
				this.novl = b.novl;
				if (this.novl) {
					LG.filter = function (g, f) {
						return !(g.x == f.x);
					};
				}
				this.lg.push(new LG(this.table, b[0], b[1], b[2], b[3], this.check));
			}
		}
		if (this.on_off) {
			var e = this;
			i = document.getElementById(this.on_off);
			if (i) {
				i.onclick = function () {
					var f = e._on ? this.checked : !this.checked;
					e.show(f);
				};
			}
		}
		this._vg = this._vg.concat(this.vg);
		this.vg = [];
		this._lg = this._lg.concat(this.lg);
		this.lg = [];
		return this;
	}, 
	show:function (c) {
		if (this._lg.length == 0) {
			this.redraw();
		}
		var b = this._lg.length;
		for (var a = 0; a < b; a++) {
			this._lg[a].show(c);
		}
	}, 
	add:function (a, d, b, c) {
		this.vg.push([a, d, b, c]);
		this.vg[this.vg.length - 1].color = LG.color;
		this.vg[this.vg.length - 1].indent = JoinLine.indent;
		this.vg[this.vg.length - 1].novl = this.novl;
		return this;
	}, 
	clear:function () {
		for (var a = 0; a < this._lg.length; a++) {
			this._lg[a].clear();
		}
		return this;
	}, 
	redraw:function () {
		this.clear();
		this.vg = this.vg.concat(this._vg);
		this._vg = [];
		this.draw(true);
	}, 
	newCheck:function (a) {
		this.check = a;
		return this;
	}, 
	setvl:function (a) {
		this.novl = a;
		return this;
	}, 
	indent:function (a) {
		JoinLine.indent = a;
		return this;
	}
};

oYL = {
	oSG:[], table:false, check:function (c, a, b) {
		if (c && c.className.indexOf("yl") != -1) {
			this.gYL.push(c);
			c._bgColor = ESUNChart.CSS(c, "backgroundColor");
			if (c._bgColor == "transparent") {
				c._bgColor = "#F3F2F2";
			}
			c._color = ESUNChart.CSS(c, "color");
			c.value = c.innerHTML;
		}
		return false;
	}, 
	on_off:false, bind:function (b, a) {
		this.table = b;
		this.on_off = a;
		return this;
	}, 
	newCheck:function (a) {
		this.check = a;
		return this;
	}, 
	add:function (a, d, b, c) {
		this.oSG.push(new SG(this.table, a, d, b, c, this.check));
		(function (e, f) {
			document.getElementById(e).onclick = function () {
				for (var g = 0; g < f.length; g++) {
					f[g].show("gYL", this.checked);
				}
			};
		})(this.on_off, this.oSG);
		return this;
	}
};

oPV = {
	oSG:false, table:false, offset:0, map:[], balls:[], css:"chartBall01", getCode:function (d) {
		var e = [];
		for (var c = 0; c < this.balls.length; ++c) {
			var g = this.balls[c], b = [];
			if (g) {
				for (var a = 0; a < g.length; ++a) {
					var f = g[a] && /ball/i.test(g[a].className);
					b.push(f ? g[a].number : "_");
				}
			}
			if (b.length) {
				e.push(b);
			}
		}
		return e;
	}, 
	clear:function () {
		for (var b = 0; b < this.balls.length; ++b) {
			var d = this.balls[b];
			if (d) {
				for (var a = 0; a < d.length; ++a) {
					var c = d[a];
					if (!c || c.number == 0) {
						continue;
					}
					c.innerHTML = "&nbsp;";
					c.className = c.className.replace(/( |^)chart\w+$/ig, "");
				}
			}
		}
	}, 
	check:function (e, a, d) {
		e.parentNode.onmousedown = function (f) {
			ESUNChart.stop(f || window.event);
		};
		e.number = a - oPV.offset;
		var b = e.number;
		if (oPV.wxCss) {
			oPV.css = oPV.wxCss[b];
		}
		if (ESUNChart.ini.map.length > 0) {
			e.number = ESUNChart.ini.map[e.number];
		}
		this.addClick(e, oPV.css);
		var c = e.parentNode.rowIndex;
		if (oPV.balls[c] == undefined) {
			oPV.balls[c] = [];
		}
		oPV.balls[c][e.cellIndex] = e;
		return false;
	}, 
	setMap:function (a) {
		ESUNChart.ini.map = a || [];
		return this;
	}, 
	bind:function (a) {
		this.table = a;
		return this;
	}, 
	add:function (a, e, b, d, c) {
		this.offset = c || 0;
		this.oSG = new SG(this.table, a, e, b, d, this.check);
		return this;
	}, 
	newCSS:function (a) {
		this.css = a;
		return this;
	}
};

BSort = function (e, b, a, d, c) {
	this.map = [];
	this.w = 0;
	this.h = 0;
	this.newSort = [];
	this.init(e, b, a, d, c);
};

BSort.prototype = {
	init:function (r, n, l, b, o) {
		var m = {x:n || 0, y:l || 0, w:b || 0, oh:o || 0};
		var g = document.getElementById(r).rows;
		var c = m.y < 0 ? (g.length + m.y) : m.y;
		var a = g.length - m.oh;
		var k = m.x < 0 ? (g[c].cells.length + m.x) : m.x;
		var q = k + m.w;
		if (q > g[c].cells.length - 1) {
			q = g[c].cells.length - 1;
		}
		if (m.w == 0) {
			q = g[c].cells.length;
		}
		var n = l = 0;
		for (var f = c; f < a; f++) {
			var h = g[f].cells;
			this.map[l] = [];
			n = 0;
			for (var e = k; e <= q; e++) {
				if (!h[e]) {
					continue;
				}
				this.map[l][n] = h[e];
				h[e].index = n++;
			}
			l++;
		}
		this.w = n;
		this.h = l;
		var s = [];
		for (var f = 0; f < this.w; f++) {
			s.push(this.map[this.h - 1][f]);
		}
		s.sort(function (j, i) {
			if (j.className.indexOf("chartBall") != -1) {
				return -1;
			}
			if (i.className.indexOf("chartBall") != -1) {
				return -1;
			}
			return parseInt(j.innerHTML) > parseInt(i.innerHTML) ? -1 : 1;
		});
		var p = [], d = [];
		for (var f = 0; f < s.length; f++) {
			if (s[f].className.indexOf("chartBall") == -1) {
				p.push(s[f]);
			} else {
				d.push(s[f]);
			}
		}
		p = p.concat(d);
		for (var f = 0; f < p.length; f++) {
			this.newSort.push(p[f].index);
		}
	}, sort:function (e) {
		var c = e ? this.newSort : [];
		for (var b = 0; b < this.h; b++) {
			this.map.lastCell = this.map[b][this.w - 1];
			for (var a = 0; a < this.w; a++) {
				var f = this.map[b][a];
				var d = c.length > 0 ? c[a] : a;
				this.map.lastCell = ESUNChart.insertAfter(this.map[b][d], this.map.lastCell);
			}
		}
	}
};
Cookie = {
	trim:function (a) {
		return a.replace(/^\s*|\s*$/g, "");
	}, 
	each:function (f) {
		var e = document.cookie;
		if (e == "" || !f) {
			return;
		}
		var d = e.split(";");
		for (var c = 0; c < d.length; ++c) {
			var b = d[c].split("="), g = f.call(this, this.trim(b[0]), decodeURIComponent(b[1]), c);
			if (g !== undefined) {
				return g;
			}
		}
	}, 
	add:function (a, e, d) {
		d = d || {};
		var f = this.trim(a) + "=" + encodeURIComponent(e);
		var b = (new Date()).getTime() + (d.day || 1) * (1000 * 60 * 60 * 24);
		if (d.day) {
			f += ";expires=" + new Date(b).toUTCString();
		}
		if (d.path) {
			f += ";path=" + d.path;
		}
		if (d.domain) {
			f += "; domain=" + d.domain;
		}
		if (d.secure) {
			f += ";secure";
		}
		document.cookie = f;
		return this;
	}, del:function (a) {
		this.each(function (b) {
			if (b == a || a === undefined) {
				this.add(b, 0, {day:-1});
			}
		});
	}
};
yl_Histogram = {
	list:[], 
	ini:{table:null, checkBox:null, expect:0, sort:0, left:1, right:0, beginLine:3, defaultShow:false}, 
	bind:function (b) {
		for (var a in b || {}) {
			this.ini[a] = b[a];
		}
		var c = document.getElementById(this.ini.checkBox);
		if (c) {
			this.ini.defaultShow = !!c.checked;
			c.onclick = function () {
				yl_Histogram.hide(!this.checked);
			};
		}
		this.show(this.ini);
	}, 
	show:function (c) {
		if (!c) {
			return this.hide(false);
		}
		if (!c.expect) {
			return;
		}
		this.Map = document.getElementById(c.table);
		var a = c.beginLine;
		for (var d = 0; d < this.Map.rows.length; d++) {
			try {
				var b = this.Map.rows[d].cells[0].innerHTML.replace(/(^\s+)|(\s+$)/g, "");
			}
			catch (f) {
				continue;
			}
			if (b == c.expect) {
				a = d;
				break;
			}
		}
		try {
			cells = this.Map.rows[a].cells;
		}
		catch (f) {
			return;
		}
		for (var d = c.left; d < cells.length - c.right; d++) {
			if (!/cbg|hot/i.test(cells[d].className)) {
				this.setColor(cells[d], c.sort || -1);
			}
		}
	}, 
	hide:function (b) {
		for (var a = 0; a < this.list.length; a++) {
			var c = this.list[a];
			c.className = b === false ? c.newClass : c.oldClass;
		}
	},
	getVCell:function (d, a, b) {
		try {
			var c = d.rows[a.parentNode.rowIndex + b].cells[a.cellIndex];
			if (undefined == c) {
				return this.getVCell(d, a, b * 2);
			}
			return d.rows[a.parentNode.rowIndex + b].cells[a.cellIndex];
		}
		catch (f) {
			return null;
		}
	},
	getClassName:function (a) {
		var b = parseInt(a.innerHTML.replace(/(<([^>]+)>)/gi, ""));
		if (b > 10) {
			return " cbg55";
		}
		if (b > 5) {
			return " cbg6";
		}
		return " cbg7";
	}, 
	setColor:function (a, b) {
		var d = this.getClassName(a), c = a;
		try {
			do {
				if (c.innerHTML != "") {
					c.oldClass = c.className;
					c.newClass = c.oldClass + d;
					if (this.ini.defaultShow) {
						c.className = c.newClass;
					}
				}
				this.list.push(c);
				c = this.getVCell(this.Map, c, b);
			} while (!/chartBall|cbg|hot/i.test(c.className) && (/yl|tdbck/.test(c.className)));
		}
		catch (f) {
		}
	}
};

SplitLine = {bind:function (a) {}};

var drawRect = function (f, b) {
	JoinLine.indent = 0;
	var c = window.ActiveXObject ? 2 : 4;
	var d = ESUNChart.hotBox || new JoinLine("#00A0FC", c);
	var e = d.pos(f);
	e.x = 0;
	e.y -= 80;
	p2 = {x:e.x + f.offsetWidth, y:e.y};
	p3 = {x:p2.x, y:p2.y + f.offsetHeight};
	p4 = {x:e.x, y:p3.y};
	d.join([e, p2, p3, p4, e], true);
	d.show(true);
	ESUNChart.hotBox = d;
	var a = document.getElementById("help_line");
	if (a) {
		ESUNChart.on(a, "click", function () {
			setTimeout(function () {
				var h = d.lines;
				var l = document.getElementById("selLine0");
				var n = 2, k = true, o = !!window.ActiveXObject;
				if (l) {
					if (l.style.display != "none") {
						k = false;
					}
					if (k) {
						l.style.display = o ? "block" : "table-cell";
					}
					var g = l;
					for (; g; g = g.offsetParent) {
						n += g.offsetTop;
					}
					if (k) {
						l.style.display = "none";
					}
				}
				var m = n - h[0].offsetTop + c;
				for (var j = 0; j < h.length; j++) {
					h[j].style.top = parseInt(h[j].style.top) + m + "px";
				}
			}, 100);
		});
	}
};
var drawRectCenter = function (f, b) {
	JoinLine.indent = 0;
	var c = window.ActiveXObject ? 2 : 4;
	var d = ESUNChart.hotBox || new JoinLine("#00A0FC", c);
	var e = d.pos(f);
	e.x = 0;
	e.y -= 80;
	p2 = {x:e.x + f.offsetWidth, y:e.y};
	p3 = {x:p2.x, y:p2.y + f.offsetHeight};
	p4 = {x:e.x, y:p3.y};
	d.join([e, p2, p3, p4, e], true);
	d.show(true);
	ESUNChart.hotBox = d;
	var a = document.getElementById("help_line");
	if (a) {
		ESUNChart.on(a, "click", function () {
			setTimeout(function () {
				var h = d.lines;
				var l = document.getElementById("selLine0");
				var n = 2, k = true, o = !!window.ActiveXObject;
				if (l) {
					if (l.style.display != "none") {
						k = false;
					}
					if (k) {
						l.style.display = o ? "block" : "table-cell";
					}
					var g = l;
					for (; g; g = g.offsetParent) {
						n += g.offsetTop;
					}
					if (k) {
						l.style.display = "none";
					}
				}
				var m = n - h[0].offsetTop + c;
				for (var j = 0; j < h.length; j++) {
					h[j].style.top = parseInt(h[j].style.top) + m + "px";
				}
			}, 100);
		});
	}
};
userLine = {stop:true, color:"red", 
init:function (checkBox, colorList) {
	this.draw = this["FF"];
	this.lines = [];
	var Canvas = document.body;
	if (colorList) {
		this.colorList = document.getElementById(colorList);
		this.colorList.onmousedown = function (e) {
			e = e || event;
			if (0) {
				this.setCapture();
				e.cancelBubble = true;
				e.returnValue = false;
			} else {
				e.preventDefault();
				e.stopPropagation();
			}
		};
	}
	/*
	Canvas.onmousedown = function () {
		if (userLine.stop) {
			return;
		}
		userLine.begin = true;
		this.style.cursor = "crosshair";
		var d = document.body, oX = d.scrollLeft, oY = Math.max(d.scrollTop, document.documentElement.scrollTop);
		userLine.x = event.clientX + oX;
		userLine.y = event.clientY + oY;
	};
	Canvas.onmouseup = function () {
		userLine.Line = userLine.begin = false;
		if (0) {
			this.onlosecapture = null;
			this.releaseCapture();
		} else {
			window.onblur = null;
		}
		this.style.cursor = "";
	};
	Canvas.onmousemove = function (e) {
		if (!userLine.begin) {
			return;
		}
		var d = document.body, oX = d.scrollLeft, oY = Math.max(d.scrollTop, document.documentElement.scrollTop);
		var x = event.clientX + oX;
		var y = event.clientY + oY;
		if (!userLine.Line) {
			userLine.draw(userLine.x, userLine.y, x, y);
		}
		e = e || event;
		userLine.Line.to = x + "px," + y + "px";
		if (false) {
			this.setCapture();
			e.cancelBubble = true;
			e.returnValue = false;
		} else {
			e.preventDefault();
			e.stopPropagation();
		}
		window.getSelection && window.getSelection().removeAllRanges();
	};
	Canvas.ondblclick = function () {
		event.ctrlKey ? userLine.clear() : userLine.back();
		userLine.stop = false;
	};  */
}, 
IE:function (x1, y1, x2, y2) {
	var D = document, Line = D.body.appendChild(D.createElement("<esun:line style=\"z-index:3;position:absolute;left:0;top:0\"><esun:Stroke dashstyle=\"shortdot\" endarrow=\"classic\" /></esun:line>"));
	with (this.Line = Line) {
		from = x1 + "," + y1;
		to = x2 + "," + y2;
		strokeColor = this.color;
		strokeWeight = 2;
	}
	this.lines.push(Line);
}, 
FF:function () {
}, 
clear:function () {
	for (var a = 0; a < this.lines.length; a++) {
		this.lines[a].parentNode.removeChild(this.lines[a]);
	}
}, 
back:function () {
	var a = this.lines.pop();
	if (a != undefined) {
		a.parentNode.removeChild(a);
	}
}};
if (window.attachEvent) {
	window.attachEvent("onload", function () {
		userLine.init();
	});
	document.attachEvent("onkeyup", function () {
		var a = event.keyCode;
		if (a < 49 || a > 56) {
			return;
		}
		userLine.color = ["#009944", "#009944", "#009944", "#009944", "#009944", "#009944", "#009944", "#009944"][a - 49];
	});
}
ESUNChart.init = function () {
	var c = document.getElementsByTagName("INPUT");
	for (var d = 0; d < c.length; d++) {
		var e = c[d];
		if (e.type.toLowerCase() == "checkbox") {
			e.checked = false;
		}
	}
	if (!ESUNChart.ini.default_has_line) {
		return;
	}
	var b = document.getElementById("has_line");
	if (!b) {
		return;
	}
	b.checked = "checked";
	if (!ESUNChart.ini.default_spaceLine) {
		return;
	}
	var f = document.getElementById("help_line");
	if (!f) {
		return;
	}
	f.checked = "checked";
	if (!ESUNChart.ini.default_yl_Line) {
		return;
	}
	var a = document.getElementById("no_yl");
	if (!a) {
		return;
	}
	a.checked = "checked";
};
if (typeof fw == "undefined") {
	fw = {};
}
fw.onReady = function (a) {
	ESUNChart.on(window, "load", a);
};
ESUNChart.on(window, "load", function () {
	var a = document.getElementById("foot_scroll_txt");
	if (!a) {
		return;
	}
	var b = function (f, c, j, g, i, d) {
		var h = function (k) {
			return document.getElementById(k);
		}, d = d || -1;
		var f = h(f), c = h(c), e = c.offsetHeight;
		f.appendChild(c.cloneNode(true));
		(function () {
			e = e || c.offsetHeight;
			var k = (f.scrollTop - 1) % j ? (i || 13) : g;
			var l = f.scrollTop;
			if (b.stop != true) {
				if (d == -1) {
					f.scrollTop = l == e + 1 ? 0 : ++l;
				} else {
					f.scrollTop = l == 0 ? e - 1 : --l;
				}
			}
			setTimeout(arguments.callee, k);
		})();
		return arguments.callee;
	};
	b("foot_scroll_txt", "foot_scroll_shell", 19, 3000, 10, -1);
	a.onmouseover = function () {
		b.stop = true;
	};
	a.onmouseout = function () {
		b.stop = false;
	};
});
function getHost(b) {
	b = b || location.href;
	var a = b.match(/^\w+:\/{2,}[^\/]+/);
	return a ? a[0] : "";
}
function setReferrer() {
	if (self == top) {
		return window.JumpSrc = location.href;
	}
	var d;
	if (location.href.indexOf("jumpsrc=") > -1 || document.referrer == "") {
		d = location.href.match(/jumpsrc=([^=&?]+)/)[1];
	} else {
		d = document.referrer;
	}
	var b = document.getElementsByTagName("A");
	for (var c = b.length; c--; ) {
		if (b[c].getAttribute("target")) {
			continue;
		}
		var a = b[c].href;
		if (!/script:|to:|jumpsrc/i.test(a)) {
			b[c].href += (a.indexOf("?") > -1 ? "&" : "?") + "jumpsrc=" + d;
		}
	}
	return window.JumpSrc = d;
}
function isStopBuySite() {
	setReferrer();
	if (ESUNChart.ini.stop_buy_re !== null) {
		return ESUNChart.ini.stop_buy_re.test(window.JumpSrc);
	}
	return false;
}
function setBuyHref(b) {
	if (b.length) {
		var a = b[0].href, c = a.match(/info\/(\w+)/)[1];
		b[0].href = JumpHost + "/pages/trade/" + c + "/";
	}
}
ESUNChart.on(window, "load", function () {
	var f = isStopBuySite();
	if (f) {
		return;
	}
	JumpHost = getHost(JumpSrc);
	buyHost = JumpHost;
	function e(g) {
		return document.getElementById(g);
	}
	el = e("selMaskBox");
	if (el) {
		el.style.display = "none";
	}
	var d = e("chartbottom").getElementsByTagName("span");
	for (var c = 0, a = d.length; c < a; c++) {
		var b = d[c];
		if (b.className.toLowerCase().indexOf("intro_right") > -1) {
			b.style.display = "block";
			setBuyHref(b.getElementsByTagName("A"));
		}
	}
	if (!ESUNChart.ini.no_show_news.test(JumpSrc)) {
		var d = e("chartbottom").getElementsByTagName("DIV");
		for (var c = 0, a = d.length; c < a; c++) {
			var b = d[c];
			if (b.className == "latest") {
				b.style.display = "block";
			}
		}
	}
	window.f_iframeResize && window.f_iframeResize();
});
function FloatTag(d, g) {
	var f = null;
	try {
		f = top;
		var m = top.document;
	}
	catch (l) {
		return {btn:{}};
	}
	if (isStopBuySite()) {
		return {btn:{}};
	}
	var o = top == window ? 0 : 172;
	var c = document.createElement("DIV");
	d = (d || 974) - 23 + "px";
	c.style.cssText = "z-index:3;position: absolute; width: 23px; height: 151px; top: 150px; left:" + d;
	c.innerHTML = "<img style=\"cursor: pointer\" border=0 src=\"/images/info/datachart/x1.gif\"><br><img style=\"cursor: pointer\" border=0 src=\"/images/info/datachart/x_d.gif\">";
	document.body.appendChild(c);
	g = g || 0;
	var p = function () {
		clearTimeout(document.onscrollTimer);
		clearInterval(c.moveTimer);
		document.onscrollTimer = setTimeout(a, 200);
	};
	ESUNChart.on(f, "scroll", p);
	p();
	var i = c.getElementsByTagName("IMG");
	this.btn = i[0];
	function k() {
		c.style.left = "-9999px";
	}
	i[1].onclick = function () {
		k();
	};
	this.hide = k;
	var j = f.document.body;
	var h = f.document.documentElement;
	var b = this;
	this.max = 0;
	function n() {
		var t = f.innerHeight || Math.max(h.clientHeight);
		var r = j.scrollTop || h.scrollTop;
		var q = document.getElementById("selLine0");
		if (q) {
			q.style.display = !!window.ActiveXObject ? "block" : "table-cell";
			var s = q, e = 0;
			for (; s; s = s.offsetParent) {
				e += s.offsetTop;
			}
			q.style.display = "none";
		}
		var u = t + r - o;
		if (e) {
			u = Math.min(e, u);
		}
		b.max = e;
		return {to:u, max:e};
	}
	function a() {
		if (c.offsetLeft <= 0) {
			return;
		}
		var r, q, e;
		r = c.offsetTop;
		q = n().to - c.offsetHeight - 1;
		e = Math[q - r > 0 ? "ceil" : "floor"];
		c.moveTimer = setInterval(function () {
			r += e((q - r) * 0.1);
			c.style.top = r + "px";
			if (r == q) {
				clearInterval(c.moveTimer);
			}
		}, 10);
	}
	this.bodyMove = function (s, r) {
		var u, t, q;
		var e = /CSS1Compat/i.test(f.document.compatMode) ? f.document.documentElement : document.body;
		u = e.scrollTop;
		s = s || 175;
		t = this.max - e.clientHeight + s + o;
		q = Math[t - u > 0 ? "ceil" : "floor"];
		e.moveTimer = setInterval(function () {
			u += q((t - u) * 0.4);
			e.scrollTop = u;
			if (u == t) {
				clearInterval(e.moveTimer);
			}
		}, 10);
	};
	window.clockFloatBtn = k;
}
ESUNChart.onPreviewAreaClick = function () {
};

