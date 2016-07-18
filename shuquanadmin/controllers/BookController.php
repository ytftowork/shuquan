<?php

namespace app\controllers;

use Yii;
use app\models\Book;
use app\models\Bookimg;
use app\models\UploadForm;
use app\models\School;
use app\models\BookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends Controller
{
    // public function behaviors()
    // {
        // return [
            // 'verbs' => [
                // 'class' => VerbFilter::className(),
                // 'actions' => [
                    // 'delete' => ['post'],
                // ],
            // ],
        // ];
    // }

    /**
     * Lists all Book models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Book model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$model = $this->findModel($id);
		//echo Yii::$app->basePath . '/../shuquan/web/img' . $model->bookimg->localurl;
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Book();
		$file = new UploadForm();
		$school = School::find()->all();
		$schooldata = ArrayHelper::map($school,'id','name');
        if (Yii::$app->request->post()) {
			$data = Yii::$app->request->post();
			
			$data['Book']['price'] = (string)round($data['Book']['oldprice']*0.1,1);
			$data['Book']['deposit'] = (string)round($data['Book']['oldprice']*0.2,1);
			$data['Book']['oldprice'] = (string)round($data['Book']['oldprice'],1);
			$model->load($data);
			//print_R($data);
			$model->save();
			//print_R($model);
			$file->file = UploadedFile::getInstance($file, 'file');
			if ($file->file && $file->validate()) {    
				$filename = uniqid();
				$file->file->saveAs(Yii::$app->basePath . '/../shuquan/web/img/img/' .$filename . '.' . $file->file->extension);
				$bookimg = new Bookimg;
				$bookimg['bookid'] = $model->id;
				$bookimg['localurl'] = '/img/' . $filename . '.' . $file->file->extension;
				//print_R($bookimg);
				$bookimg->save();
            }
           return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
				'school' => $schooldata,
				'file' => $file,
            ]);
        }
    }

    /**
     * Updates an existing Book model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$file = new UploadForm();
		$school = School::find()->all();
		$schooldata = ArrayHelper::map($school,'id','name');
        if (Yii::$app->request->post()) {
			$data = Yii::$app->request->post();
			$data['Book']['price'] = (string)round($data['Book']['oldprice']*0.1,1);
			$data['Book']['deposit'] = (string)round($data['Book']['oldprice']*0.2,1);
			$data['Book']['oldprice'] = (string)round($data['Book']['oldprice'],1);
			$model->load($data);
			//print_R($data);
			$model->save();
			$file->file = UploadedFile::getInstance($file, 'file');
			if ($file->file && $file->validate()) {    
				$filename = uniqid();
				$file->file->saveAs(Yii::$app->basePath . '/../shuquan/web/img/img/' .$filename . '.' . $file->file->extension);
				$bookimg = $model->bookimg;
				$bookimg['id'] = $model->bookimg->id;
				$bookimg['bookid'] = $model->bookimg->bookid;
				$bookimg['localurl'] = '/img/' . $filename . '.' . $file->file->extension;
				//print_R($bookimg);
				$bookimg->save();
            }
			return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'school' => $schooldata,
				'file' => $file,
            ]);
        }
    }

    /**
     * Deletes an existing Book model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $book = $this->findModel($id);
		$book['isshow'] = 0;
		$book->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
