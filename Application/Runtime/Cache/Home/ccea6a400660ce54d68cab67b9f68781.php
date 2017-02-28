<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
    <header>
        <style>
            body{text-align:center;}
            .loginBox{margin:0 auto;width:200px;height:200px}
        </style>
        <script type="text/javascript" src="/qrcodelogin/Public/JQuery.js"></script>
        <script type="text/javascript">

// 计数,方便测试(可以直观的查看当前调用的次数)
var count = 0;

// 请求服务器登录确认
function requestCheck(){
    $.post("login",{}, function(data){
           // 服务器返回非 "no" 字符串就算验证通过, 否则进入下一轮查询
           if (data != "no") {
               $("div.loginBox").html("登录成功");
           }else {
               $("div.count").html(count++);
               // 每次请求完成后, 延迟 2 秒, 再次进行查询
               setTimeout("requestCheck()", 2000);
           }
    });
}

// button 点击事件响应方法
function cl() {
    $("div.loginBox").html("<img src='qrcode'>");
    requestCheck();
    //lunxun();
}
        
        function lunxun(){
            var link = {            // JQuert的 ajax 执行的配置对象
                type:"POST",        // 设置请求方式为 POST
                async:true,         // 设置是否异步, 默认异步
                url:"login",
                dataType:"json",    // 设置期望的返回格式
                success:function(msg){
                    alert(msg);
                    if (msg != "no") {
                        $("div.loginBox").html("登录成功");
                    }else {
                        setTimeout("lunxun", 300);
                    }
                    
                }           // 成功时的毁掉函数, 处理返回数据, 并且延时建立新的请求链接
            };
            $.ajax(link);   // 执行 ajax 请求
            alert('aaa');
        }
        

        </script>
    </header>
    <body>
        <div class="count"></div>
        <div class="loginBox">
            <input value="Login" type="button" onclick="cl();" style="width:100px;height:50px" />
        </div>
        
    </body>
</html>