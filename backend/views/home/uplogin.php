<?php
$this->title="修改密码要谨慎";
?>

<table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
<form id="frm"  name="form" onsubmit="return checkall()" action="?r=home/update"  method="post" name="">
    <tr>
        <li width="30" align="center">管理员名称《:<input type="text"  name="username" value="<?=$data[0]['username']?>">》</li>
        <li width="30" align="center">新密码《:<input type="text" name="password" id="password" value="">》</li>
        <li width="30" align="center">重新输入密码《:<input type="text" name="pwd" id="pwd" value="">》</li>
        <input type="hidden" name="id" value="<?=$data[0]['id']?>">
    </tr>
    <tr>
       <li>
           <input type="submit" value="修改并重登" style="background-color: #0072C6">
       </li>
    </tr>
</form>
</table>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script>
    $(function(){
        var flag = true;
        function checkall(frm){
            $("#frm input[type='text']").each(function(i, obj) {
                if(obj.value == "") {
                    alert($(obj).attr("placeholder"));
                    flag = false;
                    return false;
                }
            });
            return flag;
        }
            $('#pwd').blur(function(){
                var password =  $('#password').val();
                var pwd=  $('#pwd').val();
                if(password!= pwd){
                        alert("密码有误！");
                        return false;
                }else if(pwd==""){
                    alert("不能为空！");
                    return false;
                }
            });
    });
</script>
