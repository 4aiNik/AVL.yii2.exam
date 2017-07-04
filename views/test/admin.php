<?php
/* @var $this yii\web\View */
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
?>

<? 
echo Html::tag('button', 'Добавить', [
	'class' => 'btn btn-default',
	'url' => ['#'],
	'data-toggle' => 'modal', 
	'data-target' => '#addnews',
	'style' => 'margin: 5em 0 2em 0',
]);

Modal::begin([
	'header' => '<h2>Добавить</h2>',
	'id' => 'addnews',
]);

$form = ActiveForm::begin([
	'id' => 'add_form',
	'method' => 'post',
	'action' => '/yiiproj/web/test/add',
	'options' => ['enctype' => 'multipart/form-data'],
	]);
echo $form->field($model, 'name')->textInput(['name' => 'name'])->label('Заголовок');
echo $form->field($model, 'text')->textarea(['rows' => 5, 'cols' => 5, 'name' => 'text'])->label('Текст статьи');
echo $form->field($model, 'file')->fileInput()->label('Добавить изображение');
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

echo ListView::widget([
	'dataProvider' => $data,
	'itemView' => '_adminNews',
	'layout' => "\n{items}",
	'options' => [
    	'class' => 'Container-fluid',
	],
	'itemOptions' => [
    	'style' => 'margin: 1em 0',
	],
]);
?>
