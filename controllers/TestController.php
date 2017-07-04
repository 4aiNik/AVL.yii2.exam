<?php
namespace app\controllers;
use Yii;
use app\models\LoginForm;
use app\models\NewsForm;
use app\models\User;
use app\models\News;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;

class TestController extends \yii\web\Controller {
	
	public function actionIndex() {
		return $this->render('index');
	}
	public function actionAbout() {
		return $this->render('about');
	}
	
	
	public function actionNews($id = 0) {
		if(!$id){
			$data = new ActiveDataProvider([
			'query' => News::find()->where(['flag' => 0]),
			'pagination' => [
				'pagesize' => 3,
				],
			]);
			return $this->render('news', ['data' => $data]);
		}else{
			$data = News::find()->where(['id' => $id])->one();
			return $this->render('onenew', ['data' => $data]);
		}
	}
	
	
	public function actionLogin() {
		
		if (!Yii::$app->user->isGuest){
			return $this->goHome();
		}
		
		//if(Yii::$app->request->post()){
			//echo '<pre>';
			//print_r(Yii::$app->request->post());
			//echo '</pre>';
			//Yii::$app->end();
		//}
		
		$model = new LoginForm();
		
		if ($model->load(Yii::$app->request->post()) && $model->validate()){
			if($model->login())
				return $this->goBack();
			else{
				Yii::$app->session->setFlash('error', 'Возникла ошибка при авторизации');
				Yii::error('Ошибка при регистрации');
				return $this->refresh();
			}
		}
		return $this->render('login', ['model' => $model]);
	}
	
	public function actionLogout(){
		Yii::$app->user->logout();
		return $this->goHome();
	}
	
	public function actionAdmin(){

		if (Yii::$app->user->isGuest){
			return $this->goHome();
		}

		$model = new NewsForm();

		$data = new ActiveDataProvider([
			'query' => News::find(),
		]);
		return $this->render('admin', ['data' => $data, 'model' => $model]);
	}

	public function actionEdit(){
		if (Yii::$app->user->isGuest){
			return $this->goHome();
		}

		$model = new NewsForm();
		
		$model->id = Yii::$app->request->post()['id'];
		$model->name = Yii::$app->request->post()['name'];
		$model->text = Yii::$app->request->post()['text'];
		$model->flag = Yii::$app->request->post()['flag'];
		if($model->edit()){
			return Yii::$app->response->redirect(['test/admin']);
		}
	}

	public function actionAdd(){
		if (Yii::$app->user->isGuest){
			return $this->goHome();
		}

		$model = new NewsForm();

		if($model->load(Yii::$app->request->post())){
			$file = UploadedFile::getInstance($model, 'file');
			if ($file) {
				$model->file = $file;
			} else {
				$model->file = false;
			}
			$model->name = Yii::$app->request->post()['name'];
			$model->text = Yii::$app->request->post()['text'];
			$model->flag = Yii::$app->request->post()['flag'];
			if($model->add()){
				return Yii::$app->response->redirect(['test/admin']);
			}
		}
	}

	public function actionDel(){
		if (Yii::$app->user->isGuest){
			return $this->goHome();
		}

		$id = Yii::$app->request->get()['id'];
		$model = new NewsForm();

		if($model->del($id)){
			return Yii::$app->response->redirect(['test/admin']);
		}
	}
}