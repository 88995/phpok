<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $list = phpok('hot_products');?>
<?php if($list['total']){ ?>
<style type="text/css">
div.pfw ul.imglist li{padding:0; float:none;margin:0 10px 15px 10px;}
</style>
<div class="pfw" id="hot_products">
	<h3>热门产品<a href="<?php echo $list['project']['url'];?>" class="more">更多</a></h3>
	<div style="margin-top:10px">
	<ul class="imglist">
		<?php $list_rslist_id["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$list_rslist_id["total"] = count($list['rslist']);$list_rslist_id["index"] = -1;foreach($list['rslist'] AS $key=>$value){ $list_rslist_id["num"]++;$list_rslist_id["index"]++; ?>
		<li><a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>"><img src="<?php echo $value['thumb']['ico'];?>" /><br /><?php echo $value['title'];?></a></li>
		<?php } ?>
	</ul>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#hot_products").slide({
		'mainCell':'ul.imglist',
		'autoPlay':true,
		'effect':'topLoop',
		'vis':3
	});
});
</script>
<?php } ?>