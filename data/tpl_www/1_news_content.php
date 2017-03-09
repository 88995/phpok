<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $title = $rs['title'].' - '.$cate_rs['title'].' - '.$page_rs['title'];?>
<?php $this->assign("title",$title); ?><?php $this->assign("menutitle",$page_rs['title']); ?><?php $this->output("head","file"); ?>
<div class="main">
	<?php if($page_rs['banner']){ ?>
	<div class="banner"><img src="<?php echo $page_rs['banner']['filename'];?>" width="980" alt="<?php echo $title;?>" /></div>
	<?php } ?>
	<ol class="breadcrumb">
		<li>您现在的位置：<a href="<?php echo $sys['url'];?>" title="<?php echo $config['title'];?>">首页</a></li>
		<li><a href="<?php echo $page_rs['url'];?>" title="<?php echo $page_rs['title'];?>"><?php echo $page_rs['title'];?></a></li>
		<?php if($cate_parent_rs){ ?>
		<li><a href="<?php echo $cate_parent_rs['url'];?>" title="<?php echo $cate_parent_rs['title'];?>"><?php echo $cate_parent_rs['title'];?></a></li>
		<?php } ?>
		<?php if($cate_rs){ ?>
		<li><a href="<?php echo $cate_rs['url'];?>" title="<?php echo $cate_rs['title'];?>"><?php echo $cate_rs['title'];?></a></li>
		<?php } ?>
		<li><?php echo $rs['title'];?></li>
	</ol>
	<div class="left">
		<?php $this->assign("pid",$page_rs['id']); ?><?php $this->assign("cid",$cate_rs['id']); ?><?php $this->assign("title",$page_rs['title']); ?><?php $this->output("block/catelist","file"); ?>
		<?php $this->output("block/contact","file"); ?>
		<?php $this->output("block/hot_products","file"); ?>
	</div>
	<div class="right">
		<div class="news_detail">
			<h2><?php echo $rs['title'];?></h2>
			<div class="news-extra-area">
				发布日期：<span><?php echo date('Y年m月d日',$rs['dateline']);?></span>&nbsp;&nbsp;&nbsp;
				浏览次数：<span id="lblVisits"><?php echo $rs['hits'];?></span>
				<?php if($rs['tag']){ ?>
				&nbsp;&nbsp;&nbsp;关键字：
					<?php $rs_tag_id["num"] = 0;$rs['tag']=is_array($rs['tag']) ? $rs['tag'] : array();$rs_tag_id["total"] = count($rs['tag']);$rs_tag_id["index"] = -1;foreach($rs['tag'] AS $key=>$value){ $rs_tag_id["num"]++;$rs_tag_id["index"]++; ?>
					<a href="<?php echo $value['url'];?>" title="<?php echo $value['alt'];?>" target="<?php echo $value['target'];?>"><?php echo $value['title'];?></a>
					<?php } ?>
				<?php } ?>
			</div>
			<div class="d_txt"><?php echo $rs['content'];?></div>
			<?php if($session['user_id']){ ?>
				<?php $string = 'user_id='.$session['user_id'];?>
			<div class="action">
				<input type="button" value="<?php if(fav_check($rs['id'])){ ?>加入收藏<?php } else { ?>已收藏<?php } ?>" class="button blue" onclick="fav_add('<?php echo $rs['id'];?>',this)" />
			</div>
			<?php } ?>
			<div class="d_page">
				<p>上一主题：
					<?php $prev = phpok_prev($rs);?>
					<?php if($prev){ ?>
					<a href="<?php echo $prev['url'];?>" title="<?php echo $prev['title'];?>"><?php echo $prev['title'];?></a>
					<?php } else { ?>
					没有了
					<?php } ?>
				</p>
				<p>下一主题：
					<?php $next = phpok_next($rs);?>
					<?php if($next){ ?>
					<a href="<?php echo $next['url'];?>" title="<?php echo $next['title'];?>"><?php echo $next['title'];?></a>
					<?php } else { ?>
					没有了
					<?php } ?>
				</p>
			</div>
		</div>
		<?php if($page_rs['comment_status']){ ?><?php $this->assign("tid",$rs['id']); ?><?php $this->output("block_comment","file"); ?><?php } ?>
	</div>
</div>
<?php $this->output("foot","file"); ?>