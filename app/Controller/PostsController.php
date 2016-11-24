<?php

//Controllerというフォルダの中にあるAppController.phpというファイル(class)を使う。
//次の行でextends Appcontrollerを使うため。
App::uses('AppController', 'Controller');
class PostsController extends AppController {
    public $name = 'Posts';
    public $uses = array('Post');

    // ヘルパーの利用宣言(呪文)
    public $helpers = array('Html', 'Form');


      //↓記事の一覧をすべて引っ張ってくる。第一引数で指定した変数である'posts'はviewの中で使える。これがset関数
      //つまりviewの中で$postsとできる。
      //postsの中身が$this->Post->find('all')となる。Postモデルの中から全てのレコードを引っ張ってくる。
      // $posts
      // $row = $stmt->fetchALL(); フレームワークを使うと以前習ったこの書き方を省略できる。

    public function index() {
    // $options = array(
    //             'limit' => '3'
    //             );
        $this->set('posts' ,$this->Post->find('all'
          //,$options
          ));
    }

//viewは個別記事を表示するためのアクション
    public function view($id = null) {
        $this->Post->id = $id;
        $this->set('post', $this->Post->findById($id));
    }


    public function add() {
        if ($this->request->is('post')) {
            $this->Post->create();
            if ($this->Post->Save($this->request->data)) {
                $this->Session->setFlash('Saved!!!');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Failed...');
            }
        }
    }

    public function edit($id = null) {
        $this->Post->id = $id;
        $post = $this->Post->findById($id);

        if ($this->request->is('get')) {
            $this->request->data = $post;
        }

        if ($this->request->is(array('post', 'put'))) {
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Updated!');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Failed...');
            }
        }

    }

    public function delete($id = null) {
        if ($this->request->is('get')) {
          //  posts/delete/1 とかURL直打ちして消えるような設定だと不味いので以下の書き方にする
          //  つまりGETで来たら以下の例外処理をしろということ
        throw new MethodNotAllowedException();
        }

        if ($this->Post->delete($id)) {
            $this->Session->setFlash('deleted');
        } else {
            $this->Session->setFlash('could not deleted');
        }
        $this->redirect(array('action' => 'index'));
    }


}