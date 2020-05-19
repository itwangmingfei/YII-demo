<?php
namespace app\models;

use yii\db\ActiveRecord;


class Content extends ActiveRecord {

  //关联一个表对应多条数据 hasMany
  public function getnovel(){
    return $this->hasMany(Novels::className(),['cid'=>'id']);
  }
}