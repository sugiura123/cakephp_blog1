<?php
//バリデーションはModel→public→$validateを使って***に対して配列を使って記載する
//extends AppModelのclassを使うために,ModelフォルダにあるAppModelをusesとした。
App::uses('AppModel', 'Model');
class Post extends AppModel {

 public $validate = array(
        'title' => array(
            'rule' => array('maxLength', '20'),
            //required→何か入力されていればtrueとする
            'required' => true,
            'message' => 'タイトルは20文字以内で入力してください'
            )
        );

}