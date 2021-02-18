<?php
use app\core\form\Form;
/** @var $model \app\models\User */
$this->title = 'Registration';
?>
<h1>Register</h1>
<?php $form = Form::begin('', 'post')?>
	<?= $form->field($model, 'firstname')  ?>
	<?= $form->field($model, 'lastname')  ?>
	<?= $form->field($model, 'email')  ?>
	<?= $form->field($model, 'password')->passwordField()  ?>
	<?= $form->field($model, 'confirmPassword')->passwordField()  ?>
	<button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end() ?>
