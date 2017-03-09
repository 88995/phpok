<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->assign("title","修改个人密码"); ?><?php $this->output("head","file"); ?>
<script type="text/javascript">
$(document).ready(function(){
	$("#userinfo_password").submit(function(){
		$(this).ajaxSubmit({
			'type':'post',
			'dataType':'json',
			'url':api_url('usercp','passwd'),
			'success':function(rs){
				if(rs.status == 'ok'){
					$.dialog.alert("您的密码更新成功",function(){
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
			<h3>密码修改</h3>
			<form method="post" id="userinfo_password">
			<div class="table">
				<div class="l"><span class="red">*</span> 旧密码：</div>
				<input type="password" name="oldpass" id="oldpass" value="" class="input" />
			</div>
			<div class="table">
				<div class="l"><span class="red">*</span> 新密码：</div>
				<input type="password" name="newpass" id="newpass" value="" class="input" />
			</div>
			<div class="table">
				<div class="l"><span class="red">*</span> 确认新密码：</div>
				<input type="password" name="chkpass" id="chkpass" value="" class="input" />
			</div>

			<div class="table">
				<div class="l">&nbsp;</div>
				<input type="submit" id="phpok_submit" value="提 交" class="button blue">
			</div>
			</form>
		</div>
		<div class="pfw mbottom10">
			<h3>友情说明</h3>
			<ul class="tip">
				<li>密码长度不能小于6位数</li>
				<li>为保证您数据的安全，密码建议您使用：字母+数字+大小写混合</li>
			</ul>
		</div>
	</div>
	<div class="clear"></div>
</div>

<?php $this->output("foot","file"); ?>