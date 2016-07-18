<?php

namespace app\controllers;

use Yii;
use app\models\Package;
use app\models\PackageSearch;
use app\models\Book;
use app\models\BookSearch;
use app\models\Order;
use app\models\Userinfo;
use app\models\Orderpackage;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\yii2_alipay\AlipayPay;
/**
 * PackageController implements the CRUD actions for Package model.
 */
class PackageController extends Controller
{

    // public function behaviors()
    // {
        // return [
           
			// 'access' => [
        				// 'class' => AccessControl::className(),
        				// 'only' => ['addbook','index','waitbook','getbook','backbook','delete','confirm','waitpay','orderpage','alipay','confirmall','back','backall'],
        				// 'rules' => [
        						// // 允许认证用户
        						// [
        								// 'allow' => true,
        								// 'roles' => ['@'],
        						// ],
        						// // 默认禁止其他用户
        				// ],
        		// ],
        // ];
    // }

	public function beforeAction($action)
	{
		$this->enableCsrfValidation = false;
		return parent::beforeAction($action);
	}

	/**
    package 待收书 显示package status 为2的数据 实现比较复杂 首先取出所有order 判断order对应的package是否有status为2的 如果有 把order的judge设为1  然后只显示judge为1的数据
     */
    public function actionWaitbook()
    {
		$order = new Order();
		$orderinfo = Order::find()->OrderBy('time desc')->all();
		//$data1['userid'] = Yii::$app->user->id;
		$data = Yii::$app->request->post();
		$kind = 1;
		$text = "";
		if(isset($data['kind']))
		{
			if($data['kind']==1)
			{
				$orderinfo = Order::find()->andFilterWhere(['like','id',$data['text']])->OrderBy('time desc')->all();
			}
			if($data['kind']==2)
			{
				$user = Userinfo::find()->andFilterWhere(['like','realname',$data['text']])->all();
				$userid = "";
				for($i=0;$i<count($user);$i++)
				{
					
					if($i==(count($user)-1))
					{
						$userid = $userid.$user[$i]['id'];
					}
					else
					{
						$userid = $userid.$user[$i]['id'].",";
					}
				}
				if(count($user))
				{
					$sql = "select * from `order` where `userid` in ({$userid}) order by `time` desc";
					$model = new Order;
					$orderinfo = Order::findBySql($sql)->all();
				}
				else
				{
					$orderinfo=array();
				}
				
			}
			$kind = $data['kind'];
			$text = $data['text'];
		}
		
		for($i=0;$i<count($orderinfo);$i++)
		{
			$judge = 0;
			for($j=0;$j<count($orderinfo[$i]->orderpackage);$j++)
			{
				if($orderinfo[$i]->orderpackage[$j]->package->status==2)
				{
					$judge = 1;
				}
			}
			$orderinfo[$i]->judge = $judge;
			
		}
		$datainfo = array();
		$j=0;
		//print_R($orderinfo)		
		for($i=0;$i<count($orderinfo);$i++)
		{
			if($orderinfo[$i]['judge']==1)
			{
				$datainfo[$j] = $orderinfo[$i];
				$j++;
			}
		}
		$pagination = new \yii\data\Pagination(['totalCount' => count($datainfo) , 'pageSize' => 5]);
		$j = 0;
		$data = array();
		for($i=$pagination->offset;$i<$pagination->offset+$pagination->limit;$i++)
		{
			if($i>(count($datainfo)-1))
			{
				break;
			}
			$data[$j] = $datainfo[$i];
			$j++;
		}
		return $this->render('waitbook' , ['data' => $data , 'pagination' => $pagination,'kind'=>$kind,'text'=>$text]);
    }
	/**
    package 已收书
     */
    public function actionGetbook()
    {
		$order = new Order();
		$orderinfo = Order::find()->OrderBy('time desc')->all();
		$data = Yii::$app->request->post();
		$kind = 1;
		$text = "";
		if(isset($data['kind']))
		{
			if($data['kind']==1)
			{
				$orderinfo = Order::find()->andFilterWhere(['like','id',$data['text']])->OrderBy('time desc')->all();
			}
			if($data['kind']==2)
			{
				$user = Userinfo::find()->andFilterWhere(['like','realname',$data['text']])->all();
				$userid = "";
				for($i=0;$i<count($user);$i++)
				{
					
					if($i==(count($user)-1))
					{
						$userid = $userid.$user[$i]['id'];
					}
					else
					{
						$userid = $userid.$user[$i]['id'].",";
					}
				}
				if(count($user))
				{
					$sql = "select * from `order` where `userid` in ({$userid}) order by `time` desc";
					$model = new Order;
					$orderinfo = Order::findBySql($sql)->all();
				}
				else
				{
					$orderinfo=array();
				}
				
			}
			$kind = $data['kind'];
			$text = $data['text'];
		}
		for($i=0;$i<count($orderinfo);$i++)
		{
			$judge = 0;
			for($j=0;$j<count($orderinfo[$i]->orderpackage);$j++)
			{
				if($orderinfo[$i]->orderpackage[$j]->package->status==3)
				{
					$judge = 1;
				}
			}
			$orderinfo[$i]->judge = $judge;
			
		}
		$datainfo = array();
		$j=0;
		//print_R($orderinfo)		
		for($i=0;$i<count($orderinfo);$i++)
		{
			if($orderinfo[$i]['judge']==1)
			{
				$datainfo[$j] = $orderinfo[$i];
				$j++;
			}
		}
		$pagination = new \yii\data\Pagination(['totalCount' => count($datainfo) , 'pageSize' => 5]);
		$j = 0;
		$data = array();
		for($i=$pagination->offset;$i<$pagination->offset+$pagination->limit;$i++)
		{
			if($i>(count($datainfo)-1))
			{
				break;
			}
			$data[$j] = $datainfo[$i];
			$j++;
		}
		 return $this->render('getbook' , ['data' => $data , 'pagination' => $pagination,'kind'=>$kind,'text'=>$text]);
    }
	/**
    package 已还书
     */
    public function actionBackbook()
    {
       $order = new Order();
		$orderinfo = Order::find()->OrderBy('time desc')->all();
		$data = Yii::$app->request->post();
		$kind = 1;
		$text = "";
		if(isset($data['kind']))
		{
			if($data['kind']==1)
			{
				$orderinfo = Order::find()->andFilterWhere(['like','id',$data['text']])->OrderBy('time desc')->all();
			}
			if($data['kind']==2)
			{
				$user = Userinfo::find()->andFilterWhere(['like','realname',$data['text']])->all();
				$userid = "";
				for($i=0;$i<count($user);$i++)
				{
					
					if($i==(count($user)-1))
					{
						$userid = $userid.$user[$i]['id'];
					}
					else
					{
						$userid = $userid.$user[$i]['id'].",";
					}
				}
				if(count($user))
				{
					$sql = "select * from `order` where `userid` in ({$userid}) order by `time` desc";
					$model = new Order;
					$orderinfo = Order::findBySql($sql)->all();
				}
				else
				{
					$orderinfo=array();
				}
				
			}
			$kind = $data['kind'];
			$text = $data['text'];
		}
		for($i=0;$i<count($orderinfo);$i++)
		{
			$judge = 0;
			for($j=0;$j<count($orderinfo[$i]->orderpackage);$j++)
			{
				if($orderinfo[$i]->orderpackage[$j]->package->status==4)
				{
					$judge = 1;
				}
			}
			$orderinfo[$i]->judge = $judge;
			
		}
		$datainfo = array();
		$j=0;
		//print_R($orderinfo)		
		for($i=0;$i<count($orderinfo);$i++)
		{
			if($orderinfo[$i]['judge']==1)
			{
				$datainfo[$j] = $orderinfo[$i];
				$j++;
			}
		}
		$pagination = new \yii\data\Pagination(['totalCount' => count($datainfo) , 'pageSize' => 5]);
		$j = 0;
		$data = array();
		for($i=$pagination->offset;$i<$pagination->offset+$pagination->limit;$i++)
		{
			if($i>(count($datainfo)-1))
			{
				break;
			}
			$data[$j] = $datainfo[$i];
			$j++;
		}
		 return $this->render('backbook' , ['data' => $data , 'pagination' => $pagination,'kind'=>$kind,'text'=>$text]);
    }
   
