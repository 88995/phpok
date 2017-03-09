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
		<?php $this->output("block/hot_article","file"); ?>
	</div>
	<div class="right">
		<ul class="download">
			<?php $rslist_id["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$rslist_id["total"] = count($rslist);$rslist_id["index"] = -1;foreach($rslist AS $key=>$value){ $rslist_id["num"]++;$rslist_id["index"]++; ?>
			<li>
				<div class="softInfo">
					<p class="title"><a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>"><?php echo $value['title'];?></a></p>
					<p class="desc"><?php echo $value['note'];?></p>
					<p class="info">大小：<font class="infoVal"><?php echo $value['fsize'];?></font>&nbsp;&nbsp;更新日期：<font class="infoVal"><?php echo date('Y-m-d',$value['dateline']);?></font></p>
				</div>
				<?php if($value['dfile']){ ?>
				<div class="downloadbtn"><a href="<?php echo phpok_url(array('ctrl'=>'download','id'=>$value['dfile']['id']));?>" title="<?php echo $value['file']['title'];?>"></a></div>
				<?php } ?>
				<div class="clear"></div>
			</li>
			<?php } ?>
		</ul>
		<?php $this->output("block_pagelist","file"); ?>
	</div>
</div>
<?php $this->output("foot","file"); ?>