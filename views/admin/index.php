<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

//Yii没有使用模版引擎
$data = array(
  'name'=>"这个要处理",
  'age' => 19,
  'message'=>"al<script>alert(1);</script>"
);



?>
<h1>过滤xss</h1>
<h2><?=($data['message'])?></h2>
<h2><?=Html::encode($data['message'])?></h2>
<h2><?=HtmlPurifier::process($data['message'])?></h2>



 