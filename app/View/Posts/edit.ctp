<h1>記事の編集</h1>
<?php

echo $this->Form->create('Post');
echo $this->Form->input('title');
echo $this->Form->input('body');
echo $this->Form->hidden('id');
echo $this->Form->end('更新');

?>