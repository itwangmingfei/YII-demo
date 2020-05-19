<?php
namespace app\models;

use yii\db\ActiveRecord;


class Novels extends ActiveRecord {

  //关联一个表，对应一个 hasone
  public function getcontent(){
    return $this->hasOne(Content::className(),["id"=>"cid"]);
  }
}