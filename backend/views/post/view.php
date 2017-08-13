<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use phpDocumentor\Reflection\DocBlock\Tags\Formatter;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content:ntext',
            'tags:ntext',
            //'status',
            ['label'=>'狀態',
             'value'=>$model->status0->name,
            ],            
            ['attribute' =>'create_time',
             'value' => date('Y-m-d H:i:s',$model->create_time),
    		],
        	['attribute' =>'update_time',
        	 //'value' => date('Y-m-d H:i:s',$model->update_time),
        	 'format' => ['datetime', 'php:Y-m-d H:i:s']
        	],
    		//'create_time:datetime',
            //'update_time:datetime',
            //'author_id',
            ['attribute' => 'author_id',
             'value' => $model->author->nickname,
    		]
        ],
    		'template'=>'<tr><th style="width:120px;">{label}</th><td>{value}</td></tr>',
    		'options' => ['class' => 'table table-striped table-bordered detail-view'],
    ]) ?>

</div>
