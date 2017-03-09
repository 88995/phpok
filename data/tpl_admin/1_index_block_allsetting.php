<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><script type="text/javascript">
function all_refresh()
{
	var url = get_url('index','all_setting');
	var rs = $.phpok.json(url);
	if(rs.status == 'ok')
	{
		$("#all_setting").html(rs.content).show();
	}
	else
	{
		$("#all_setting").html('').hide();
	}
}
</script>
<div class="box_item">
	<ul>
		<?php if($all_popedom['site']){ ?>
		<li><a title="<?php echo P_Lang("配置网站信息，包括网址域名，布全局关键字等");?>" href="javascript:$.win('<?php echo P_Lang("网站信息");?>','<?php echo phpok_url(array('ctrl'=>'all','func'=>'setting'));?>');void(0);">
			<div class="top_img"><img src="images/ico/setting.png" alt="<?php echo P_Lang("网站信息");?>" class="ie6png" width="48" height="48" /></div>
			<div class="name"><?php echo P_Lang("网站信息");?></div></a>
		</li>
		<?php } ?>
		<?php if($all_popedom['domain']){ ?>
		<li><a title="<?php echo P_Lang("网站可以绑定的域名");?>" href="javascript:$.win('<?php echo P_Lang("网站域名");?>','<?php echo phpok_url(array('ctrl'=>'all','func'=>'domain'));?>');void(0);">
			<div class="top_img"><img src="images/ico/alias.png" alt="<?php echo P_Lang("网站域名");?>" class="ie6png" width="48" height="48" /></div>
			<div class="name"><?php echo P_Lang("网站域名");?></div></a>
		</li>
		<?php } ?>
		<?php if($site_popedom['order'] && $config['biz_status']){ ?>
		<li><a title="<?php echo P_Lang("订单常规配置");?>" href="javascript:$.win('<?php echo P_Lang("订单常规配置");?>','<?php echo phpok_url(array('ctrl'=>'site','func'=>'order_status'));?>');void(0);">
			<div class="top_img"><img src="images/ico/shopping_setting.png" alt="<?php echo P_Lang("订单常规配置");?>" class="ie6png" width="48" height="48" /></div>
			<div class="name"><?php echo P_Lang("订单常规配置");?></div></a>
		</li>
		<?php } ?>
		<?php if($all_popedom['gset'] || $all_popedom['set']){ ?>
		<?php $all_rslist_id["num"] = 0;$all_rslist=is_array($all_rslist) ? $all_rslist : array();$all_rslist_id["total"] = count($all_rslist);$all_rslist_id["index"] = -1;foreach($all_rslist AS $key=>$value){ $all_rslist_id["num"]++;$all_rslist_id["index"]++; ?>
		<li><a title="<?php echo $value['title'];?>" href="javascript:$.win('<?php echo $value['title'];?>','<?php echo phpok_url(array('ctrl'=>'all','func'=>'set','id'=>$value['id']));?>');void(0);">
			<div class="top_img"><img src="<?php echo $value['ico'];?>" class="ie6png" alt="<?php echo $value['title'];?>" width="48" height="48" /></div>
			<div class="name"><?php echo $value['title'];?></div></a>
		</li>
		<?php } ?>
		<li class="plus" onclick="$.win('<?php echo P_Lang("全局内容");?>','<?php echo phpok_url(array('ctrl'=>'all','func'=>'gset'));?>')"></li>
		<?php } ?>
	</ul>
</div>