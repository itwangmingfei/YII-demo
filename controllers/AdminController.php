<?php
namespace app\controllers;

use \yii\base\Controller;
use Yii;
use app\models\Content;
use yii\data\Pagination;

class AdminController extends Controller
{
  /*
  @组件接收 $Request = Yii::$app->request;
  @get传值并验证是否是get请求 
  @params id
  @index.php?r=admin/get&id=50
  */
  public function actionGet(){
    $Request = Yii::$app->request;
    $id = $Request->get('id');
    if (!$Request->isget){
      echo "只接受get请求";
      return;
    }
    if($id != null){
      //执行输出或操作
      echo "get id ". $id;
    }else{
      echo "not get file params: id ";
    }
   
  }
  /*@post传值并验证是否是post请求 */
  public function actionPost(){
    $Request = Yii::$app->request;

    if (!$Request->ispost){
      echo "只接受POST请求";
      return;
    }

    $id = $Request->post('id');
    if($id !=null){
      //执行输出或操作
      echo "POST id ". $id;
    }else{
      echo "not post file params: id ";
    }
  }

  /*@List */
  public function actionList(){
    $model = Content::find();
    $total = $model->count();
    $page = 1;
    $pagesize = 2;
    $offset = ($page-1)*$pagesize;
    $where = "";
    $list = $model->where($where)->offset($offset)->limit($pagesize)->all();
    var_dump($list);
    exit;
  }
  /*@Add */
  public function actionAdd(){
    /*@添加数据 */
    $model = new Content();
    $model->title = "ggllook";
    $model->contents = "sdf";
    $model->uid = 2;
    $res = $model->save();
    var_dump($res);

  }
  /*@update */
  public function actionUp(){
    /*@修改数据 */
    $model = Content::findOne(1);
    $model->title= "wmf";
    $model->contents="出水电费";
    $res = $model->save();
    var_dump($res);
  }
  /*@info */
  public function actionInfo(){
    $row = Content::findOne(3);
    var_dump($row);
    echo "info";
  }
  /*@del */
  public function actionDel(){
    /*@删除 */
    $model = Content::findOne(1); 
    $model->delete();
    echo "list";
  }
}