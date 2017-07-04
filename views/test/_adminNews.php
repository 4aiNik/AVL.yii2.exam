<? 
	use yii\helpers\Html;
	use yii\helpers\HtmlPurifier;
	use yii\helpers\Url;
	use yii\bootstrap\Modal;
	use yii\bootstrap\ActiveForm;
?>


<div class="row">
	<div style="float:left;" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
		<? 
			echo '<h4>' . yii\helpers\Html::tag('div', $model->name) . '</h4>';
		?>
	</div>
	

	<div style="float:left;" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
		<? 
			if($model->img){
				echo Yii::$app->formatter->asImage('@web/img/news/' . $model->img, ['width' => '100', 'align' => 'left', 'hspace' => '10']);
			}else{
				echo Yii::$app->formatter->asImage('@web/img/news/default', ['width' => '100']);
			}
		?>
	</div>

	<div style="float:left;" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<? 
			if($model->text){
				echo Yii::$app->formatter->asText($model->text);
			}
		?>
	</div>

	<div style="float:left;" class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
		<? 
			if($model->id){
				Modal::begin([
					'header' => '<h2>Редактировать</h2>',
					'toggleButton' => ['label' => 'ред', 'class' => 'btn btn-default'],
				]);

				$form = ActiveForm::begin([
					'id' => 'edit_form',
					'method' => 'post',
					'action' => '/yiiproj/web/test/edit',
					]);
				echo $form->field($model, 'id')->hiddenInput(['value' => $model->id, 'name' => 'id'])->label(false);
				echo $form->field($model, 'name')->textInput(['name' => 'name'])->label('Заголовок');
				echo $form->field($model, 'text')->textarea(['rows' => 5, 'cols' => 5, 'name' => 'text'])->label('Текст статьи');
				echo $form->field($model, 'flag')
    				->checkbox([
        				'label' => 'скрыть',
        				'labelOptions' => [
            				'style' => 'padding-left:20px;'
        				],
        				'disabled' => false,
        				'name' => 'flag',
    				]);
				echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary']);
				ActiveForm::end();

				Modal::end();
			}
		?>
	</div>

	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
		<?
		echo Html::tag('a', 'X', [
			'class' => 'btn btn-default',
			'href' => Url::to(['test/del?id='.$model->id], true),
		]);
		?>
	</div>
</div>
