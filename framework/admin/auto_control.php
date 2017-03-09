<?php
/***********************************************************
	Filename: {phpok}/admin/auto_control.php
	Note	: 自动读写表单处理（数据表qinggan_temp）
	Version : 4.0
	Web		: www.phpok.com
	Author  : qinggan <qinggan@188.com>
	Update  : 2012-12-10 00:01
***********************************************************/
if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");}
class auto_control extends phpok_control
{
	public function __construct()
	{
		parent::control();
	}

	# 存储表单
	public function index_f()
	{
		$type = $this->get("__type");
		if(!$type) $type = "list";
		$str = $_POST ? serialize($_POST) : "";
		if(!$str){
			$this->json(P_Lang('没有自动存储的表单数据'),true);
		}
		$rs = $this->model('temp')->chk($type,$_SESSION["admin_id"]);
		if($rs){
			$id = $rs["id"];
			unset($rs["id"]);
			$rs["content"] = $str;
		}else{
			$rs["content"] = $str;
			$rs["tbl"] = $type;
			$rs["admin_id"] = $_SESSION["admin_id"];
		}
		$this->model('temp')->save($rs,$id);
		$this->json(P_Lang('数据存储成功'),true);
	}

	public function read_f()
	{
		$type = $this->get("__type");
		if(!$type) $type = "list";
		$rs = $this->model('temp')->chk($type,$_SESSION["admin_id"]);
		if($rs){
			$content = unserialize($rs["content"]);
			$this->json($content,true);
		}else{
			$this->json("没有数据");
		}
	}

}
?>