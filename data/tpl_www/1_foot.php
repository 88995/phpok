<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><div class="foot">
	<div class="copyright">
		<?php $list = phpok('footnav');?>
		<?php $list_id["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$list_id["total"] = count($list['rslist']);$list_id["index"] = -1;foreach($list['rslist'] AS $key=>$value){ $list_id["num"]++;$list_id["index"]++; ?>
		<a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>" target="<?php echo $value['target'];?>"><?php echo $value['title'];?></a>
		<?php if($list_id['num'] == $list_id['total']){ ?><br /><?php } else { ?> | <?php } ?>
		<?php } ?>
		<?php echo $config['copyright']['content'];?>
		<div class="debug"><?php echo debug_time('1','1','1','1');?></div>
	</div>
</div>
<?php $list = phpok('kefu');?>
<?php if($list['project'] && $list['rslist']){ ?>
<div id="right-float-box" class="im_floatonline">
	<div class="float-box-content">
		<div class="toptitle"><?php echo $list['project']['title'];?></div>
		<div class="addlist">
			<ul>
				<?php $list_rslist_id["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$list_rslist_id["total"] = count($list['rslist']);$list_rslist_id["index"] = -1;foreach($list['rslist'] AS $key=>$value){ $list_rslist_id["num"]++;$list_rslist_id["index"]++; ?>
				<li><?php echo $value['title'];?><br /><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $value['qq'];?>&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo $value['qq'];?>:51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a></li>
				<?php } ?>
				<?php if($list['project']['barcode']){ ?>
				<li><img src="<?php echo $list['project']['barcode']['filename'];?>" width="80px" alt="<?php echo $list['project']['title'];?>" /></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>
<?php } ?>
<script type="text/javascript">
$(document).ready(function(){
	//window.setTimeout(function(){
	//	$.phpok.json(api_url('task'),function(rs){return true;});
	//}, 2000);
	//更新购物车产品数量
	$.cart.total();
});
</script>
<?php echo $app->plugin_html_ap("phpokbody");?></body>
</html>
