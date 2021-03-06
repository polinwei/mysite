<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Poststatus;
use yii\helpers\ArrayHelper;
use common\models\Adminuser;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>   

	<!-- 
	/**
	 * 使用 Redactor 的寫法如下
	 *  $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className())
	 */		
	 -->
	
	
<?= $form->field($model, 'content')->widget(\dominus77\tinymce\TinyMce::className(), [    
    'options' => [
        'rows' => 25
    ],
	'language' => 'zh_TW',
	'clientOptions' => 
	[
			'menubar'=> false,
		'theme' => 'modern',
		'plugins' => [
						"sh4tinymce advlist autolink lists link image charmap print preview hr anchor pagebreak",
						"searchreplace wordcount visualblocks visualchars code fullscreen",
						"insertdatetime media nonbreaking save table contextmenu directionality",
						"emoticons template paste textcolor colorpicker textpattern imagetools codesample toc fontawesome noneditable",
					],
		'noneditable_noneditable_class' => 'fa',
		'extended_valid_elements' => 'span[class|style]',
		'toolbar1' => "undo redo | sh4tinymce | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
		'toolbar2' => "print preview media | forecolor backcolor emoticons fontawesome | codesample | addmore",					
		'image_advtab' => true,
		'templates' => 
		[
			[
			'title' => 'Test template 1',
			'content' => 'Test 1',
			],
			[
			'title' => 'Test template 2',
			'content' => 'Test 2',
			]
		],
		
		//'codesample_content_css' => '/css/prism.css',
	],
	'fileManager' => 
	[
	'class' => \dominus77\tinymce\components\MihaildevElFinder::className(),
	'controller' => 'elfinder',
	'title' => 'My File Manager',
	'width' => 900,
	'height' => 400,
	'resizable' => 'yes',
	],
]);?>

    <?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>

<?php 
/*
		原來: $form->field($model, 'status')->textInput()
		第一種方法:
		$form->field($model, 'status')->dropDownList( [1=>'草稿',2=>'已發佈'],['prompt'=>'請選擇'])
		第二種方法:
		$psObjs = Poststatus::find()->all();
		$allStatus = ArrayHelper::map($psObjs, 'id', 'name');
		$form->field($model, 'status')->dropDownList( $allStatus,['prompt'=>'請選擇'])
		第三種方法:
		$psArray = Yii::$app->db->createCommand('select id,name from poststatus')->queryAll();
		$allStatus = ArrayHelper::map($psArray, 'id', 'name');
		$form->field($model, 'status')->dropDownList( $allStatus,['prompt'=>'請選擇'])
		第四種方法:
		$allStatus = (new \yii\db\Query())
		->select(['name','id'])
		->from(['poststatus'])
		->indexBy('id')
		->column();
		    測試結果:
			echo '<pre>';
			print_r($allStatus);
			echo  '</pre>';
		第五種方法:
		$allStatus= Poststatus::find()
		->select(['name','id'])
		->from(['poststatus'])
		->indexBy('id')
		->column();
		$form->field($model, 'status')->dropDownList( $allStatus,['prompt'=>'請選擇'])	
		
		
		<?= $form->field($model, 'create_time')->textInput() ?>
    	<?= $form->field($model, 'update_time')->textInput() ?>
*/	

?>

	<?= $form->field($model, 'status')->dropDownList( Poststatus::find()
										->select(['name','id'])
										->orderBy('position')
										->indexBy('id')
										->column(),['prompt'=>'請選擇']) ?>



    <?= $form->field($model, 'author_id')->dropDownList( Adminuser::find()
										->select(['nickname','id'])										
										->indexBy('id')
										->column(),['prompt'=>'請選擇'])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
