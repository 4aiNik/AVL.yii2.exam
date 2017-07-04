<?php
/* @var $this yii\web\View */
use yii\widgets\ListView;


	use yii\helpers\Html;
	use yii\helpers\HtmlPurifier;
	use yii\helpers\Url;

?>

<h1><?= $data->name; ?></h1>



<!--/yii4/basic/web/img/news/5.jpg-->

	<div>
		<? 
			if($data->img){
				echo Yii::$app->formatter->asImage('@web/img/news/' . $data->img, ['width' => '500', 'align' => 'left', 'hspace' => '10']);
			}else{
				echo Yii::$app->formatter->asImage('@web/img/news/default', ['width' => '100']);
			}
		?>
	</div>
	
	<div>
		<? 
			if($data->img){
				echo Yii::$app->formatter->asText($data->text);
			}
		?>
	</div>
	
	<div>
		<? 
			echo yii\helpers\Html::a('назад к новостям', Url::to('yiiproj/web/test/news', true));
		?>
	</div>