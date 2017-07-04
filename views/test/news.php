<?php
/* @var $this yii\web\View */
use yii\widgets\ListView;
?>

<h1>Новости</h1>
<? 
	echo ListView::widget([
		'dataProvider' => $data,
		'itemView' => '_news',
	]);
?>
