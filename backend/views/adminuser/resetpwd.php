<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */

$this->title = '重設管理員:' .$model->username .' 密碼';
$this->params['breadcrumbs'][] = ['label' => '管理員管理', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '重設密碼';
?>
<div class="adminuser-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('重設密碼', ['btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
