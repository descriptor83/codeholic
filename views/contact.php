<?php
/**@var $this \app\core\View */

use app\core\form\Form;
use app\core\form\TextareaField;

/** $model \app\models\ContactForm */
 $this->title = 'Contact';
 ?>
<h1>Contact</h1>
<?php $form = Form::begin('', 'post') ?>
<?= $form->field($model, 'subject') ?>
<?= $form->field($model, 'email') ?>
<?= new TextareaField($model, 'body') ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end() ?>
