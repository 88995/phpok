<?php
/*****************************************************************************************
	文件： payment/alipay/notice.php
	备注： 支付通知页
	版本： 4.x
	网站： www.phpok.com
	作者： qinggan <qinggan@188.com>
	时间： 2014年5月3日
*****************************************************************************************/
if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");}
class alipay_notice
{
	var $paydir;
	var $order;
	var $payment;
	public function __construct($order,$param)
	{
		global $app;
		$this->param = $param;
		$this->order = $order;
		$this->paydir = $app->dir_root.'gateway/payment/alipay/';
		$this->baseurl = $app->url;
		include_once($this->paydir."lib/alipay_notify.class.php");
	}

	//获取订单信息
	public function submit()
	{
		global $app;
		//如果异步通知已通验证，同步通知就不需要再次验收
		if($this->order['status']){
			return true;
		}
		unset($_GET[$app->config['ctrl_id']],$_GET[$app->config['func_id']],$_GET['id'],$_GET['_noCache']);
		$alipay_config = array('partner'=>$this->param['param']['pid'],'key'=>$this->param['param']['key']);
		$alipay_config['sign_type'] ='MD5';
		$alipay_config['input_charset']= 'utf-8';
		$alipay_config['cacert']    = $this->paydir.'cacert.pem';
		$alipay_config['transport']    = 'http';
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verify($_GET);
		if(!$verify_result){
			error(P_Lang('订单验证不通过，请联系管理员确认'),$app->url,'error');
		}
		$pay_date = $app->get('notify_time');
		if($pay_date){
			$pay_date = strtotime($pay_date);
		}
		$price = $app->get('total_fee','float');
		$trade_status = $app->get('trade_status');
		if(!$trade_status){
			$trade_status = 'TRADE_FINISHED';
		}
		$tmp = array('WAIT_SELLER_SEND_GOODS','WAIT_BUYER_CONFIRM_GOODS','TRADE_FINISHED','TRADE_SUCCESS');
		if(in_array($trade_status,$tmp)){
			//更新扩展数据
			$alipay = array();
			$alipay['log_id'] = $this->order['id'];
			$alipay['buyer_email'] = $app->get('buyer_email');
			$alipay['buyer_id'] = $app->get('buyer_id');
			$alipay['out_trade _no'] = $app->get('out_trade _no');
			$alipay['seller_email'] = $app->get('seller_email');
			$alipay['seller_id'] = $app->get('seller_id');
			$alipay['trade_no'] = $app->get('trade_no');
			$alipay['trade_status'] = $app->get('trade_status');
			$alipay['notify_id'] = $app->get('notify_id');
			$alipay['notify_time'] = $app->get('notify_time');
			$alipay['notify_type'] = $app->get('notify_type');
			$alipay['total_fee'] = $price;
			$alipay['body'] = $app->get('body');
			$alipay['agent_user_id'] = $app->get('agent_user_id');
			$alipay['extra_common_param'] = $app->get('extra_common_param');
			$alipay['subject'] = $app->get('subject');
			//$app->db->insert_array($alipay,'payment_alipay');
			//更新支付记录
			$array = array('status'=>1,'ext'=>serialize($alipay));
			$app->db->update_array($array,'payment_log',array('id'=>$this->order['id']));
			//如果当前支付操作是订单
			if($this->order['type'] == 'order'){
				$order = $app->model('order')->get_one_from_sn($this->order['sn']);
				if($order){
					$app->model('order')->update_order_status($order['id'],'paid');
					$param = 'id='.$order['id']."&status=paid";
					$app->model('task')->add_once('order',$param);
					$note = P_Lang('订单支付完成，编号：{sn}',array('sn'=>$order['sn']));
					$log = array('order_id'=>$order['id'],'addtime'=>$app->time,'who'=>$app->user['user'],'note'=>$note);
					$app->model('order')->log_save($log);
					//增加order_payment
					$array = array('order_id'=>$order['id'],'payment_id'=>$this->param['id']);
					$array['title'] = $this->param['title'];
					$array['price'] = $price;
					$array['dateline'] = $app->time;
					$array['ext'] = serialize($alipay);
					$order_payment = $app->model('order')->order_payment($order['id']);
					if(!$order_payment){
						$app->model('order')->save_payment($array);
					}else{
						$app->model('order')->save_payment($array,$order_payment['id']);
					}
				}
			}
		}
		return true;
	}
}
?>