<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->output("head","file"); ?>
<script type="text/javascript">
$(document).ready(function(){
	$("#project li").each(function(i){
		$(this).click(function(){
			var url = $(this).attr("href");
			if(url){
				$.phpok.go(url);
			}else{
				alert("未指定动作！");
				return false;
			}
		});
	});
});
</script>
<div class="tips clearfix">
	<?php if($popedom['gset']){ ?>
	<div class="action"><a href="<?php echo admin_url('all','gset');?>">添加</a></div>
	<?php } ?>
	您当前的位置：全局维护，调试代码 <span class="red">{</span>debug $config<span class="red">}</span>，此处信息更新后，需要手动清空缓存后才能生效
</div>
<ul class="project" id="project">
	<?php if($popedom['site']){ ?>
	<li title="配置网站信息，包括网址域名，布全局关键字等" href="<?php echo admin_url('all','setting');?>">
		<div class="img"><img src="images/ico/setting.png" class="ie6png"/></div>
		<div class="txt">网站信息</div>
	</li>
	<?php } ?>
	<?php if($popedom['domain']){ ?>
	<li title="网站可以绑定的域名" href="<?php echo admin_url('all','domain');?>">
		<div class="img"><img src="images/ico/alias.png" class="ie6png" /></div>
		<div class="txt">网站域名</div>
	</li>
	<?php } ?>
	<?php if($rs['email_server'] && $rs['email_account'] && $rs['email_pass']){ ?>
	<li title="测试Email邮件发送" href="<?php echo admin_url('all','email');?>">
		<div class="img"><img src="images/ico/email.png" class="ie6png" /></div>
		<div class="txt">测试邮件</div>
	</li>
	<?php } ?>
	<?php if($popedom['gset'] || $popedom['set']){ ?>
	<?php $rslist_id["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$rslist_id["total"] = count($rslist);$rslist_id["index"] = -1;foreach($rslist AS $key=>$value){ $rslist_id["num"]++;$rslist_id["index"]++; ?>
	<li title="<?php echo $value['title'];?>" href="<?php echo admin_url('all','set');?>&id=<?php echo $value['id'];?>">
		<div class="img"><img src="<?php echo $value['ico'];?>" class="ie6png" /></div>
		<div class="txt"><?php echo $value['title'];?></div>
	</li>
	<?php } ?>
	<?php } ?>
</ul>
<div class="clear"></div>
<?php $this->output("foot","file"); ?>