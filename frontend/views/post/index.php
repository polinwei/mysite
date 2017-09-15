<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use frontend\components\TagsCloudWidget;
use yii\base\Widget;
use frontend\components\RctReplyWidget;
use common\models\Post;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'Posts';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
	<div class="col-md-9">
		<ol class="breadcrumb">
			<li><a href="<?= Yii::$app->homeUrl;?>">首页</a></li>
			<li>文章列表</li>		
		</ol>	
		<?= ListView::widget([
				'id'=>'postList',
				'dataProvider'=>$dataProvider,
				'itemView'=>'_listitem',//子视图,显示一篇文章的标题等内容.
				'layout'=>'{items} {pager}',
				'pager'=>[
						'maxButtonCount'=>10,
						'nextPageLabel'=>Yii::t('app','下一页'),
						'prevPageLabel'=>Yii::t('app','上一页'),
		],
		])?>


	</div><!-- end left side -->
	<div class="col-md-3">
			<div class="searchbox">
				<ul class="list-group">
				  <li class="list-group-item">
				  	<span class="glyphicon glyphicon-search" aria-hidden="true"></span> 查找文章(
				  	<?php 
				  		$postsCount = Yii::$app->cache->get("postsCount");
				  		
				  		if(!$postsCount){
				  			$postsCount = Post::find()->count(); sleep(5);
				  			Yii::$app->cache->set("postsCount", $postsCount,60); // 60秒 後失效
				  		}	
				  		
				  		echo $postsCount;
				  	?>
				  	)
				  </li>
				  <li class="list-group-item">				  
					<form class="form-inline" action="<?= Yii::$app->urlManager->createUrl(['post/index']);?>" id="w0" method="get">
						  <div class="form-group">
						    <input type="text" class="form-control input-group" name="PostSearch[title]" id="w0input" placeholder="按標題">
						  </div>
						  <button type="submit" class="btn btn-default btn-sm">搜索</button>
					</form>				  
				  </li>
				</ul>			
			</div>
			<div class="tagcloudbox">
				<ul class="list-group">
				  <li class="list-group-item">
				  <span class="glyphicon glyphicon-tags" aria-hidden="true"></span> 標籤雲
				  </li>
				  <li class="list-group-item">
				  	<?= TagsCloudWidget::widget(
				  			['tags'=>$tags]) 
				  	?>
				  </li>
				</ul>			
			</div>			
			<div class="commentbox">
				<ul class="list-group">
				  <li class="list-group-item">
				  <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> 最新回复
				  </li>
				  <li class="list-group-item">
				  	<?= RctReplyWidget::widget(
				  			['recentComments'=>$recentComments,
				  	]); 
				  	?>
				  </li>
				</ul>			
			</div>			
	</div>	
	

</div>
