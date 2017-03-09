<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $title= $cate_rs ? $cate_rs['title'].' - '.$page_rs['title'] : $page_rs['title'];?>
<?php $this->assign("title",$title); ?><?php $this->assign("menutitle",$page_rs['title']); ?><?php $this->output("head","file"); ?>
<div class="main">
	<?php if($page_rs['banner']){ ?>
	<div class="banner"><img src="<?php echo $page_rs['banner']['filename'];?>" width="980" alt="<?php echo $title;?>" /></div>
	<?php } ?>
	<ol class="breadcrumb">
		<li>您现在的位置：<a href="<?php echo $sys['url'];?>" title="<?php echo $config['title'];?>">首页</a></li>
		<li><a href="<?php echo $page_rs['url'];?>" title="<?php echo $page_rs['title'];?>"><?php echo $page_rs['title'];?></a></li>
		<?php if($cate_rs){ ?>
		<li><a href="<?php echo $cate_rs['url'];?>" title="<?php echo $cate_rs['title'];?>"><?php echo $cate_rs['title'];?></a></li>
		<?php } ?>
	</ol>
	<div class="left">
		<?php $this->assign("pid",$page_rs['id']); ?><?php $this->assign("cid",$cate_rs['id']); ?><?php $this->assign("title",$page_rs['title']); ?><?php $this->output("block/catelist","file"); ?>
		<?php $this->output("block/contact","file"); ?>
		<?php $this->output("block/hot_products","file"); ?>
	</div>
	<div class="right">
		<ul class="news_list">
			<?php $rslist_id["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$rslist_id["total"] = count($rslist);$rslist_id["index"] = -1;foreach($rslist AS $key=>$value){ $rslist_id["num"]++;$rslist_id["index"]++; ?>
			<li>
				<?php if($value['thumb']){ ?>
				<span class="n-img"><a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>"><img src="<?php echo $value['thumb']['gd']['thumb'];?>" alt="<?php echo $value['title'];?>" /></a></span>
				<?php } ?>
				<h3><a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>"><?php echo $value['title'];?></a></h3>
				<div class="n-txt">
					<?php echo $value['note'] ? phpok_cut($value['note'],225,'…') : phpok_cut($value['content'],225,'…');?>
					<span class="more">[<a href="<?php echo $value['url'];?>" title="查看<?php echo $value['title'];?>详细信息">查看更多</a>]</span>
				</div>
			</li>
			<?php } ?>
		</ul>
		<?php $this->output("block_pagelist","file"); ?>
	</div>
</div>

<?php $this->output("foot","file"); ?>