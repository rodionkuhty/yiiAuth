<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\ActiveField;
use app\models\AuthForm;


?>

    <h1>Login Form</h1>


<?php //$form = ActiveForm::begin(['id' => 'contact-form']); ?>
    <!---->
<?//= $form->field($model, 'login')->textInput(['autofocus' => true]) ?>
    <!---->
<?//= $form->field($model, 'password') ?>
    <!---->
    <!---->
    <!--<div class="form-group">-->
    <!--    --><?//= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    <!--</div>-->
    <!---->
<?php //ActiveForm::end(); ?>


<?$formLogin = ActiveForm::begin();?>

    <!--        --><?//=$form->field($model, 'name')->label('Name');?>
    <!--        --><?//=$form->field($model, 'email')->label('Email');?>
    <!--       --><?//=$form->field($model, 'text')->label('Your Message')->textarea();?>

<?=$formLogin->field($form, 'login')->label('Логин');?>
<?=$formLogin->field($form, 'password')->label('Пароль');?>

<?= Html::submitButton('Auth Please',['class'=>"btn btn-success"])?>
<?$formLogin = ActiveForm::end();?>

<?

if(isset($user_id)){
    echo $user_id;
} else{
    echo "not working";
}


?>