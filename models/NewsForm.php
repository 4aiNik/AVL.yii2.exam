<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\Url;

class NewsForm extends \yii\db\ActiveRecord
{
	public $id;
    public $name;
    public $text;
    public $img;
    public $date;
    public $flag;
    public $file;

    public static function tableName()
    {
        return '{{news}}';
    }

    public function rules()
    {
        return [
            [['name', 'text'], 'required'],
            [['text'], 'string'],
            [['date'], 'safe'],
            [['flag'], 'integer'],
            [['name', 'img'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => 'png, jpg'],
        ];
    }
    public function add()
    {
        $connection = Yii::$app->db;
        $connection->createCommand()->insert(
            'news', [
                'name' => $this->name, 
                'text' => $this->text, 
                'date' => new \yii\db\Expression('NOW()'),
                'flag' => $this->flag,
            ]
        )->execute();
        
        if($this->file){
            $insert_id = $connection->getLastInsertID();
            $connection->createCommand()->update(
                'news', 
                ['img' => $insert_id . '.' . $this->file->extension], 
                'id = '.$insert_id
            )->execute();

            if ($this->validate(['file'])){
                $dir = Yii::getAlias('img/news/');
                $fileName = $insert_id . '.' . $this->file->extension;
                $this->file->saveAs($dir . $fileName);
                $this->file = $fileName;
            }

        }
        return true;
    }

    public function edit()
    {
        $news = News::findOne($this->id);
        $news->name = $this->name;
        $news->text = $this->text;
        $news->date = new \yii\db\Expression('NOW()');
        $news->flag = $this->flag;
        return $news->save();
    }

    public function del($id)
    {
        $connection = Yii::$app->db;

        $myfile = Yii::$app->db->createCommand('SELECT img FROM news WHERE id=:id')
           ->bindValue(':id', $id)
           ->queryOne();

        if($myfile['img'] != 'default.jpg'){
            unlink(Yii::getAlias('@app').'\web\img\news\\'.$myfile['img']);
        }
        $connection->createCommand()
            ->delete('news', 'id = '.$id)
            ->execute();
        return true;

    }
}
