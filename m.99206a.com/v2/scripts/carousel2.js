(function(root){
	'use strict';

	var transition = root.Detector.cssSupport('transition');

	function slide(dom, position){
		var originLeft = dom.offsetLeft;
		var targetLeft = position.left;
		var direction = 1; // left
		if(targetLeft < originLeft){
			// left
			direction = 1;
		}else{
			// right
			direction = 0;
		}
		var duration = position.duration || 800;
		var unit = ((targetLeft - originLeft)/duration) * 40;
		originLeft += unit;
		dom.style.left = originLeft + 'px';
		var interval = setInterval(function(){
			originLeft += unit;
			if(direction){
				if(originLeft <= targetLeft){
					originLeft = targetLeft;
					clearInterval(interval);
				}
			}else{
				if(originLeft >= targetLeft){
					originLeft = targetLeft;
					clearInterval(interval);
				}
			}
			dom.style.left = originLeft + 'px';
		}, 1000/60);
	}

	var Carousel2 = function(option){
		var domC2 = option.elem;
		if(!domC2) {return;}

		var ul = domC2.getElementsByTagName('ul')[0];
		var ol = domC2.getElementsByTagName('ol')[0];
		var togglesWrapper = domC2.children[3];
		
		// get li number & width
		var liNumber = ul.children.length;
		var unitWidth = 300;  // --- 这里可能取不到宽度
	
		// set ul width
		var ulWidth = parseInt(liNumber * unitWidth);
		ul.style.width = ulWidth + 'px';
		
		// set toggles number
		var domC2Width = 300; // --- 这里也去不到宽度
		var groupNum = Math.ceil(ulWidth/domC2Width);
		var tmpl = '';
		for(var i = 0; i < groupNum; i++){
			tmpl += '<a href="###"></a>';
		}
		togglesWrapper.innerHTML = tmpl;
		var toggles = togglesWrapper.children;
		
		// calc the last left move
		this.lastLeftMove = this.calcLastLeftMove(ulWidth, domC2Width, groupNum);
		this.toggles = toggles;
		this.ul = ul;
		this.domC2Width = domC2Width;
		this.unitNumber = Math.ceil(domC2Width/unitWidth);
		this.showGroup(0);

		var leftBtn = ol.children[0];
		var rightBtn = ol.children[1];
		leftBtn.onclick = function(){
			self.showGroup(self.currentGroup - 1);
		};
		rightBtn.onclick = function(){
			self.showGroup(self.currentGroup + 1);
		};
		var self = this;
		for(var i2 = 0, l = toggles.length; i<l; i++){
			toggles[i2].onclick = (function(idx){
				return function(){
					self.showGroup(idx);
				};
			}(i2));
		}
	};
	Carousel2.prototype = {
		showGroup : function(idx){
			if(this.currentGroup === idx){
				return;
			}
			if(idx < 0){
				idx = this.toggles.length - 1;
			}
			if(idx >= this.toggles.length ){
				idx = 0;
			}

			// color toggle
			for(var i = 0, len = this.toggles.length; i < len; i++){
				if(i === idx){
					this.toggles[i].className = 'active';
				}else{
					this.toggles[i].className = '';
				}
			}

			var leftWill;
			// calc the moving longness
			if(idx === (this.toggles.length - 1)){
				leftWill = this.lastLeftMove;
			}else{
				leftWill = parseInt(this.domC2Width * idx);
			}

			// is it support the css3 transition attribute?
			if(transition){
				this.ul.style.left = '-' + leftWill + 'px';
			}else{
				slide(this.ul, {left : (0-leftWill), duration : 300});
			}

			this.currentGroup = idx;
			// this.lazyLoadImgsAt(idx);
		},
		calcLastLeftMove : function(ulWidth, ctnWidth, groupNumber){
			return ctnWidth * (groupNumber-1) - (ctnWidth * groupNumber - ulWidth);
		},
		lazyLoadImgsAt : function(groupNumber){
			var end = (groupNumber + 1) * this.unitNumber;
			if(end >= this.ul.children.length){
				end = this.ul.children.length;
			}
			var start = end - this.unitNumber;
			var imgs = this.ul.getElementsByTagName('img');
			for(var i = start; i<end; i++){
				var src = imgs[i].getAttribute('src');
				if(!src){
					imgs[i].src = imgs[i].getAttribute('data-src');
				}
			}
		},
		displayGroup : function(idx){
			if(this.currentGroup === idx){
				return;
			}
			if(idx < 0){
				idx = this.toggles.length - 1;
			}
			if(idx >= this.toggles.length ){
				idx = 0;
			}

			// color toggle
			for(var i = 0, len = this.toggles.length; i < len; i++){
				if(i === idx){
					this.toggles[i].className = 'active';
				}else{
					this.toggles[i].className = '';
				}
			}

			var leftWill;
			// calc the moving longness
			if(idx === (this.toggles.length - 1)){
				leftWill = this.lastLeftMove;
			}else{
				leftWill = parseInt(this.domC2Width * idx);
			}

			this.ul.style.left = '-' + leftWill + 'px';

			this.currentGroup = idx;
			// this.lazyLoadImgsAt(idx);
		}
	};
	
	var ctn = document.getElementById('J_p6carousel');
	if(!ctn) { return; }
	var carousel = new Carousel2({
		elem : ctn.children[0]
	});
	var p6Imgs = document.getElementById('J_p6Imgs').children;
	for(var i = 0,l = p6Imgs.length; i<l ; i++) {
		p6Imgs[i].onclick = (function(idx){
			return function(){
				var imgs = ctn.getElementsByTagName('img');
				for(var i = 0,l = imgs.length; i<l ; i++){
					if(!imgs[i].src){
						imgs[i].src = imgs[i].getAttribute('data-src');
					}
				}
				ctn.style.display = 'block';
				carousel.displayGroup(idx);
				document.body.style.overflow = 'hidden';
				$('.close').focus();
				return false;
			};
		}(i));
	}
}(this));