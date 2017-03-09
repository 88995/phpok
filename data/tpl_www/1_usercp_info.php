<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->assign("title","修改个人资料"); ?><?php $this->output("head","file"); ?>
<script type="text/javascript">
$(document).ready(function(){
	$("#userinfo_submit").submit(function(){
		$(this).ajaxSubmit({
			type:'post',
			url: api_url('usercp','info'),
			dataType:'json',
			success: function(rs){
				if(rs.status == 'ok'){
					$.dialog.alert("您的信息更新成功",function(){
						$.phpok.reload();
					},'succeed');
				}else{
					$.dialog.alert(rs.content);
					return false;
				}
			}
		});
		return false;
	});
});
</script>
<div class="cp">
	<div class="left"><?php $this->output("block_usercp","file"); ?></div>
	<div class="right">
		<div class="pfw mbottom10">
			<h3>修改个人资料</h3>
			<form method="post" id="userinfo_submit">
			<div class="table">
				<input type="hidden" name="avatar" id="avatar" value="<?php echo $rs['avatar'];?>" />
				<div class="l">&nbsp;</div>
				<img src="<?php echo $rs['avatar'] ? $rs['avatar'] : 'tpl/www/images/avatar_huge.gif';?>" width="80px" border="0" />
			</div>
			<?php if($rs['email']){ ?>
			<div class="table">
				<div class="l">邮箱：</div>
				<?php echo $rs['email'];?>
			</div>
			<?php } ?>
			<?php if($rs['mobile']){ ?>
			
			<div class="table">
				<div class="l">手机：</div>
				<?php echo $rs['mobile'];?>
			</div>
			<?php } ?>
			<?php $extlist_id["num"] = 0;$extlist=is_array($extlist) ? $extlist : array();$extlist_id["total"] = count($extlist);$extlist_id["index"] = -1;foreach($extlist AS $key=>$value){ $extlist_id["num"]++;$extlist_id["index"]++; ?>
			<div class="table">
				<div class="l"><?php echo $value['title'];?>：</div>
				<?php echo $value['html'];?>
			</div>
			<?php } ?>
			<div class="table">
				<div class="l">&nbsp;</div>
				<input type="submit" value="修改资料" class="button blue" />
			</div>
			</form>
		</div>
	</div>
	<div class="clear"></div>
</div>
<?php $this->output("foot","file"); ?>