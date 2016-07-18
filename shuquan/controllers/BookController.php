<?php

namespace app\controllers;

use Yii;
use app\models\Book;
use app\models\BookSearch;
use app\models\School;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends Controller
{
	public $aboutLittle = null ;
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
			'access' => [
        				'class' => AccessControl::className(),
        				'only' => ['create', 'update', 'delete'],
        				'rules' => [
        						// 允许认证用户
        						[
        								'allow' => true,
        								'roles' => ['@'],
        						],
        						// 默认禁止其他用户
        				],
        		],
        ];
    }

    /**
    显示主页
     */
    public function actionIndex()
    {
        $searchModel = new BookSearch();
		$data = Yii::$app->request->queryParams;
		$view = Yii::$app->view;
		//print_R($data);
		$data['BookSearch']['isshow'] = 1;
		if(Yii::$app->request->get('kind')==1)
		{
			$data['BookSearch']['bookname'] = Yii::$app->request->get('text');
		}
		if(Yii::$app->request->get('kind')==2)
		{
			$data['BookSearch']['publishing'] = Yii::$app->request->get('text');
		}
		if(Yii::$app->request->get('kind')==3)
		{
			$data['BookSearch']['author'] = Yii::$app->request->get('text');
		}
		if(Yii::$app->request->get('kind')==4)
		{
			$data['BookSearch']['isbn'] = Yii::$app->request->get('text');
		}
        $dataProvider = $searchModel->search($data);
		if(isset($data['BookSearch']['schoolid']))
		{
			$t = Yii::$app->homeUrl;
			$id = $data['BookSearch']['schoolid'];
			$view->params['abouturl'] = $t.'/book/index?BookSearch[schoolid]='.$data['BookSearch']['schoolid'];
		}
		else
		{
			$t = Yii::$app->homeUrl;
			$id = 0;
			$view->params['abouturl'] = $t.'/book/index';
		}
		if($id)
		{
			$school = School::findOne($id);
			//print_R($school);
			$title = $school['name'];
		}
		else
		{
			$title = '全部学校';
		}
		$view->params['aboutLittle'] = $title;
		//print_R($dataProvider);
		if(isset($data['BookSearch']['schoolid']))
		{
			 return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'schoolid'=>$data['BookSearch']['schoolid'],
			'text'=>Yii::$app->request->get('text'),
			'kind'=>Yii::$app->request->get('kind'),
			'title'=>$title,
			]);
		}
		else
		{
			 return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'text'=>Yii::$app->request->get('text'),
			'kind'=>Yii::$app->request->get('kind'),
			'schoolid'=>'',
			'title'=>$title,
			]);
		}
       
    }
    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
