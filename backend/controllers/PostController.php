<?php

namespace backend\controllers;

use Yii;
use common\models\Post;
use common\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
       		'access' => [
        		'class' => AccessControl::className(),
       			'rules' =>
       				[
   						[
						'actions' => ['index', 'view'],
						'allow' => true,
						'roles' => ['?'],  // 未認證
   						],
   						[
						'actions' => ['view', 'index', 'create','update','delete'],
						'allow' => true,
						'roles' => ['@'],  // 已認證
   						],
       				],
        	],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
//     	$post = Yii::$app->db->createCommand('select * from post 
// 					where id=:id and status=:status')
// 					->bindValue(':id', $_GET['id'])
// 					->bindValue(':status', 2)
// 					->queryOne();

//     	$post = Post::find()->where(['id'=>$id])->one();
//     	$post = Post::findOne(['id'=>$id]);
//     	var_dump($post);
//     	$posts = Post::findAll(['status'=>2]);
//     	$posts = Post::find()->where(['and','author_id=1', ['status'=>2],['like','title','yii2']])
//     						 ->orderBy('id')->all();    	
//     	var_dump($posts);

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	if (!Yii::$app->user->can('createPost')) {
    		throw new ForbiddenHttpException('抱歉, 您沒有此操作權限');
    	}
        $model = new Post();  

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	if (!Yii::$app->user->can('createPost')) {
    		throw new ForbiddenHttpException('抱歉, 您沒有此操作權限');
    	}
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	if (!Yii::$app->user->can('createPost')) {
    		throw new ForbiddenHttpException('抱歉, 您沒有此操作權限');
    	}
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
