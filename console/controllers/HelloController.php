<?php
namespace console\controllers;

use yii\console\controllers;
use yii\console\Controller;
use console\controllers\sms2;
use common\models\Post;

class HelloController extends Controller
{
	
	public function actionIndex() //Index 是預設動作
	{
		echo "Hello World!!\n";
		
		/* Socket to Air Server IP ,Port */
		$server_ip = '202.39.54.130';
		$server_port = 8000;
		$TimeOut=10;
		
		$user_acc  = "xxxxxxxxxxx";
		$user_pwd  = "xxxxxxxxxxx";
		$mobile_number= "xxxxxxxxxxx";
		$message= "帳號:polin 密碼:12345 期限到2017/03/02 12:37";
		
		/*建立連線*/
		$mysms = new sms2();
		$ret_code = $mysms->create_conn($server_ip, $server_port, $TimeOut, $user_acc, $user_pwd);
		$ret_msg = $mysms->get_ret_msg();
		
		if($ret_code==0){
			echo "連線成功"."<br>\n";
			/*如欲傳送多筆簡訊，連線成功後使用迴圈執行$mysms->send_text()即可*/
			$ret_code = $mysms->send_text($mobile_number, $message);
			$ret_msg = $mysms->get_ret_msg();
			if($ret_code==0){
				echo "簡訊傳送成功"."<br>";
				echo "ret_code=".$ret_code."<br>\n";
				echo "ret_msg=".$ret_msg."<br>\n";
			}else{
				echo "簡訊傳送失敗"."<br>\n";
				echo "ret_code=".$ret_code."<br>\n";
				echo "ret_msg=".$ret_msg."<br>\n";
			}
		} else {
			echo "連線失敗"."<br>\n";
			echo "ret_code=".$ret_code."<br>\n";
			echo "ret_msg=".$ret_msg."<br>\n";
		}
		
		/*關閉連線*/
		$mysms->close_conn();
		
	}
	
	public function actionPostlist()
	{
		$posts = Post::find()->all();
		foreach ($posts as $post)
		{
			echo $post['id'].' - '.$post['title'] ."\n";
		}
	}
	
}