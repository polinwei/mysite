<?php
namespace console\controllers;

use Wechat\Loader;
use yii\console\Controller;

class WechatController extends Controller
{
	public function actionSend()
	{
		# 配置参数
		$config = array(
				'token'          => $token,
				'appid'          => $appid,
				'appsecret'      => $appsecret,
				'encodingaeskey' => '',
		);
		# 加载对应操作接口
		$wechat = &\Wechat\Loader::get('User', $config);
		$userlist = $wechat->getUserList();
		
		//var_dump($userlist);
		//var_dump($wechat->errMsg);
		//var_dump($wechat->errCode);
		
		$wechat = &\Wechat\Loader::get('Receive', $config);		
		$data = array (
				"touser" => $userlist['next_openid'],
				"msgtype" => "text",
				"text" => array (
						"content" => "hello polin".date("Y-m-d H:i:s",time())
				)
				// 在下面5种类型中选择对应的参数内容
				// mpnews | voice | image | mpvideo => array( "media_id"=>"MediaId")
				// text => array ( "content" => "hello")
		);
		$wechat->sendCustomMessage($data);
		
	}
}

