<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->assign("title","个人中心"); ?><?php $this->output("head","file"); ?>
<div class="cp">
	<div class="left"><?php $this->output("block_usercp","file"); ?></div>
	<div class="right">
		<div class="pfw mbottom10">
			<h3>会员中心</h3>
			<div class="cp_avatar">
				<img src="<?php echo $rs['avatar'] ? $rs['avatar'] : 'tpl/www/images/avatar_huge.gif';?>">
			</div>
			<div class="cp_info">
				<ul>
					<li><strong>账号：</strong><?php echo $rs['user'];?></li>
					<li><strong>邮箱：</strong><?php echo $rs['email'];?></li>
					<?php $tmpid["num"] = 0;$user['wealth']=is_array($user['wealth']) ? $user['wealth'] : array();$tmpid["total"] = count($user['wealth']);$tmpid["index"] = -1;foreach($user['wealth'] AS $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
					<li><strong><?php echo $value['title'];?>：</strong><?php echo $value['val'];?><?php echo $value['unit'];?></li>
					<?php } ?>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>
</div>

<?php $this->output("foot","file"); ?>