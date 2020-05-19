<?php
namespace app\controllers;
use \yii\base\Controller;
use app\models\Content;
use app\models\Novels;

class AdminqueryController extends Controller{

  //index.php?r=adminquery/info
  public function actionInfo(){
    
    $sql = "select * from content where id=:id";
    $res = Content::findbysql($sql,[":id"=>3])->one();
    echo "<pre>";
    var_dump($res);

  }
  //index.php?r=adminquery/list
  public function actionList(){
    
    $content = Content::find(2)->with('novel')->asarray()->one();
    echo "<pre>";
    var_dump($content);

  }
   //index.php?r=adminquery/novels
  public function actionNovels(){

    $novel = Novels::find()->where(['cid'=>3])->with('content')->asarray()->all();
    echo "<pre>";
    var_dump($novel);
  }

}