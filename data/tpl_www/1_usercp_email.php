<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->assign("title","修改邮箱"); ?><?php $this->output("head","file"); ?>
<script type="text/javascript">
$(document).ready(function(){
	$("#userinfo_email").submit(function(){
		$(this).ajaxSubmit({
			'type':'post',
			'dataType':'json',
			'url':api_url('usercp','email'),
			'success':function(rs){
				if(rs.status == 'ok'){
					$.dialog.alert("您的邮箱更新成功",function(){
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
<?php if($sendemail){ ?>
<script type="text/javascript">
var maxtime = 60;
var email_send_lock = false;
var win_time_out;
function update_send_email_loading()
{
	maxtime--;
	if(maxtime < 1){
		$("#email_send_status").val('发送验证码');
		email_send_lock = false;
		maxtime = 60;
		window.clearInterval(win_time_out);
		return true;
	}
	var tips = "验证码已发送("+maxtime+")";
	$("#email_send_status").val(tips);
}

function send_email()
{
	if(email_send_lock){
		$.dialog.alert('验证码已发送，请一分钟后再执行');
		return false;
	}
	var url = api_url('usercp','emailcode');
	var email = $("#email").val();
	if(!email){
		$.dialog.alert('邮箱不能为空');
		return false;
	}
	url += "&email="+email;
	$.dialog.tips("正在执行中，请稍候…");
	update_send_email_loading();
	$.ajax({
		'url':url,
		'dataType':'json',
		'cache':false,
		'async':true,
		'beforeSend': function (XMLHttpRequest){
			XMLHttpRequest.setRequestHeader("request_type","ajax");
		},
		'success':function(rs){
			if(rs.status == 'ok'){
				maxtime = 60;
				email_send_lock = true;
				win_time_out = setInterval("update_send_email_loading()",1000);
			}else{
				$.dialog.alert(rs.content);
				$("#email_send_status").val('发送验证码');
			}
		}
	});
}
</script>
<?php } ?>
<div class="cp">
	<div class="left"><?php $this->output("block_usercp","file"); ?></div>
	<div class="right">
		<div class="pfw mbottom10">
			<h3>邮箱修改</h3>
			<form method="post" id="userinfo_email">
			<div class="table">
				<div class="l"><span class="red">*</span> 会员密码：</div>
				<input type="password" name="pass" id="pass" value="" class="input" />
			</div>
			<div class="table">
				<div class="l"><span class="red">*</span> 原邮箱：</div>
				<input type="text" name="oldemail" id="oldemail" value="<?php echo $rs['email'];?>" class="input" disabled />
			</div>
			<div class="table">
				<div class="l"><span class="red">*</span> 新邮箱：</div>
				<input type="text" name="email" id="email" value="" class="input" />
				<?php if($sendemail){ ?>
				<input type="button" value="发送验证码" onclick="send_email()" class="button blue" id="email_send_status" />
				<?php } ?>
			</div>
			<?php if($sendemail){ ?>
			<div class="table">
				<div class="l"><span class="red">*</span> 验证码：</div>
				<input type="text" name="chkcode" class="input" />
			</div>
			<?php } ?>
			<div class="table">
				<div class="l">&nbsp;</div>
				<input type="submit" id="phpok_submit" value="提 交" class="button blue">
			</div>
			</form>
		</div>
		<div class="pfw mbottom10">
			<h3>友情说明</h3>
			<ul class="tip">
				<li>邮箱修改需要您提供会员密码认证</li>
				<li>请确填写有效的邮箱，国内用户建议使用126邮箱或QQ邮箱</li>
			</ul>
		</div>
	</div>
	<div class="clear"></div>
</div>

<?php $this->output("foot","file"); ?>