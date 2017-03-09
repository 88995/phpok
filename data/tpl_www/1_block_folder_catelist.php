<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><div class="pfw mb10">
	<h3><?php echo $title;?></h3>
	<?php $list=phpok('_catelist',array('pid'=>$pid));?>
	<dl class="catelist">
		<?php $tmpid["num"] = 0;$list['tree']=is_array($list['tree']) ? $list['tree'] : array();$tmpid["total"] = count($list['tree']);$tmpid["index"] = -1;foreach($list['tree'] AS $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
		<dt<?php if($value['id'] == $cid){ ?> class="on"<?php } ?>><a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>"><?php echo $value['title'];?></a></dt>
		<?php $tmpid2["num"] = 0;$value['sublist']=is_array($value['sublist']) ? $value['sublist'] : array();$tmpid2["total"] = count($value['sublist']);$tmpid2["index"] = -1;foreach($value['sublist'] AS $k=>$v){ $tmpid2["num"]++;$tmpid2["index"]++; ?>
		<dd<?php if($v['id'] == $cid){ ?> class="on"<?php } ?>><a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>"><?php echo $v['title'];?></a></dd>
		<?php } ?>
		<?php } ?>
	</dl>
</div>