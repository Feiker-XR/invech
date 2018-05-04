requirejs(["jquery","layer","common","face"], function($,layer) {
    $(function() {
    	$("#orderBtn").on("click",function() {
	        var url = '/index/hall?gid='+$(this).data('gid')+'&pid='+$(this).data('pid')+'&content='+$(this).data('content');
	        location.href = url;
    	});
    	
		//撤单
		$("#cancelBtn").on("click",function(){
			var that=$(this);
			layer.open({
			    content: '是否确认要撤单？',
			    btn: ['确定', '取消'],
			    yes: function(index){
			      $.ajax({
			            url: 'member/bet/cancel',
			            type: 'POST',
			            dataType: 'json',
			            data: {
			                'id' : that.data('key'),
			                'gid': that.data('gid')
			            },
			            timeout: 30000,
			            success: function (results) {
			            	if(results.status=="100"){
			            		location.href="common/login";
			            		return;
			            	}
			                if(results.status=="200"){
			                	location.href = 'member/bet/cancelSuccess';
			               }
			            }
			        });
			      layer.close(index);
			    }
			});
		});
    });
});