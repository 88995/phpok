<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $title = $rs['title'].' - '.$page_rs['title'];?>
<?php $this->assign("title",$title); ?><?php $this->assign("menutitle",$page_rs['title']); ?><?php $this->output("head","file"); ?>
<div class="main about">
	<?php if($page_rs['banner']){ ?>
	<div class="banner"><img src="<?php echo $page_rs['banner']['filename'];?>" /></div>
	<?php } ?>
	<ol class="breadcrumb">
		<li>您现在的位置：<a href="<?php echo $sys['url'];?>" title="<?php echo $config['title'];?>">首页</a></li>
		<li><?php echo $page_rs['title'];?></li>
		<li><?php echo $rs['title'];?></li>
	</ol>
	<div class="left">
		<div class="pfw mb10">
			<h3><?php echo $page_rs['title'];?></h3>
			<ul class="catelist">
				<?php $list=phpok('_arclist',array('pid'=>$page_rs['id'],'psize'=>"100",'fields'=>"id"));?>
				<?php $list_rslist_id["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$list_rslist_id["total"] = count($list['rslist']);$list_rslist_id["index"] = -1;foreach($list['rslist'] AS $key=>$value){ $list_rslist_id["num"]++;$list_rslist_id["index"]++; ?>
				<li<?php if($rs['id'] == $value['id']){ ?> class="on"<?php } ?>><a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>"><?php echo $value['title'];?></a></li>
				<?php } ?>
			</ul>
		</div>
		<?php $this->output("block/contact","file"); ?>
	</div>
	<div class="right">
		<div class="content"><?php echo $rs['content'];?></div>
	</div>
</div>
<?php $this->output("foot","file"); ?>