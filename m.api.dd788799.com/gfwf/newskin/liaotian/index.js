$(function(){
    $.post("check",{
        aaa:'yes'
    },function(a,b){
     if(a=="nocookie"){
        $("#bg").show();
        $("#window").show();
     }
    });
    
    $("#reset").click(function(){
        $("#bg").show();
        $("#window").show();
    });
    
    $("#setting").click(function(){
        var nc = $("#nc").val();
        $("#nicheng").val(nc);
        $.post("nicheng",{
            nc:nc
        },function(a,b){
        $("#bg").hide();
        $("#window").hide();
        });
        
    });
    
    
    setInterval(function(){
        
    $.get("php",function(a,b){
    $("#chat .window").html(a);
    });
    },1000);
    
    
    
    $("#send").click(function(){
        var content = $("#content").val();
        var nicheng = $("#nicheng").val();
        $(this).val("正在发送...");
        $(this).attr("disabled","True");
        $(this).css("backgroundColor","#747474");
        $.post("send",{
        content:content,
        nicheng:nicheng
        },function(a,b){
        if(a == "ok"){
            $("#content").val(null)
            return false;
        }else{
            alert('发送失败!');
            return false;
        }  
        });
        
  
               var count = 5;
                var countdown = setInterval(CountDown, 1000);//每1秒执行一次
                function CountDown() {
                    $("#send").val("发送成功,等待" + count + "秒后可继续发送！");
                    if (count == 0) {
                        $("#send").attr("disabled",false);
                        $("#send").val("发送");
                        $("#send").css("backgroundColor","#FB5200");
                        clearInterval(countdown);//clearInterval() 方法可取消由 setInterval() 设置的 timeout。
                    }
                    count--;
                    }
  
  
        
    });  
  

   
    
    

});