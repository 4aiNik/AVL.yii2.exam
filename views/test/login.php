<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<h1>Авторизация</h1>
<?php 
	$form = ActiveForm::begin();
?>

	<?= $form->field($model, 'login') ?>
	<?= $form->field($model, 'pass')->passwordInput() ?>


	<div class="form-group">
		<div class="col-lg-offset-1 col-lg-11">
			<?= Html::submitButton('Войти', [
				'class' => 'btn btn-primary', 
			]) ?>
		</div>
	</div>
	
<?php ActiveForm::end() ?>