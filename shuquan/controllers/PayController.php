<?php

namespace app\controllers;
use Yii;
use app\models\Package;
use app\models\Book;
use app\models\Order;
use app\models\Orderpackage;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\yii2_alipay\AlipayPay;
class PayController extends Controller
{
	public function behaviors()
    {
        return [
            'access' => [
               'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['pay'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['notify', 'return_call'],
                        'allow' => true,
                        'roles' => ['?','@'],
                    ],
                ],
            ],
        ];
    }
	public function beforeAction($action)
	{
		$this->enableCsrfValidation = false;
		return parent::beforeAction($action);
	}
	 // /**
     // * 生成付款跳转链接
     // * @return string
     // */
    public function actionPay($id)
    {
		if(!$id)
		{
			$t = Yii::$app->homeUrl;
			echo "<script>alert('未获取到订单');window.location.href='".$t."package/waitpay';</script>";
			exit();
		}
		$order = new Order();
		$data1['id'] = $id;
		$data1['userid'] = Yii::$app->user->id;
		$orderinfo = Order::find()->where($data1)->one();
		if($orderinfo['overtime']<time()||$orderinfo['status']!=1)
		{
			$t = Yii::$app->homeUrl;
			echo "<script>alert('订单已经失效，请重新下订单');window.location.href='".$t."package/waitpay';</script>";
			exit();
		}
		$total = 0;
		for($i=0;$i<count($orderinfo->orderpackage);$i++)
		{
			$package = $orderinfo->orderpackage[$i]->package;
			$total = $total+$package->book->price+$package->book->deposit;
			//$orderSn = $orderSn.$pac['packageid'][$i]."~";
			//print_R($package->book);
		}
		//echo $total;
		//print_R($pac);
		$total = 0.01;//round($total,1);
        $order_id = $id;
        $gift_name = "租赁书籍";
        $money = $total;
        $body = "租赁书籍";
        $show_url = 'http://shuquan.53.haitou.cc/';
        $alipay = new AlipayPay();
		$alipay->notify_url = Yii::$app->urlManager->createAbsoluteUrl('pay/notify');
        $alipay->return_url = Yii::$app->urlManager->createAbsoluteUrl('pay/return_call');
        $html = $alipay->requestPay($order_id, $gift_name, $money, $body, $show_url);
        echo $html;
    }

    /**
     * @var String 服务器异步通知页面路径
     * 需http://格式的完整路径，不能加?id=123这类自定义参数
     */
    public function actionNotify()
    {
        $alipay = new AlipayPay();
		$alipay->notify_url = Yii::$app->urlManager->createAbsoluteUrl('pay/notify');
        $alipay->return_url = Yii::$app->urlManager->createAbsoluteUrl('pay/return_call');
        $verify_result = $alipay->verifyNotify();
        if ($verify_result) {//验证成功
            //商户订单号
            $out_trade_no = Yii::$app->request->post('out_trade_no');
			//交易状态
            $trade_status = Yii::$app->request->post('trade_status');
			if($trade_status == 'TRADE_FINISHED'||$trade_status == 'TRADE_SUCCESS') 
			{
				$order = new Order();
				$data1['id'] = $out_trade_no;
				$orderinfo = Order::find()->where($data1)->one();
				$orderinfo->status = 2;
				$orderinfo->paytime = time();
				$orderinfo->save();
				for($i=0;$i<count($orderinfo->orderpackage);$i++)
				{
					$package = $orderinfo->orderpackage[$i]->package;
					$package->status = 2;
					$package->save();
					//$orderSn = $orderSn.$pac['packageid'][$i]."~";
					//print_R($package->book);
				}
				//$this->redirect(['package/waitbook']);
			}
			
            //返回状态
            return "success";
        } else {
            //验证失败
            return "fail";
        }
    }
    /**
     * @var String 页面跳转同步通知页面路径
     * 需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
     */
    public function actionReturn_call()
    {
        //判断结果，跳转到不同页面
		 $alipay = new AlipayPay();
		$alipay->notify_url = Yii::$app->urlManager->createAbsoluteUrl('pay/notify');
        $alipay->return_url = Yii::$app->urlManager->createAbsoluteUrl('pay/return_call');
		 $result = $alipay->verifyReturn();

        if ($result) {
			$success = $_GET['trade_status'];
			$out_trade_no = $_GET['out_trade_no'];
			if ($success == 'TRADE_SUCCESS'||$success == 'TRADE_FINISHED') {
				//$out_trade_no = $_POST['out_trade_no'];
				$order = new Order();
				$data1['id'] = $out_trade_no;
				$orderinfo = Order::find()->where($data1)->one();
				$orderinfo->status = 2;
				$orderinfo->paytime = time();
				$orderinfo->save();
				for($i=0;$i<count($orderinfo->orderpackage);$i++)
				{
					$package = $orderinfo->orderpackage[$i]->package;
					$package->status = 2;
					$package->save();
					//$orderSn = $orderSn.$pac['packageid'][$i]."~";
					//print_R($package->book);
				}
				$this->redirect(['package/success']);
			} else {
				echo 'no';
			}
		}
		else {
            echo 'fail';
		}
	}
}
