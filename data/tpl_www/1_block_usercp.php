<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><div class="pfw mbottom10">
	<h3>会员功能</h3>
	<ul class="cp">
		<li class="control"><a href="<?php echo phpok_url(array('ctrl'=>'usercp'));?>" title="个人中心">个人中心</a></li>
		<li<?php if($sys['func'] == 'info'){ ?> class="hover"<?php } ?>><a href="<?php echo phpok_url(array('ctrl'=>'usercp','func'=>'info'));?>" title="个人资料">个人资料</a></li>
		<li<?php if($sys['func'] == 'avatar'){ ?> class="hover"<?php } ?>><a href="<?php echo phpok_url(array('ctrl'=>'usercp','func'=>'avatar'));?>" title="修改头像">修改头像</a></li>
		<li<?php if($sys['func'] == 'passwd'){ ?> class="hover"<?php } ?>><a href="<?php echo phpok_url(array('ctrl'=>'usercp','func'=>'passwd'));?>" title="修改密码">修改密码</a></li>
		<li<?php if($sys['func'] == 'mobile'){ ?> class="hover"<?php } ?>><a href="<?php echo phpok_url(array('ctrl'=>'usercp','func'=>'mobile'));?>" title="修改手机">修改手机</a></li>
		<li<?php if($sys['func'] == 'email'){ ?> class="hover"<?php } ?>><a href="<?php echo phpok_url(array('ctrl'=>'usercp','func'=>'email'));?>" title="修改邮箱">修改邮箱</a></li>
		<li<?php if($sys['ctrl'] == 'order'){ ?> class="hover"<?php } ?>><a href="<?php echo phpok_url(array('ctrl'=>'order'));?>" title="我的订单">我的订单</a></li>
		<li<?php if($sys['ctrl'] == 'payment' && $sys['func'] == 'index'){ ?> class="hover"<?php } ?>><a href="<?php echo phpok_url(array('ctrl'=>'payment'));?>" title="在线充值">在线充值</a></li>
		<li class="article">我的…</li>
		<!--li<?php if($sys['func'] == 'fav'){ ?> class="hover"<?php } ?>><a href="<?php echo phpok_url(array('ctrl'=>'usercp','func'=>'fav'));?>" title="收藏夹">收藏夹</a></li-->
		<li<?php if($sys['func'] == 'wealth'){ ?> class="hover"<?php } ?>><a href="<?php echo phpok_url(array('ctrl'=>'usercp','func'=>'wealth'));?>" title="财富">财富</a></li>
		<!--li<?php if($sys['func'] == 'introducer'){ ?> class="hover"<?php } ?>><a href="<?php echo phpok_url(array('ctrl'=>'usercp','func'=>'introducer'));?>" title="推荐">推荐</a></li-->
		<?php $list = usercp_project();?>
		<?php $list_id["num"] = 0;$list=is_array($list) ? $list : array();$list_id["total"] = count($list);$list_id["index"] = -1;foreach($list AS $key=>$value){ $list_id["num"]++;$list_id["index"]++; ?>
		<li<?php if($sys['func'] == 'list' && $id == $value['identifier']){ ?> class="hover"<?php } ?>><a href="<?php echo phpok_url(array('ctrl'=>'usercp','func'=>'list','id'=>$value['identifier']));?>" title="<?php echo $value['title'];?>"><?php echo $value['title'];?></a></li>
		<?php } ?>
		
		<li class="logout">会员退出</li>
		<li onclick="logout('<?php echo $session['user_name'];?>')" style="cursor:pointer;">会员退出</li>
		
	</ul>
	<div class="clear"></div>
</div>
