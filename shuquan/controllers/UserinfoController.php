<?php

namespace app\controllers;

use Yii;
use dektrium\user\models\User;
use app\models\Userinfo;
use app\models\UserinfoSearch;
use app\models\School;
use app\models\Department;
use app\models\Pickinfo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * USerinfoController implements the CRUD actions for Userinfo model.
 */
class UserinfoController extends Controller
{
     public function behaviors()
    {
        return [
           'access' => [
        				'class' => AccessControl::className(),
        				'only' => ['index','changepassword', 'pickaddress'],
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
     *个人信息
     */
    public function actionIndex()
    {
		//echo Yii::$app->user->username;
		//print_R(Yii::$app->user->id);
		if(Yii::$app->request->isPost)
		{
			$data1 = Yii::$app->request->post();
			//print_R($data);
			if(!$data1['Userinfo']['departmentname'])
			{
				$t = Yii::$app->homeUrl;
				echo "<script>alert('院系名称不能为空');window.location.href='".$t."userinfo/index';</script>";
				exit();
				//return $this->redirect(['pickaddress']);
			}
			if(!$data1['Userinfo']['realname'])
			{
				$t = Yii::$app->homeUrl;
				echo "<script>alert('真实姓名不能为空');window.location.href='".$t."userinfo/index';</script>";
				exit();
				//return $this->redirect(['pickaddress']);
			}
			if(!$data1['Userinfo']['phone'])
			{
				$t = Yii::$app->homeUrl;
				echo "<script>alert('电话号码不能为空');window.location.href='".$t."userinfo/index';</script>";
				exit();
				//return $this->redirect(['pickaddress']);
			}
		}
		$sql = "select * from `userinfo` where `id` = ".Yii::$app->user->id;
		$model = new Userinfo;
		$data = Userinfo::findBySql($sql)->one();
		$sql1 = "select * from `user` where `id` = ".Yii::$app->user->id;
		$model = new User;
		$data1 = User::findBySql($sql1)->one();
		//print_R($data);
		$school = School::find();
		$schooldata = $school->all();
		$department = Department::find();
		$departmentdata = $department->all();
		//print_r($schooldata);
		$sql1 = "select * from `pickinfo` where `schoolid` = ".$data['school'];
		$pickinfo = Pickinfo::findBySql($sql1);
		$pickinfodata = $pickinfo->all();
		$userinfo = Userinfo::findOne(Yii::$app->user->id);
		$view = Yii::$app->view;
		$t = Yii::$app->homeUrl;
		$view->params['titleinfo'] = '个人信息';
		$view->params['titleurl'] = $t.'userinfo/index';
		if(Yii::$app->request->isPost && $userinfo -> load(Yii::$app->request->post()) && $userinfo->save()){
				return $this->redirect(['index']);
			}
		return $this->render('index' , ['data' => $data,'data1'=>$data1,'schooldata'=>$schooldata,'departmentdata'=>$departmentdata,'pickinfodata'=>$pickinfodata,'model'=>$model]);
    }
	public function actionChangevalue()
	{
		if (Yii::$app->request->isAjax) {
			$data = Yii::$app->request->get();
			$pickdata['schoolid'] = $data['school'];
		   $pick = Pickinfo::find()->where($pickdata)->all();
			\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return [
				'data' => $pick,
				'code' => 100,
			];
		}
	}
	public function actionChangepick()
	{
		if (Yii::$app->request->isAjax) {
			$data = Yii::$app->request->get();
			$pickdata['id'] = $data['pick'];
		   $pick = Pickinfo::find()->where($pickdata)->all();
			\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return [
				'data' => $pick,
				'code' => 100,
			];
		}
	}
   /**
     修改密码
     */
    // public function actionChangepassword()
    // {
		// //echo(Yii::$app->request->post('oldpas'));
		// $view = Yii::$app->view;
		// $view->params['titleinfo'] = '修改密码';
		// $view->params['titleurl'] = '/userinfo/changepassword';
        // if(Yii::$app->request->isPost ){
				// //echo(Yii::$app->request->post('oldpas'));
				// $userinfo = User::findOne(Yii::$app->user->id);
				// //print_R($userinfo);
				// if(md5(Yii::$app->request->post('oldpas'))!=$userinfo['password'])
				// {
					// echo "<script type='text/javascript'>alert('旧密码错误');</script>";
					// return $this->render('changepassword');
				// }
				// if(Yii::$app->request->post('newpas')!=Yii::$app->request->post('repas'))
				// {
					// echo "<script type='text/javascript'>alert('两次输入密码不一样');</script>";
				// }
				// if(!Yii::$app->request->post('newpas'))
				// {
					// echo "<script type='text/javascript'>alert('新密码不能为空');</script>";
				// }
				// if(Yii::$app->request->post('newpas')&md5(Yii::$app->request->post('oldpas'))==$userinfo['password']&Yii::$app->request->post('newpas')==Yii::$app->request->post('repas'))
				// {
					// $data['Userinfo']['password'] = md5(Yii::$app->request->post('newpas'));
					// $userinfo->load($data);
					// //print_R($userinfo);
					// $userinfo->save();
					// return $this->redirect(['index']);
				// }
			
				// //return $this->redirect(['changepassword']);
			// }
		// return $this->render('changepassword');
    // }
	 /**
     收货人信息
     */
    // public function actionPickaddress()
    // {
		// if(Yii::$app->request->isPost)
		// {
			// $data = Yii::$app->request->post();
			// //print_R($data);
			// if(!$data['Userinfo']['realname'])
			// {
				// echo "<script>alert('error');window.location.href('Userinfo/pickaddress');</script>";
				// //return $this->redirect(['pickaddress']);
			// }
		// }
		
		
		// $view = Yii::$app->view;
		// $view->params['titleinfo'] = '收货地址';
		// $view->params['titleurl'] = '/user/pickaddress';
		// $sql = "select * from `userinfo` where `id` = ".Yii::$app->user->id;
		// $model = new Userinfo;
		// $data = Userinfo::findBySql($sql)->one();
		// $sql1 = "select * from `pickinfo` where `schoolid` = ".$data['school'];
		// $pickinfo = Pickinfo::findBySql($sql1);
		// $pickinfodata = $pickinfo->all();
		// //print_r($pickinfodata);
		// $userinfo = Userinfo::findOne(Yii::$app->user->id);
		// if(Yii::$app->request->isPost && $userinfo -> load(Yii::$app->request->post()) && $userinfo->save()){
				// return $this->redirect(['pickaddress']);
			// }
		// return $this->render('pickaddress' , ['data' => $data,'pickinfodata'=>$pickinfodata,'model'=>$model]);
    // }

    /**
     * Finds the Userinfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Userinfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Userinfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
