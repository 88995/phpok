<?php
/*****************************************************************************************
	文件： payment/alipay/submit.php
	备注： 支付接口提交页
	版本： 4.x
	网站： www.phpok.com
	作者： qinggan <qinggan@188.com>
	时间： 2014年5月2日
*****************************************************************************************/
if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");}
class alipay_submit
{
	//支付接口初始化
	public $param;
	public $order;
	public $paydir;
	public $baseurl;
	public function __construct($order,$param)
	{
		$this->param = $param;
		$this->order = $order;
		$this->paydir = $GLOBALS['app']->dir_root.'gateway/payment/alipay/';
		$this->baseurl = $GLOBALS['app']->url;
		include_once($this->paydir."lib/alipay_submit.class.php");
	}

	public function param($param)
	{
		$this->param = $param;
	}

	public function order($order)
	{
		$this->order = $order;
	}

	//创建订单
	function submit()
	{
        $notify_url = $this->baseurl."gateway/payment/alipay/notify_url.php";
        $return_url = $GLOBALS['app']->url('payment','notice','id='.$this->order['id'],'www',true);
        $show_url = $GLOBALS['app']->url('payment','show','id='.$this->order['id'],'www',true);
        $currency_id = $this->param['currency'] ? $this->param['currency']['id'] : $this->order['currency_id'];
        $total_fee = price_format_val($this->order['price'],$this->order['currency_id'],$currency_id);
		$parameter = array(
				"service" => $this->param['param']['ptype'],
				"partner" => trim($this->param['param']['pid']),
				"payment_type"	=> 1,
				"notify_url"	=> $notify_url,
				"return_url"	=> $return_url,
				"seller_email"	=> $this->param['param']['email'],
				"out_trade_no"	=> $this->order['sn'],
				"subject"	=> $this->order['title'],
				"body"	=> $this->order['content'],
				"show_url"	=> $show_url,
				"_input_charset"	=> 'utf-8'
		);
		if($this->param['param']['ptype'] == 'create_partner_trade_by_buyer'){
			$parameter['price'] = $total_fee;
			$parameter['quantity'] = '1';
			$parameter['logistics_fee'] = '0.00';
			$parameter['logistics_type'] = 'EXPRESS';
			$parameter['logistics_payment'] = 'SELLER_PAY';
			$address = $GLOBALS['app']->model('order')->address_shipping($this->order['id']);
			if(!$address){
				$address = array('province'=>'未知','city'=>'未知','county'=>'未知');
				$address['address'] = '未知';
				$address['mobile'] = '13000000000';
				$address['zipcode'] = '000000';
				$address['tel'] = '0000-00000000';
				$address['fullname'] = '未知';
			}
			$parameter['receive_name'] = $address['fullname'];
			$parameter['receive_address'] = $address['province'].$address['city'].$address['county'].$address['address'];
			$parameter['receive_zip'] = $address['zipcode'];
			$parameter['receive_phone'] = $address['tel'];
			$parameter['receive_mobile'] = $address['mobile'];
		}else{
			$parameter['total_fee'] = $total_fee;
			$parameter['anti_phishing_key'] = '';
			$parameter['exter_invoke_ip'] = phpok_ip();
		}

		//合作身份者id，以2088开头的16位纯数字
		$alipay_config = array('partner'=>$this->param['param']['pid'],'key'=>$this->param['param']['key']);
		$alipay_config['sign_type'] ='MD5';
		$alipay_config['input_charset']= 'utf-8';
		$alipay_config['cacert']    = $this->paydir.'cacert.pem';
		$alipay_config['transport']    = 'http';
		//建立请求
		$alipaySubmit = new AlipaySubmit($alipay_config);
		echo '<!DOCTYPE html>'."\n";
		echo '<html>'."\n";
		echo '<head>'."\n\t";
		echo '<meta charset="utf-8" />'."\n\t";
		echo '<title>付款中</title>'."\n";
		echo '</head>'."\n<body>\n";
		echo $alipaySubmit->buildRequestForm($parameter,"get", "确认");
		echo "\n".'</body>'."\n</html>";
		exit;
	}
}
?>