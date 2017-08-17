<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Adminuser;
use common\models\Poststatus;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增文章', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            ['attribute' => 'id',
             'contentOptions' => ['width','30px'],
            ],
            'title',
        	['attribute' => 'author_id',
        	 'value' => 'author.nickname',
    		],
            //'author_id',
            //'content:ntext',
            'tags:ntext',
        	['attribute' =>'status',
        	 'value' => 'status0.name',
        	 'filter' => Poststatus::find()
        				 ->select(['name','id'])
        				 ->indexBy('id')
        				 ->orderBy('position')
        				 ->column(),
    		],
        	['attribute' => 'update_time',
        	 'format' => ['datetime', 'php:Y-m-d H:i:s'],
        	],
            //'status',
            // 'create_time:datetime',
            //'update_time:datetime',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
