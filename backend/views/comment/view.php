<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '評論管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('刪除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您確定刪除這一筆評論嗎?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'content:ntext',
        	[
        	'attribute'=>'status',
        	'value' => $model->status0->name,
    		],
        	
            //'status',
            //'create_time:datetime',
            [
            'attribute' => 'create_time',
            'format' => ['date' , 'php: Y-m-d H:i:s']
    		],
            //'userid',
            [
            'attribute' => 'userid',
            'value' => $model->user->username,
    		],
            'email:email',
            'url:url',
            //'post_id',
            [
            'attribute' => 'post_id',
            'value' => $model->post->title,
    		],
            'remind',
        ],
    ]) ?>

</div>
