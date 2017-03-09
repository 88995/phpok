<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->assign("highlight","1"); ?><?php $this->assign("css","tpl/www/css/index.css"); ?><?php $this->output("head","file"); ?>
<?php $list = phpok('picplayer');?>
<?php if($list['total']){ ?>
<div class="banner">
	<div class="bd">
		<ul>
			<?php $list_rslist_id["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$list_rslist_id["total"] = count($list['rslist']);$list_rslist_id["index"] = -1;foreach($list['rslist'] AS $key=>$value){ $list_rslist_id["num"]++;$list_rslist_id["index"]++; ?>
			<li><a href="<?php echo $value['link'];?>" target="<?php echo $value['target'];?>" title="<?php echo $value['title'];?>"><img src="images/blank.gif" _src="<?php echo $value['pic']['filename'];?>" alt="<?php echo $value['title'];?>" /></a></li>
			<?php } ?>
		</ul>
	</div>
	<div class="hd">
		<ul>
			<?php $tmpid["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$tmpid["total"] = count($list['rslist']);$tmpid["index"] = -1;foreach($list['rslist'] AS $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
			<li><?php echo $tmpid['num'];?></li>
			<?php } ?>
		</ul>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$(".banner").slide({'autoPlay':true,'switchLoad':'_src','mainCell':'.bd ul'});
});
</script>
<?php } ?>
<div class="index">
	<div class="line1">
		<?php $list = phpok('news','fields=id','psize=10');?>
		<?php if($list['total']){ ?>
		<div class="pfw">
			<h3><?php echo $list['project']['title'];?><small><?php echo $list['project']['entitle'];?></small><a href="<?php echo $list['project']['url'];?>" class="more">更多</a></h3>
			<ul class="artlist">
				<?php $list_rslist_id["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$list_rslist_id["total"] = count($list['rslist']);$list_rslist_id["index"] = -1;foreach($list['rslist'] AS $key=>$value){ $list_rslist_id["num"]++;$list_rslist_id["index"]++; ?>
				<li><a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>"><?php echo phpok_cut($value['title'],'15','…');?></a></li>
				<?php } ?>
			</ul>
		</div>
		<?php } ?>
	</div>
	<div class="line2">
		<?php $about = phpok('aboutus');?>
		<div class="pfw">
			<h3><?php echo $about['title'];?><a href="<?php echo $about['url'];?>" class="more">更多</a></h3>
			<div class="about"><img src="<?php echo $about['pic'];?>" width="150" height="120" /><?php echo $about['note'];?></div>
		</div>
	</div>
	<div class="line3"><?php $this->assign("showmore","1"); ?><?php $this->output("block/contact","file"); ?></div>
</div>
<div class="plist">
	<?php $list = phpok('new_products');?>
	<h3><?php echo $list['project']['title'];?></h3>
	<div class="prolist">
	<ul>
		<?php $list_rslist_id["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$list_rslist_id["total"] = count($list['rslist']);$list_rslist_id["index"] = -1;foreach($list['rslist'] AS $key=>$value){ $list_rslist_id["num"]++;$list_rslist_id["index"]++; ?>
		<li>
			<div class="img"><a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>"><img src="<?php echo $value['thumb']['gd']['thumb'];?>" alt="<?php echo $value['title'];?>" /></a></div>
			<div class="title"><a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>"><?php echo $value['title'];?></a></div>
			<?php if($list['project']['is_biz']){ ?>
			<div class="price">价格：<span><?php echo price_format($value['price'],$value['currency_id']);?></span></div>
			<?php } ?>
		</li>
		<?php } ?>
	</ul>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$(".prolist").slide({'mainCell':'ul','effect':"leftLoop",'autoPlay':true,'vis':5});
});
</script>
<div class="cooper">
	<?php $list = phpok('link');?>
	<div class="pfw">
		<h3><?php echo $list['project']['title'];?><a href="<?php echo phpok_url(array('ctrl'=>'post','id'=>$list['project']['identifier']));?>" class="more">申请友情链接</a></h3>
		<div class="link">
			<?php $list_rslist_id["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$list_rslist_id["total"] = count($list['rslist']);$list_rslist_id["index"] = -1;foreach($list['rslist'] AS $key=>$value){ $list_rslist_id["num"]++;$list_rslist_id["index"]++; ?>
			<a href="<?php echo $value['link'];?>" target="<?php echo $value['target'];?>" title="<?php echo $value['title'];?>"><?php echo $value['title'];?></a>
			<?php } ?>
		</div>
	</div>
</div>
<?php $this->output("foot","file"); ?>