### 安装YII

```bash
php -r "readfile('https://getcomposer.org/installer');" | php
composer create-project --prefer-dist yiisoft/yii2-app-basic basic

```
### 请求方式 控制器+方法 index.php?r=adminquery/info
#### adminquery 对应 adminqueryController
#### info 对应 function  actioninfo

### 多表连接
```bash

//Models 关联一个表，对应一个 hasone   Content::className() 存在或创建一个Models Content；
  public function getcontent(){
    return $this->hasOne(Content::className(),["id"=>"cid"]);
  }
```

```bash

//关联一个表对应多条数据 hasMany
  public function getnovel(){
    return $this->hasMany(Novels::className(),['cid'=>'id']);
  }
```

### 控制器
```bash
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
//index.php?r=adminquery/info
  public function actionInfo(){
    
    $sql = "select * from content where id=:id";
    $res = Content::findbysql($sql,[":id"=>3])->one();
    echo "<pre>";
    var_dump($res);

  }
```

### 基本增删改查
```bash

<?php
namespace app\controllers;

use \yii\base\Controller;
use Yii;
use app\models\Content;

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
```