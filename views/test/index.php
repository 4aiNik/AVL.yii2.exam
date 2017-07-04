<?php
/* @var $this yii\web\View */
use yii\bootstrap\Carousel;
?>

<?
echo Carousel::widget([
	'items' => [
		'<img src="' . Yii::$app->homeUrl . '/img/1.jpg"/>',
		'<img src="' . Yii::$app->homeUrl . '/img/2.jpg"/>',
		'<img src="' . Yii::$app->homeUrl . '/img/3.jpg"/>',
	],
	'options' => [
		'class' => 'carousel slide', 
		'data-interval' => '5000'
	],
	'controls' => [
		'<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>',
		'<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'
	]
]);
?>
