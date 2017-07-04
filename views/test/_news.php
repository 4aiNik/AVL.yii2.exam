<? 
	use yii\helpers\Html;
	use yii\helpers\HtmlPurifier;
	use yii\helpers\Url;
?>

<div style="display: table-cell;">
	<div>
		<? 
			echo '<h4>' . yii\helpers\Html::a($model->name, Url::to('news/' . $model->id)) . '</h4>';
		?>
	</div>
	

	<div>
		<? 
			if($model->img){
				echo Yii::$app->formatter->asImage('@web/img/news/' . $model->img, ['width' => '100', 'align' => 'left', 'hspace' => '10']);
			}else{
				echo Yii::$app->formatter->asImage('@web/img/news/default', ['width' => '100']);
			}
		?>
	</div>

	<div>
		<? 
			if($model->img){
				echo Yii::$app->formatter->asText($model->text);
			}
		?>
	</div>
</div>


<!--div>
	<? 
		/*Yii:$app->formatter->locale = 'ru_RU';
		echo Yii::$app->formatter->asDate($model->date, 'locale');*/
	?>
</div-->

