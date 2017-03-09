<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->assign("menutitle","网站首页"); ?><?php $this->assign("title","会员登录"); ?><?php $this->output("head","file"); ?>
<script type="text/javascript">
var open_vcode = '<?php echo $sys['is_vcode'] && function_exists("imagecreate") ? 1 : 0;?>';
function check_input()
{
	var user = $("input[name=user]").val();
	if(!user){
		$.dialog.alert('账号不能为空','','error');
		return false;
	}
	var pass = $("input[name=pass]").val();
	if(!pass){
		$.dialog.alert('密码不能为空','','error');
		return false;
	}
	if(open_vcode == '1'){
		var chkcode = $("#_chkcode").val();
		if(!chkcode){
			$.dialog.alert('验证码不能为空','','error');
			return false;
		}
	}
	return true;
}
</script>
<div class="login-reg">
	<dl class="box">
		<dt>登录</dt>
		<form method="post" id="login-form" onsubmit="return check_input()" action="<?php echo phpok_url(array('ctrl'=>'login','func'=>'ok'));?>">
		<input type="hidden" name="_back" value="<?php echo $_back;?>" />
	    <input type="hidden" name="post_date" id="post_date" value="<?php echo date('Y-m-d H:i:s',$sys['time']);?>" />
	    <input type="hidden" name="pdip" id="pdip" value="<?php echo phpok_ip();?>" />
		<dd><label>账号：</label><input class="input" type="text" name="user" /><div class="clear"></div></dd>
		<dd><label>密码：</label><input class="input" type="password" name="pass" /><div class="clear"></div></dd>
		<?php if($sys['is_vcode'] && function_exists("imagecreate")){ ?>
		<dd><label>验证码：</label><input class="vcode"  type="text" name="_chkcode" id="_chkcode" /><img src="" border="0" align="absmiddle" id="vcode" class="hand" /><div class="clear"></div></dd>
		<script type="text/javascript">
		$(document).ready(function(){
			$("#vcode").phpok_vcode();
			$("#vcode").click(function(){
				$(this).phpok_vcode();
			});
		});
		</script>
		<?php } ?>
		<dd class="submit"><input class="button blue" type="submit" value="登录" name=""></dd>
		</form>
	</dl>
	<dl class="box note">
		<dt>说明</dt>
		<?php if($logintype['email']){ ?><dd>邮件登录，<a href="<?php echo phpok_url(array('ctrl'=>'login','type'=>'email'));?>" title="会员邮件登录">请点这里</a></dd><?php } ?>
		<?php if($logintype['sms']){ ?><dd>手机短信登录，<a href="<?php echo phpok_url(array('ctrl'=>'login','type'=>'sms'));?>" title="手机短信登录">请点这里</a></dd><?php } ?>
		<?php if($logintype['sms'] || $logintype['email']){ ?><dd>如果您忘记密码，您可以点这里<a href="<?php echo phpok_url(array('ctrl'=>'login','func'=>'getpass'));?>" title="找回密码功能">找回密码？</a></dd><?php } ?>
		<dd>您还不是我们的会员，请点这里<a href="<?php echo phpok_url(array('ctrl'=>'register'));?>" title="注册会员">注册</a></dd>
		
		<dd>&nbsp;</dd>
	</dl>
	<div class="clear"></div>
</div>
<?php $this->output("foot","file"); ?>