   /**
	确认收书status设为3
     */
    public function actionConfirm($id)
    {
		$model = $this->findModel($id);
			$data = Yii::$app->request->post();
			$data['Package']['time'] = time();
			$data['Package']['status'] = 3;
			$model->load($data);
			$model->save();
		$this->redirect(['package/getbook']);
    }
	/**
	批量确认收书status设为3
     */
    public function actionConfirmall()
    {
		$data = Yii::$app->request->post();
		//print_R($data['packageid']);
		if(!isset($data['packageid']))
		{
			$t = Yii::$app->homeUrl;
			echo "<script>alert('请选择要确认收书的书籍');window.location.href='".$t."?r=package/waitbook';</script>";
			exit();
		}
		for($i=0;$i<count($data['packageid']);$i++)
		{
			$model = $this->findModel($data['packageid'][$i]);
			//print_R($model);

				$data['Package']['time'] = time();
				$data['Package']['status'] = 3;
				$model->load($data);
				$model->save();
		}
		$this->redirect(['package/getbook']);
    }
	/**
	确认还书status设为4
     */
    public function actionBack($id)
    {
		$filepath = dirname(dirname(dirname(__FILE__)))."/shuquan"."/runtime/lock.txt";
		$fp = fopen($filepath, "w+");
		if(flock($fp,LOCK_EX))
		{
			$model = $this->findModel($id);

				//$data = Yii::$app->request->post();
				$data['Package']['backtime'] = time();
				$data['Package']['status'] = 4;
				//修改押金
				$time = time()-$model->time-24*3600*365;
				if($time>0)
				{
					$day = floor($time/24/3600/7);
					$data['Package']['resdeposit'] = ($model->resdeposit-round($model->book->oldprice*$day*0.01,1))>0?$model->resdeposit-round($model->book->oldprice*$day*0.01,1):0;
					$data['Package']['resdeposit'] = (string)$data['Package']['resdeposit'];
				}
				$model->load($data);
				//print_R($model);
				$model->save();
				// print_R($model->errors);
				// 修改book库存
				$temp['id'] = $model->bookid;
				$book = Book::find()->where($temp)->one();
				$book['number'] = $book->number+1;
				$book->save();
			flock($fp,LOCK_UN);
		}
		fclose($fp);
		$this->redirect(['package/backbook']);
    }
	/**
	批量确认还书status设为4
     */
    public function actionBackall()
    {
		$filepath = dirname(dirname(dirname(__FILE__)))."/shuquan"."/runtime/lock.txt";
		$fp = fopen($filepath, "w+");
		if(flock($fp,LOCK_EX))
		{
			$data = Yii::$app->request->post();
			//print_R($data['packageid']);
			if(!isset($data['packageid']))
			{
				$t = Yii::$app->homeUrl;
				echo "<script>alert('请选择要确认还书的书籍');window.location.href='".$t."?r=package/getbook';</script>";
				exit();
			}
			for($i=0;$i<count($data['packageid']);$i++)
			{
				$model = $this->findModel($data['packageid'][$i]);
				//print_R($model);

					$data['Package']['backtime'] = time();
					$data['Package']['status'] = 4;
					//修改押金
					$time = time()-$model->time-24*3600*365;
					if($time>0)
					{
						$day = floor($time/24/3600/7);
						$data['Package']['resdeposit'] = ($model->resdeposit-round($model->book->oldprice*$day*0.01,1))>0?$model->resdeposit-round($model->book->oldprice*$day*0.01,1):0;
						$data['Package']['resdeposit'] = (string)$data['Package']['resdeposit'];
					}
					$model->load($data);
					$model->save();
					
					// 修改book库存
					$temp['id'] = $model->bookid;
					$book = Book::find()->where($temp)->one();
					$book['number'] = $book->number+1;
					$book->save();
			}
			flock($fp,LOCK_UN);
		}
		fclose($fp);
		$this->redirect(['package/backbook']);
    }

	
	

	
    protected function findModel($id)
    {
        if (($model = Package::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
