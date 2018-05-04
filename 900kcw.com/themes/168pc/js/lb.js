		var bannerImg = $(".banner_img");
			var subI = $(".sub_i")
			bannerImg.eq(0).addClass("bannerRun");
			subI.eq(0).addClass("sub_change");
			var sum = 0
			function run (){
				sum++;
				if(sum>2){
					sum=0;
				}
				bannerImg.removeClass("bannerRun")
				bannerImg.eq(sum).addClass("bannerRun")
				subI.removeClass("sub_change")
				subI.eq(sum).addClass("sub_change")
			};
			var timer = setInterval(run,3000);
			
			subI.click(function(){
				var index = $(this).index();
				console.log("点击索引",index);
				bannerImg.removeClass("bannerRun");
				bannerImg.eq(index).addClass("bannerRun");
				subI.removeClass("sub_change");
				subI.eq(index).addClass("sub_change");
				sum = index;
		 		window.clearTimeout(timer);
		 		setTimeout(function(){
					timer = setInterval(run,3000);
		 		},1000); 
			})			
