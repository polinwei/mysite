<?php

namespace console\controllers;

use yii\console\Controller;
use common\models\Comment;
use console\controllers\sms2;

class SmsController extends Controller
{
	public function actionSend()
	{
		$newCommentCount = Comment::find()->where(['remind'=>0,'status'=>1])->count();
		if ($newCommentCount>0){
			$msg = "[".date('Y-m-d H:i:s',time() )."] 您有:".$newCommentCount."新評論\r\n";			
			$sendResult = $this->vendorSmsService($msg);			
			if ($sendResult==0) {
				Comment::updateAll(['remind'=>1]); // 把新評論全設為已提醒
				echo $msg;				
				
			}
			return $sendResult;
		}	
		return 0;
		
	}
	
	protected function vendorSmsService($msg)
	{
		/* Socket to Air Server IP ,Port */
		$server_ip = '202.39.54.130';
		$server_port = 8000;
		$TimeOut=10;
		
		$user_acc  = "xxxxxxxxxxx";
		$user_pwd  = "xxxxxxxxxxx";
		$mobile_number= "xxxxxxxxxxx";		
		$message= $msg;
		
		/*建立連線*/
		$mysms = new sms2();
		$ret_code = $mysms->create_conn($server_ip, $server_port, $TimeOut, $user_acc, $user_pwd);
		$ret_msg = $mysms->get_ret_msg();
		
		if($ret_code==0){
			/*如欲傳送多筆簡訊，連線成功後使用迴圈執行$mysms->send_text()即可*/
			$sent_code = $mysms->send_text($mobile_number, $message);
			$ret_msg = $mysms->get_ret_msg();
		}
		
		/*關閉連線*/
		$mysms->close_conn();
		return  $sent_code;
	}
}