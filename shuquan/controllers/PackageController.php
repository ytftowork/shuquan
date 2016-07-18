<?php

namespace app\controllers;

use Yii;
use app\models\Package;
use app\models\PackageSearch;
use app\models\Book;
use app\models\BookSearch;
use app\models\Order;
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

    public function behaviors()
    {
        return [
           
			'access' => [
        				'class' => AccessControl::className(),
        				'only' => ['addbook','index','waitbook','getbook','backbook','delete','confirm','waitpay','orderpage','alipay','confirmall','back','backall'],
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

	public function beforeAction($action)
	{
		$this->enableCsrfValidation = false;
		return parent::beforeAction($action);
	}

    /**
    package首页 书包
     */
    public function actionIndex()
    {
        $searchModel = new PackageSearch();
		$data = Yii::$app->request->queryParams;
		$data['userid'] = Yii::$app->user->id;
		$data['deletekind'] = 1;
		$data['status'] = 1;
		$data['isshow'] = 1;
		//$data['book']['isshow'] = 1;
        $dataProvider = Package::find()->joinWith('book')->where($data)->OrderBy('package.id desc');
		// print_R($dataProvider);
		$pagination = new \yii\data\Pagination(['totalCount' => $dataProvider->count() , 'pageSize' => 5]);
		$data = $dataProvider->offset($pagination->offset)->limit($pagination->limit)->all();
		$view = Yii::$app->view;
		$view->params['titleinfo'] = '我的书包';
		$t = Yii::$app->homeUrl;
		$view->params['titleurl'] = $t.'package/index';
        return $this->render('index', [
            'searchModel' => $searchModel,
            'data' => $data,
			'pagination' => $pagination,
        ]);
    }
	/**
    package 待收书 显示package status 为2的数据 实现比较复杂 首先取出所有order 判断order对应的package是否有status为2的 如果有 把order的judge设为1  然后只显示judge为1的数据
     */
    public function actionWaitbook()
    {
		$order = new Order();
		$data1['userid'] = Yii::$app->user->id;
		$orderinfo = Order::find()->where($data1)->OrderBy('time desc')->all();
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
		$view = Yii::$app->view;
		$view->params['titleinfo'] = '待收书';
		$t = Yii::$app->homeUrl;
		$view->params['titleurl'] = $t.'package/waitbook';
		 return $this->render('waitbook' , ['data' => $data , 'pagination' => $pagination]);
    }
	/**
    package 已收书
     */
    public function actionGetbook()
    {
		$order = new Order();
		$data1['userid'] = Yii::$app->user->id;
		$orderinfo = Order::find()->where($data1)->OrderBy('time desc')->all();
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
		$view = Yii::$app->view;
		$view->params['titleinfo'] = '已收书';
		$t = Yii::$app->homeUrl;
		$view->params['titleurl'] = $t.'package/getbook';
		 return $this->render('getbook' , ['data' => $data , 'pagination' => $pagination]);
    }
	/**
    package 已还书
     */
    public function actionBackbook()
    {
        $searchModel = new PackageSearch();
		$data = Yii::$app->request->queryParams;
		$data['PackageSearch']['userid'] = Yii::$app->user->id;
		$data['PackageSearch']['status'] = 4;
        $dataProvider = $searchModel->search1($data);
		//print_R($dataProvider);
		$view = Yii::$app->view;
		$view->params['titleinfo'] = '已还书';
		$t = Yii::$app->homeUrl;
		$view->params['titleurl'] = $t.'package/backbook';
        return $this->render('backbook', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	//待付款
	public function actionWaitpay()
	{
		$order = new Order();
		$data1['userid'] = Yii::$app->user->id;
		$data1['status'] = 1;
		$orderinfo = Order::find()->where($data1)->OrderBy('time desc');
		$pagination = new \yii\data\Pagination(['totalCount' => $orderinfo->count() ,  'pageSize' => 5]);
		$data = $orderinfo->offset($pagination->offset)->limit($pagination->limit)->all();
		$view = Yii::$app->view;
		$view->params['titleinfo'] = '待付款';
		$t = Yii::$app->homeUrl;
		$view->params['titleurl'] = $t.'package/waitpay';
		 return $this->render('waitpay' , ['data' => $data , 'pagination' => $pagination]);
	}
	//付款确认页面
	public function actionOrderpage($id)
	{
		$order = new Order();
		$data1['id'] = $id;
		$data1['userid'] = Yii::$app->user->id;
		$data = Order::find()->where($data1)->all();
		//print_R($orderinfo);
		$view = Yii::$app->view;
		$view->params['titleinfo'] = '付款确认页';
		$view->params['titleurl'] = '#';
		 return $this->render('orderpage', [
            'data' => $data
        ]);
	}
	
		/**
	创建订单，转入付款确认页面
     */
    public function actionAlipay()
    {
		$fp = fopen(Yii::getAlias('@runtime/lock.txt'), "w+");
		//echo Yii::getAlias('@runtime/lock.txt');
		if(flock($fp,LOCK_EX))
		{
			$pac = Yii::$app->request->post();
			// print_R($pac);
			// echo count($pac['packageid']);
			// orderid
			$judge;
			if(!isset($pac['packageid']))
			{
				$t = Yii::$app->homeUrl;
				echo "<script>alert('请选择要租借的书籍');window.location.href='".$t."package/index';</script>";
				exit();
			}
			for($i=0;$i<count($pac['packageid']);$i++)
			{
				$model = $this->findModel($pac['packageid'][$i]);
				$temp['id'] = $model->bookid;
				$book = Book::find()->where($temp)->one();
				if(isset($judge[$book->id]))
				{
					$judge[$book->id]['number'] = $judge[$book->id]['number'] - 1;
				}
				else
				{
					$judge[$book->id]['number'] = $book->number-1;
				}
				
				if($judge[$book->id]['number']<0)
				{
					// echo $model->book->bookname;
					$name = $model->book->bookname."库存不足";
					$t = Yii::$app->homeUrl;
					echo "<script>alert('$name');window.location.href='".$t."package/index';</script>";
					exit();
				}
			}
			//print_R($judge);
			$yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
			$orderSn = $yCode[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
			// 存储order
			$order = new Order();
			$data['Order']['id'] = $orderSn;
			$data['Order']['time'] =  time();
			$data['Order']['overtime'] =  time()+20*60;
			$data['Order']['status'] =  1;
			$data['Order']['userid'] = Yii::$app->user->id;;
			$order->load($data);
			$order->save();
			// 存储orderpackage
			for($i=0;$i<count($pac['packageid']);$i++)
			{
				$model = $this->findModel($pac['packageid'][$i]);
				if($model->userid==Yii::$app->user->id)
				{
					// 修改book库存
					$temp['id'] = $model->bookid;
					$book = Book::find()->where($temp)->one();
					$book['number'] = $book->number-1;
					$book->save();
					//添加订单和package对应表
					$orderpackage = new Orderpackage();
					// print_R($orderpackage);
					$data1['Orderpackage']['orderid'] = $orderSn;
					$data1['Orderpackage']['packageid'] =  $pac['packageid'][$i];
					$orderpackage->load($data1);
					// print_R($orderpackage);
					$orderpackage->save();
				}
				
			}
			for($i=0;$i<count($pac['packageid']);$i++)
			{
				$model = $this->findModel($pac['packageid'][$i]);
				if($model->userid==Yii::$app->user->id)
				{
					$data['Package']['deletekind'] = 0;
					$model->load($data);
					$model->save();
				}
			}
		  flock($fp,LOCK_UN);
		}
		fclose($fp);
		$this->redirect(['package/orderpage','id'=>$orderSn]);
    }
	
	//添加进书包
	public function actionAddbook($id)
    {
        $model = new Package();
		$data = Yii::$app->request->post();
		$data['Package']['userid'] = Yii::$app->user->id;
		$data['Package']['bookid'] = $id;
		$data['Package']['status'] = 1;
		$book = Book::findOne($id);
		$data['Package']['resdeposit'] = $book['deposit'];
		$data['Package']['deletekind'] = 1;
		// print_R($data);
		$model->load($data);
		$model->save();
		$this->redirect(['package/index']);

    }
	 /**
	删除该书包记录 deletekind设为0
     */
    public function actionDelete($id)
    {
		$model = $this->findModel($id);
		if($model->userid==Yii::$app->user->id)
		{
			$data = Yii::$app->request->post();
			$data['Package']['deletekind'] = 0;
			$model->load($data);
			$model->save();
		}
		$this->redirect(['package/index']);
    }
    /**
	付款成功页面
     */
    public function actionSuccess()
    {
		 return $this->render('success');
    }
   // /**
	// 确认收书status设为3
     // */
    // public function actionConfirm($id)
    // {
		// $model = $this->findModel($id);
		// if($model->userid==Yii::$app->user->id)
		// {
			// $data = Yii::$app->request->post();
			// $data['Package']['time'] = time();
			// $data['Package']['status'] = 3;
			// $model->load($data);
			// $model->save();
		// }
		// $this->redirect(['package/getbook']);
    // }
	// /**
	// 批量确认收书status设为3
     // */
    // public function actionConfirmall()
    // {
		// $data = Yii::$app->request->post();
		// //print_R($data['packageid']);
		// if(!isset($data['packageid']))
		// {
			// $t = Yii::$app->homeUrl;
			// echo "<script>alert('请选择要确认收书的书籍');window.location.href='".$t."package/waitbook';</script>";
			// exit();
		// }
		// for($i=0;$i<count($data['packageid']);$i++)
		// {
			// $model = $this->findModel($data['packageid'][$i]);
			// //print_R($model);
			// if($model->userid==Yii::$app->user->id)
			// {
				// $data['Package']['time'] = time();
				// $data['Package']['status'] = 3;
				// $model->load($data);
				// $model->save();
			// }
		// }
		// $this->redirect(['package/getbook']);
    // }
	// /**
	// 确认还书status设为4
     // */
    // public function actionBack($id)
    // {
		// $fp = fopen(Yii::getAlias('@runtime/lock.txt'), "w+");
		// if(flock($fp,LOCK_EX))
		// {
			// $model = $this->findModel($id);
			// if($model->userid==Yii::$app->user->id)
			// {
				// //$data = Yii::$app->request->post();
				// $data['Package']['backtime'] = time();
				// $data['Package']['status'] = 4;
				// //修改押金
				// $time = time()-$model->time-24*3600*365;
				// if($time>0)
				// {
					// $day = floor($time/24/3600/7);
					// $data['Package']['resdeposit'] = ($model->resdeposit-round($model->book->oldprice*$day*0.01,1))>0?$model->resdeposit-round($model->book->oldprice*$day*0.01,1):0;
					// $data['Package']['resdeposit'] = (string)$data['Package']['resdeposit'];
				// }
				// $model->load($data);
				// //print_R($model);
				// $model->save();
				// // print_R($model->errors);
				// // 修改book库存
				// $temp['id'] = $model->bookid;
				// $book = Book::find()->where($temp)->one();
				// $book['number'] = $book->number+1;
				// $book->save();
			// }
			// flock($fp,LOCK_UN);
		// }
		// fclose($fp);
		// $this->redirect(['package/backbook']);
    // }
	// /**
	// 批量确认还书status设为4
     // */
    // public function actionBackall()
    // {
		// $fp = fopen(Yii::getAlias('@runtime/lock.txt'), "w+");
		// if(flock($fp,LOCK_EX))
		// {
			// $data = Yii::$app->request->post();
			// //print_R($data['packageid']);
			// if(!isset($data['packageid']))
			// {
				// $t = Yii::$app->homeUrl;
				// echo "<script>alert('请选择要确认还书的书籍');window.location.href='".$t."package/getbook';</script>";
				// exit();
			// }
			// for($i=0;$i<count($data['packageid']);$i++)
			// {
				// $model = $this->findModel($data['packageid'][$i]);
				// //print_R($model);
				// if($model->userid==Yii::$app->user->id)
				// {
					// $data['Package']['backtime'] = time();
					// $data['Package']['status'] = 4;
					// //修改押金
					// $time = time()-$model->time-24*3600*365;
					// if($time>0)
					// {
						// $day = floor($time/24/3600/7);
						// $data['Package']['resdeposit'] = ($model->resdeposit-round($model->book->oldprice*$day*0.01,1))>0?$model->resdeposit-round($model->book->oldprice*$day*0.01,1):0;
						// $data['Package']['resdeposit'] = (string)$data['Package']['resdeposit'];
					// }
					// $model->load($data);
					// $model->save();
					
					// // 修改book库存
					// $temp['id'] = $model->bookid;
					// $book = Book::find()->where($temp)->one();
					// $book['number'] = $book->number+1;
					// $book->save();
				// }
			// }
			// flock($fp,LOCK_UN);
		// }
		// fclose($fp);
		// $this->redirect(['package/backbook']);
    // }
	
	 // // /**
     // // * 生成付款跳转链接
     // // * @return string
     // // */
    // public function actionPay($id)
    // {
		// if(!$id)
		// {
			// echo "<script>alert('未获取到订单');window.location.href=package/waitpay;</script>";
			// exit();
		// }
		// $order = new Order();
		// $data1['id'] = $id;
		// $data1['userid'] = Yii::$app->user->id;
		// $orderinfo = Order::find()->where($data1)->one();
		// if($orderinfo['overtime']<time()||$orderinfo['status']!=1)
		// {
			// echo "<script>alert('订单已经失效，请重新下订单');window.location.href='/package/waitpay';</script>";
			// exit();
		// }
		// $total = 0;
		// for($i=0;$i<count($orderinfo->orderpackage);$i++)
		// {
			// $package = $orderinfo->orderpackage[$i]->package;
			// $total = $total+$package->book->price+$package->book->deposit;
			// //$orderSn = $orderSn.$pac['packageid'][$i]."~";
			// //print_R($package->book);
		// }
		// //echo $total;
		// //print_R($pac);
		// $total = 0.01;//round($total,2);
        // $order_id = $id;
        // $gift_name = "租赁书籍";
        // $money = $total;
        // $body = "租赁书籍";
        // $show_url = 'http://shuquan.53.haitou.cc/';
        // $alipay = new AlipayPay();
        // $html = $alipay->requestPay($order_id, $gift_name, $money, $body, $show_url);
        // echo $html;
    // }

    // /**
     // * @var String 服务器异步通知页面路径
     // * 需http://格式的完整路径，不能加?id=123这类自定义参数
     // */
    // public function actionNotify()
    // {
        // $alipay = new AlipayPay();
        // $verify_result = $alipay->verifyNotify();
		// $fp = fopen(Yii::getAlias('@runtime/test.txt'), "w");
		// //$str = 123;
		// $str = "订单号".$_POST['out_trade_no']."交易状态".$_POST['trade_status'];
		// fwrite($fp,$str);
		// fclose($fp);
        // if ($verify_result) {//验证成功
            // //商户订单号
            // $out_trade_no = $_POST['out_trade_no'];
			// //交易状态
            // $trade_status = $_POST['trade_status'];
			// if($_POST['trade_status'] == 'TRADE_FINISHED'||$_POST['trade_status'] == 'TRADE_SUCCESS') 
			// {
				// $order = new Order();
				// $data1['id'] = $out_trade_no;
				// $orderinfo = Order::find()->where($data1)->one();
				// $orderinfo->status = 2;
				// $orderinfo->save();
				// for($i=0;$i<count($orderinfo->orderpackage);$i++)
				// {
					// $package = $orderinfo->orderpackage[$i]->package;
					// $package->status = 2;
					// $package->save();
					// //$orderSn = $orderSn.$pac['packageid'][$i]."~";
					// //print_R($package->book);
				// }
				// $this->redirect(['package/waitbook']);
			// }
			
            // //返回状态
            // echo "success";
        // } else {
            // //验证失败
            // echo "fail";
        // }
    // }


    // /**
     // * @var String 页面跳转同步通知页面路径
     // * 需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
     // */
    // public function actionReturn_call()
    // {
        // //判断结果，跳转到不同页面
        // $success = $_GET['trade_status'];
        // $out_trade_no = $_GET['out_trade_no'];
        // if ($success == 'TRADE_SUCCESS'||$success == 'TRADE_FINISHED') {
            // //$out_trade_no = $_POST['out_trade_no'];
			// $order = new Order();
			// $data1['id'] = $out_trade_no;
			// $orderinfo = Order::find()->where($data1)->one();
			// $orderinfo->status = 2;
			// $orderinfo->save();
			// for($i=0;$i<count($orderinfo->orderpackage);$i++)
			// {
				// $package = $orderinfo->orderpackage[$i]->package;
				// $package->status = 2;
				// $package->save();
				// //$orderSn = $orderSn.$pac['packageid'][$i]."~";
				// //print_R($package->book);
			// }
			// $this->redirect(['package/waitbook']);
        // } else {
            // echo 'no';
        // }
    // }
	
	

	
    protected function findModel($id)
    {
        if (($model = Package::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
