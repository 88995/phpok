<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $list = phpok('news','psize=15');?>
<?php if($list['total']){ ?>
<div class="pfw" id="hot_products">
	<h3>最新资讯<a href="<?php echo $list['project']['url'];?>" class="more">更多</a></h3>
	<ul class="artlist">
		<?php $list_rslist_id["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$list_rslist_id["total"] = count($list['rslist']);$list_rslist_id["index"] = -1;foreach($list['rslist'] AS $key=>$value){ $list_rslist_id["num"]++;$list_rslist_id["index"]++; ?>
		<li><a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>"><?php echo $value['title'];?></a></li>
		<?php } ?>
	</ul>
</div>
<?php } ?>
