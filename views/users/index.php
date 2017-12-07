<?php

use yii\helpers\Url;
?>
<link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<!--引入分页插件-->
<script src="../../pagination/jquery-1.11.1.min.js"></script>
<script src="../../pagination/paging.js"></script>
<link rel="stylesheet" href="../../pagination/paging.css">
<input type="text" class="form-control" id="u_keyword" style="display: inline-block;width: 150px;" placeholder="根据用户名搜索">
<button type="button" class="btn btn-success" id="search">搜索</button>
<table class="table">
  <caption>用户信息展示</caption>
  <thead>
    <tr>
      <th>用户id</th>
		<th>用户名</th>
		<th>手机号</th>
		<th>性别</th>
		<th>邮箱</th>
		<th>添加时间</th>
		<th>身份证号</th>
		<th>头像</th>
		<th>操作</th>
    </tr>
  </thead>
  <tbody id="my-box">
    	<?php foreach ($paging['data'] as $u) :?>
		<tr data-uid="<?= $u['uid']?>">
			<th><?= $u['uid']?></th>
			<td><span class="mod" data-field='uname'><?= $u['uname']?></span></td>
			<td><span class="mod" data-field='number'><?= $u['number']?></span></td>
			<td><span class="mod" data-field='gender'><?= $u['gender']?></span></td>
			<td><span class="mod" data-field='email'><?= $u['email']?></span></td>
			<td><span class="mod" data-field='registrationtime'><?= $u['registrationtime']?></span></td>
			<td><span class="mod" data-field='idmumber'><?= $u['idmumber']?></span></td>
			<td><img src="<?= $u['headerimg']?>" alt="" width="150"></td>
			<th><input type="button" value="修改" class="btn btn-link"><button type="button" class="btn btn-default">删除</button></th>
		</tr>
	<?php endforeach?>
  </tbody>
</table>
<!--展示分页条-->
<div class="box" id="box"></div>
<script>
$(function(){
	//删除、修改 使用本方法，flag 1 删除，flag 2 修改
	//删除
	$(document).on('click','th button',function(){
		var uid = $(this).parents('tr').data('uid');
		$.post('',{"uid":uid,"flag":1,"_csrf":"<?= Yii::$app->request->csrfToken ?>"},function(e){
			if(e == 0)
			{
				alert('删除成功')
			}else{
				alert('删除失败')
			}
			location.reload();
		},'json')
	})

	$(document).on('click','.btn-link',function(){
		var uid = $(this).parents('tr').data('uid');
		location.href = "index.php?r=users/add&uid="+uid
	})

	$('#box').paging({
    initPageNo: 1, // 初始页码
    totalPages: '<?= $paging["total_p"]?>', //总页数
    totalCount: '合计<?= $paging["count"]?>条数据', // 条目总数
    slideSpeed: 600, // 缓动速度。单位毫秒 
    callback: function(page) { // 回调函数 
        console.log(page);
    }
})
	$(document).on('click','#pageSelect li',function(){
		var p = $(this).text()
		var u_keyword = $('#u_keyword').val()
		var mybox = $('#my-box');
		$.post('',{"p":p,"flag":"p","u_keyword":u_keyword,"_csrf":"<?= Yii::$app->request->csrfToken ?>"},function(e){
			paging(e,mybox)
		},'json')
	})

	$('#search').click(function(){
		var p = 1
		var u_keyword = $('#u_keyword').val();
		var mybox = $('#my-box');
		$.post('',{"p":p,"flag":"p","u_keyword":u_keyword,"_csrf":"<?= Yii::$app->request->csrfToken ?>"},function(e){
			paging(e,mybox)
		},'json')
	})

	function paging(e,mybox)
	{
			mybox.empty()
			$.each(e.data,function(i,v){
				mybox.append('<tr data-uid="'+this.uid+'">\
				<th>'+this.uid+'</th>\
				<td><span class="mod" data-field="uname">'+this.uname+'</span></td>\
				<td><span class="mod" data-field="number">'+this.number+'</span></td>\
				<td><span class="mod" data-field="gender">'+this.gender+'</span></td>\
				<td><span class="mod" data-field="email">'+this.email+'</span></td>\
				<td><span class="mod" data-field="registrationtime">'+this.registrationtime+'</span></td>\
				<td><span class="mod" data-field="idmumber">'+this.idmumber+'</span></td>\
				<td><img src="'+this.headerimg+'" alt="" width="150"></td>\
				<th><input type="button" value="修改" class="btn btn-link"><button type="button" class="btn btn-default">删除</button></th>\
		</tr>')
			})
	}
})
</script>