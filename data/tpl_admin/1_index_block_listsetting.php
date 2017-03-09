<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><div class="title">
	<span class="maintain"><?php echo P_Lang("内容管理");?></span>
</div>
<div class="box_item">
	<ul>
		<?php $list_rslist_id["num"] = 0;$list_rslist=is_array($list_rslist) ? $list_rslist : array();$list_rslist_id["total"] = count($list_rslist);$list_rslist_id["index"] = -1;foreach($list_rslist AS $key=>$value){ $list_rslist_id["num"]++;$list_rslist_id["index"]++; ?>
		<li pid="<?php echo $value['id'];?>"><a title="<?php echo $value['title'];?>" href="javascript:$.win('<?php echo $value['title'];?>','<?php echo $value['url'];?>');void(0);">
			<div class="top_img"><img src="<?php echo $value['ico'] ? $value['ico'] : 'images/ico/default.png';?>" class="ie6png" alt="<?php echo $value['title'];?>" width="48" height="48" /></div>
			<div class="name"><?php echo $value['nick_title'] ? $value['nick_title'] : $value['title'];?></div></a>
		</li>
		<?php } ?>
	</ul>
</div>