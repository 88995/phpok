<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->assign("title",$page_rs['title']); ?><?php $this->assign("menutitle",$page_rs['title']); ?><?php $this->output("head","file"); ?>
<?php if($page_rs['banner']){ ?>
<div class="page_banner"><img src="<?php echo $page_rs['banner']['filename'];?>" width="980" alt="<?php echo $title;?>" /></div>
<?php } ?>

<div class="wrap bbs_index">
	<?php $list=phpok('_catelist',array('pid'=>$page_rs['id'],'catelist_ext'=>"1"));?>
	<?php $list_sublist_id["num"] = 0;$list['sublist']=is_array($list['sublist']) ? $list['sublist'] : array();$list_sublist_id["total"] = count($list['sublist']);$list_sublist_id["index"] = -1;foreach($list['sublist'] AS $key=>$value){ $list_sublist_id["num"]++;$list_sublist_id["index"]++; ?>
	<div class="bd">
		<a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>"><h3><?php echo $value['title'];?></h3></a>
		<div class="info">
			<table width="100%">
			<tr>
				<td class="thumb"><img src="<?php echo $value['thumb'] ? $value['thumb']['filename'] : 'tpl/www/images/bbs.png';?>"></td>
				<td class="note">
					<?php if($value['note']){ ?><?php echo nl2br($value['note']);?><?php } else { ?>暂无摘要<?php } ?>
				</td>
				<td class="total">
					<?php $total = phpok('_total','pid='.$page_rs['id'].'&cateid='.$value['id']);?>
					<?php echo $total;?>
				</td>
				<td class="last">
					<?php $list=phpok('_arclist',array('pid'=>$page_rs['id'],'cateid'=>$value['id'],'psize'=>"3"));?>
					<?php $list_rslist_id["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$list_rslist_id["total"] = count($list['rslist']);$list_rslist_id["index"] = -1;foreach($list['rslist'] AS $k=>$v){ $list_rslist_id["num"]++;$list_rslist_id["index"]++; ?>
					<div><a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>"><?php echo phpok_cut($v['title'],'70','…');?></a>
					<?php } ?>
					<?php if(!$list['rslist']){ ?>无主题<?php } ?>
				</td>
			</tr>
			</table>
		</div>
	</div>
	<?php } ?>
</div>

<?php $this->output("foot","file"); ?>