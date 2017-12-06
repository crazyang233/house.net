<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin();?>
<?= $form->field($model,'uname')->textInput(['value'=> isset($userinfo['uname']) ? $userinfo['uname'] : ''])?>
<?= $form->field($model,'password')->passwordInput(['value'=>isset($userinfo['password']) ? $userinfo['password'] : ''])?>
<input type="radio" name="Users[gender]" value="0" checked="true">男
<input type="radio" name="Users[gender]" value="1">女
<?= $form->field($model,'email')->textInput(['value'=>isset($userinfo['email']) ? $userinfo['email'] : ''])?>
<?= $form->field($model,'number')->textInput(['value'=>isset($userinfo['number']) ? $userinfo['number'] : ''])?>
<?= $form->field($model,'idmumber')->textInput(['value'=>isset($userinfo['idmumber']) ? $userinfo['idmumber'] : ''])?>
<?php if(isset($userinfo)):?>
	<input type="hidden" name="uid" value="<?= $userinfo['uid']?>">
<?php endif?>
<?= $form->field($model,'headerimg')->fileInput()?>
<div class="form-group">
	<?= Html::submitButton(isset($userinfo)? '修改' : '添加',['class'=>'btn btn-primary'])?>
</div>
<?php ActiveForm::end()?>