<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $title= $rs['title'].' - '.$cate_rs['title'].' - '.$page_rs['title'];?>
<?php $this->assign("title",$title); ?><?php $this->assign("menutitle",$page_rs['title']); ?><?php $this->assign("css","tpl/www/css/product.css"); ?><?php $this->assign("js","tpl/www/js/jquery.zoombie.js"); ?><?php $this->output("head","file"); ?>
<script type="text/javascript">
function attr_select(id,aid)
{
	$("#attr_"+aid).val(id);
	$("div[name=attr"+aid+"]").each(function(i){
		var tid = $(this).attr('data');
		if(tid == id){
			$(this).addClass("selected");
			//判断价格
			var new_price = $(this).attr("price");
			if(new_price && parseFloat(new_price)>0){
				price = parseFloat(price) + parseFloat(new_price);
				$("#showprice").html(price);
			}
		}else{
			$(this).removeClass('selected');
		}
	});
	var price = '<?php echo $rs['price'];?>';
	$("input[name=attr]").each(function(i){
		var val = $(this).val();
		var newprice = $("div[data="+val+"]").attr("price");
		if(newprice && parseFloat(newprice)>0){
			price = parseFloat(price) + parseFloat(newprice);
		}
	});
	var url = api_url('cart','price_format','price='+$.str.encode(price));
	$.phpok.json(url,function(rs){
		if(rs.status){
			$("#showprice").html(rs.info);
		}
	});
}
$(document).ready(function(){
	//按住鼠标可以查看大图
	$('#product_img .big li').zoombie({on:'grab'});
	$("#product_img").slide({
		'titCell':'.hd li',
		'mainCell':'.big',
		'effect':"fold",
		'autoPlay':true
	});
	$("#minus").click(function(){
		var o = $("#buycount").val();
		if(o<2){
			$.dialog.alert('要购买的数量不能少于1');
			return false;
		}
		o = parseInt(o) - 1;
		$("#buycount").val(o);
	});
	$("#plus").click(function(){
		var o = $("#buycount").val();
		o = parseInt(o) + 1;
		$("#buycount").val(o);
	});
});
</script>
<div class="main product">
	<?php if($page_rs['banner']){ ?>
	<div class="banner"><img src="<?php echo $page_rs['banner']['filename'];?>" alt="<?php echo $page_rs['title'];?>" /></div>
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
		<?php $this->output("block/hot_article","file"); ?>
	</div>
	<div class="right">
		<div class="pro_left">
			<div class="proimg">
				<div class="product_img" id="product_img">
					<ul class="big">
						<?php if(!$rs['pictures'] && $rs['thumb']){ ?>
						<li><img src="<?php echo $rs['thumb']['gd']['thumb'];?>" _src="<?php echo $rs['thumb']['gd']['auto'];?>" border="0" alt="<?php echo $value['title'];?>" /></li>
						<?php } ?>
						<?php $rs_pictures_id["num"] = 0;$rs['pictures']=is_array($rs['pictures']) ? $rs['pictures'] : array();$rs_pictures_id["total"] = count($rs['pictures']);$rs_pictures_id["index"] = -1;foreach($rs['pictures'] AS $key=>$value){ $rs_pictures_id["num"]++;$rs_pictures_id["index"]++; ?>
						<li><img src="<?php echo $value['gd']['thumb'];?>" _src="<?php echo $value['gd']['auto'];?>" border="0" alt="<?php echo $value['title'];?>" /></li>
						<?php } ?>
					</ul>
					<ul class="hd">
						<?php if(!$rs['pictures'] && $rs['thumb']){ ?>
						<li href="<?php echo $rs['thumb']['gd']['auto'];?>" thumb="<?php echo $rs['thumb']['gd']['thumb'];?>"></li>
						<?php } ?>
						<?php $rs_pictures_id["num"] = 0;$rs['pictures']=is_array($rs['pictures']) ? $rs['pictures'] : array();$rs_pictures_id["total"] = count($rs['pictures']);$rs_pictures_id["index"] = -1;foreach($rs['pictures'] AS $key=>$value){ $rs_pictures_id["num"]++;$rs_pictures_id["index"]++; ?>
						<li href="<?php echo $value['gd']['auto'];?>" thumb="<?php echo $value['gd']['thumb'];?>"></li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<div style="text-align:center;line-height:170%;"><img src="tpl/www/images/zoom.png" /> 鼠标按住图片可看放大效果</div>
			<?php if($config['share']['baidu']){ ?>
			<div style="margin-top:5px;"><?php echo $config['share']['baidu'];?></div>
			<?php } ?>
		</div>
		<div class="info">
			<h1><?php echo $rs['title'];?></h1>
			<ul class="alist">
				<li><em>查看次数：</em><?php echo $rs['hits'];?></li>
				<li><em>添加时间：</em><?php echo date('Y-m-d',$rs['dateline']);?></li>
				<li style="padding:0;"><hr /></li>
				<?php $rs_attrlist_id["num"] = 0;$rs['attrlist']=is_array($rs['attrlist']) ? $rs['attrlist'] : array();$rs_attrlist_id["total"] = count($rs['attrlist']);$rs_attrlist_id["index"] = -1;foreach($rs['attrlist'] AS $key=>$value){ $rs_attrlist_id["num"]++;$rs_attrlist_id["index"]++; ?>
				<li>
					<em><?php echo $value['title'];?>：</em>
					<input type="hidden" name="attr" id="attr_<?php echo $value['id'];?>" value="" />
					<div style="margin-bottom:5px;">
						<ul class="attr">
							<?php $tmpid["num"] = 0;$value['rslist']=is_array($value['rslist']) ? $value['rslist'] : array();$tmpid["total"] = count($value['rslist']);$tmpid["index"] = -1;foreach($value['rslist'] AS $k=>$v){ $tmpid["num"]++;$tmpid["index"]++; ?>
							<li><div class="attr" name="attr<?php echo $value['id'];?>" data="<?php echo $v['id'];?>" price="<?php echo $v['price'];?>" weight="<?php echo $v['weight'];?>" volume="<?php echo $v['volume'];?>" onclick="attr_select('<?php echo $v['id'];?>','<?php echo $value['id'];?>')"><?php echo $v['title'];?></div></li>
							<?php } ?>
						</ul>
						<div class="clear"></div>
					</div>
				</li>
				<?php } ?>
				<li>
					<em>购买数量：</em>
					<table>
					<tr>
						<td class="numbg" id="minus">-</td>
						<td><input name="buycount" id="buycount" value="1" type="text" class="numtxt" /></td>
						<td class="numbg" id="plus">+</td>
					</tr>
					</table>
				</li>
				<li>
					<em>价格：</em>
					<span class="price" style="color:red;font-size:16px;" id="showprice"><?php echo price_format($rs['price'],$rs['currency_id']);?></span>
				</li>
				<li>
					<a href="javascript:$.cart.add('<?php echo $rs['id'];?>',$('#buycount').val());void(0);"><img src="tpl/www/images/buy-btn.jpg" width="157" height="33" /></a>
					
				</li>
				<li style="margin-top:10px;"><input type="button" value="立即购买" onclick="$.cart.onebuy('<?php echo $rs['id'];?>',$('#buycount').val())" style="border:1px solid #c40000;background:#ffeded;color:#c40000;padding:0;margin:0;width:156px;height:33px;line-height:30px;" /></li>
			</ul>
		</div>
		<div class="clear"></div>
		<div class="pro_detail">
			<ul class="pro_title">
				<?php if($rs['content']){ ?><li>商品介绍</li><?php } ?>
				<?php if($rs['pictures']){ ?><li>商品图集</li><?php } ?>
				<?php if($rs['parameter']){ ?><li>规格参数</li><?php } ?>
				<?php if($rs['package']){ ?><li>包装清单</li><?php } ?>
				<li>售后保障</li>
				<?php if($page_rs['comment_status']){ ?><li>商品评价</li><?php } ?>
			</ul>
			<div class="pro_txt">
				<?php if($rs['content']){ ?><div class="content"><?php echo $rs['content'];?></div><?php } ?>
				<?php if($rs['pictures']){ ?>
				<div class="content">
					<?php $tmpid["num"] = 0;$rs['pictures']=is_array($rs['pictures']) ? $rs['pictures'] : array();$tmpid["total"] = count($rs['pictures']);$tmpid["index"] = -1;foreach($rs['pictures'] AS $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
					<p align="center"><img src="<?php echo $value['gd']['auto'];?>" border="0" /></p>
					<?php } ?>
				</div>
				<?php } ?>
				<?php if($rs['parameter']){ ?>
				<div class="content">
					<table width="100%">
					<?php $tmpid["num"] = 0;$rs['parameter']=is_array($rs['parameter']) ? $rs['parameter'] : array();$tmpid["total"] = count($rs['parameter']);$tmpid["index"] = -1;foreach($rs['parameter'] AS $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
					<tr>
						<th width="25%"><?php echo $key;?></th>
						<td><?php echo $value;?></td>
					</tr>
					<?php } ?>
					</table>
				</div>
				<?php } ?>
				<?php if($rs['package']){ ?>
				<div class="content"><?php echo nl2br($rs['package']);?></div>
				<?php } ?>
				<div class="content"><?php $t = phpok('after-sale-protection');?><?php echo $t['content'];?></div>
				<?php if($page_rs['comment_status']){ ?><div class="content"><?php $this->output("block_comment","file"); ?></div><?php } ?>
			</div>
		</div>
		<script type="text/javascript">
		$(document).ready(function(){
			jQuery(".pro_detail").slide({titCell:".pro_title li",mainCell:".pro_txt",'titOnClassName':'current','trigger':'click'});
		});
		</script>
	</div>

</div>

<?php $this->output("foot","file"); ?>
