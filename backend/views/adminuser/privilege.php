<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Adminuser;

/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */
$model = Adminuser::findOne($id);

$this->title = '修改管理員資料: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => '管理員管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="adminuser-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="adminuser-privilege-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= Html::checkboxList('newPri',$AuthAssignmentArray,$allPrivilegesArray);?>

    <div class="form-group">
        <?= Html::submitButton('设置') ?>
    </div>

    <?php ActiveForm::end(); ?>

	</div>

</div>
