<?php $this->title = 'Error' ?>
<h1><?= $exception->getCode() ?></h1>
<?php
echo $exception->getMessage();
  ?>
