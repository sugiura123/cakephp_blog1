<h2>新規記事の投稿</h2>

<?php

echo $this->Form->create('Post');
echo $this->Form->input('title');
echo $this->Form->input('body');
echo $this->Form->end('Save Post');

?>