<?php

//Controllerというフォルダの中にあるAppController.phpというファイル(class)を使う。
//次の行でextends Appcontrollerを使うため。
App::uses('AppController', 'Controller');
class PostsController extends AppController {
    //public $name = 'Posts';
    //Post→Model名(Post.php)
    //public $uses = array('Post', 'User');
    //→上と同じ。PostはModel名 public $uses = ['Post', 'User'];
    // ヘルパーの利用宣言(呪文)

    //public $helpers = array('Html', 'Form');


      //↓記事の一覧をすべて引っ張ってくる。第一引数で指定した変数である'posts'はviewの中で使える。これがset関数
      //つまりviewの中で$postsとできる。
      //postsの中身が$this->Post->find('all')となる。Postモデルの中から全てのレコードを引っ張ってくる。
      // $posts
      // $row = $stmt->fetchALL(); フレームワークを使うと以前習ったこの書き方を省略できる。

    public function index() {
    // $options = array(
    //             'limit' => '3'
    //             );
        //ModelにあるPost.phpからデータベースにアクセスしてfindで全てのデータを配列として取ってくる。それをsugiuraに代入してsetでviewの中にあるindexに投げる
        $this->set('sugiura' ,$this->Post->find('all'
          //,$options
          ));
    }

//viewは個別記事を表示するためのアクション
    public function view($id = null) {
        // var_dump($id);
        // exit;
        //$this->Post->id = $id;
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
        //$this->Post->id = $id;
        $post = $this->Post->findById($id);

        if ($this->request->is('get')) {

            $this->request->data = $post;
        }

        //set、requestで2種類の投げ方がある

        if ($this->request->is(array('post', 'put'))) {
            if ($this->Post->save($this->request->data)) {
                // $this->Session->setFlash('Updated!');
                $this->Flash->success('Update');
                $this->redirect(array('action' => 'index'));
            } else {
                // $this->Session->setFlash('Failed...');
                $this->Flash->error('Falied');
            }
        }

    }

    public function delete($id = null) {
        if ($this->request->is('get')) {
          //  posts/delete/1 とかURL直打ちして消えるような設定だと不味いので以下の書き方にする
          //  つまりGETで来たら以下の例外処理をしろということ
        throw new MethodNotAllowedException();
        }

        if ($this->Post->delete($id))
//trueならば
         {
            $this->Flash->success('削除が成功しました');
            // $this->Session->setFlash('deleted');
        } else {
            $this->Flash->error('削除が失敗しました');
            // $this->Session->setFlash('could not deleted');
        }
        $this->redirect(array('action' => 'index'));
    }


}