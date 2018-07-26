<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Yansongda\Pay\Pay;
use App\Http\Controllers\Controller;

class WechatController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function wechat()
    {

		$orderConfig = [
			'out_trade_no'     => generateOrderNo(),
			'total_fee'        => 0.01*100, // 单位分
			'body'             => '1232',
			'spbill_create_ip' => static::getIp(),
		];

		$data = [
			'app_id'      => "wxd741646d2b519c60",
			'key'         => 'c27656886d284e71a3d87aa1fce03ed1',
			'mch_id'      => '1502886431',
			'notify_url'  => 'http://xs.38sd.com:81/wechat/wxNotify',
			'return_url'  => 'http://xs.38sd.com:81/wechat/wxReturn',
			'cert_client' => public_path('resources/wechat/apiclient_cert.pem'),
			'cert_key'    => public_path('resources/wechat/apiclient_key.pem'),
		];


		$wechat = Pay::wechat($data)->wap($orderConfig);

		return $wechat;

    }

    public function wxNotify(Request $request){

    	mylog('wxNotify',[123]);

	}

	public function wxReturn(Request $request){

		mylog('wxReturn',[321]);

	}


	public static function getIp()
	{
		if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
			$ip = getenv('HTTP_CLIENT_IP');
		} elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
			$ip = getenv('HTTP_X_FORWARDED_FOR');
		} elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
			$ip = getenv('REMOTE_ADDR');
		} elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return preg_match('/[\d\.]{7,15}/', $ip, $matches) ? $matches [0] : '';
	}

}
