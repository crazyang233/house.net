<?php
$this->title="个人信息管理";
?>

            <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
                <tr>
                    <li width="30" align="center">管理员名称:<?=$data[0]['username']?></li>
                    <li align="center">最近登录时间：<?=$time?></li>
                    <li align="center">操作<a href="?r=home/up-login&id=<?=$data[0]['id']?>">修改密码</a> </li>
                </tr>
            </table>


