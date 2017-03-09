<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->output("head","file"); ?>
<script type="text/javascript" src="<?php echo include_js('list.js');?>"></script>
<script type="text/javascript" src="js/laydate/laydate.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	top.$.desktop.title('<?php echo $rs['title'];?>');
});
</script>
<?php if($project_list){ ?>
<script type="text/javascript">
function pendding_info()
{
	var url = get_url('index','pendding_sublist');
	$.ajax({
		'url':url,
		'cache':false,
		'async':true,
		'dataType':'json',
		'success': function(rs){
			if(rs.status == "ok"){
				var list = rs.content;
				var html = '<em class="toptip">{total}</em>';
				var total = 0;
				for(var key in list){
					$("li[id=project_"+list[key]['id']+"] em").remove();
					$("li[id=project_"+list[key]['id']+"]").append(html.replace('{total}',list[key]['total']));
				}
				//每隔一分钟检测一次
				window.setTimeout("pendding_info()", 60000);
			}else{
				//移除提示
				$("em.toptip").remove();
				//每隔三分钟进行一次检测
				window.setTimeout("pendding_info()", 180000);
			}
		}
	});
}

$(document).ready(function(){
	pendding_info();
	$("#project li").mouseover(function(){
		$(this).addClass("hover");
	}).mouseout(function(){
		$(this).removeClass("hover");
	}).click(function(){
		var url = $(this).attr("href");
		if(url){
			$.phpok.go(url);
		}else{
			alert("未指定动作！");
			return false;
		}
	});
});
</script>
<div class="tips"><span class="red"><?php echo $rs['title'];?></span> 子项信息，请点击进入修改</div>
<ul class="project" id="project">
	<?php $project_list_id["num"] = 0;$project_list=is_array($project_list) ? $project_list : array();$project_list_id["total"] = count($project_list);$project_list_id["index"] = -1;foreach($project_list AS $key=>$value){ $project_list_id["num"]++;$project_list_id["index"]++; ?>
	<li id="project_<?php echo $value['id'];?>" title="<?php echo $value['title'];?>" status="<?php echo $value['status'];?>" href="<?php echo phpok_url(array('ctrl'=>'list','func'=>'action','id'=>$value['id']));?>">
		<div class="img"><img src="<?php echo $value['ico'] ? $value['ico'] : 'images/ico/default.png';?>" /></div>
		<div class="txt" id="txt_<?php echo $value['id'];?>"><?php echo $value['nick_title'] ? $value['nick_title'] : $value['title'];?></div>
	</li>
	<?php } ?>
</ul>
<div class="clear"></div>
<?php } ?>

<?php if($rs['module']){ ?>
<script type="text/javascript">
function reply_it(id,title)
{
	var url = get_url('list','comment','id='+id);
	$.dialog.open(url,{
		'title':'<?php echo P_Lang("评论：");?>'+title,
		'lock':true,
		'width':'90%',
		'height':'90%',
		'cancel':function(){return true;}
	});
}
</script>
<div class="tips">
	<?php echo P_Lang("您当前的位置：");?><?php echo P_Lang("内容管理");?>
	<?php $plist_id["num"] = 0;$plist=is_array($plist) ? $plist : array();$plist_id["total"] = count($plist);$plist_id["index"] = -1;foreach($plist AS $key=>$value){ $plist_id["num"]++;$plist_id["index"]++; ?>
	&raquo; <a href="<?php echo phpok_url(array('ctrl'=>'list','func'=>'action','id'=>$value['id']));?>" title="<?php echo $value['title'];?>"><?php echo $value['nick_title'] ? $value['nick_title'] : $value['title'];?></a>
	<?php } ?>
	<?php if($show_parent_catelist){ ?>
	&raquo; <a href="<?php echo phpok_url(array('ctrl'=>'list','func'=>'action','id'=>$pid,'cateid'=>$show_parent_catelist));?>"><?php echo $parent_cate_rs['title'];?></a>
	<?php } ?>
	<?php if($keywords){ ?>
	&raquo; <span class="red"><?php echo $keywords;?></span>
	<?php } ?>
	<?php if($popedom['set'] || $session['admin_rs']['if_system']){ ?>
	<div class="action"><a href="<?php echo phpok_url(array('ctrl'=>'list','func'=>'set','id'=>$pid));?>"><?php echo P_Lang("编辑项目");?></a></div>
	<?php } ?>
	<?php if($popedom['add']){ ?>
	<div class="action"><a href="<?php echo phpok_url(array('ctrl'=>'list','func'=>'edit','pid'=>$pid));?>"><?php echo P_Lang("添加内容");?></a></div>
	<?php } ?>
	<span id="AP_ACTION_HTML" title="插件节点，后台内容列表管理栏面包屑"></span>
</div>
<div class="tips" style="position;relative;">
	<form method="post" action="<?php echo phpok_url(array('ctrl'=>'list','func'=>'action','id'=>$pid));?>">
	<div style="float:left;width:800px;">
		<div><table>
		<tr>
			<td><select name="status">
				<option value=""><?php echo P_Lang("选择状态…");?></option>
				<option value="1"<?php if($status==1){ ?> selected<?php } ?>>已审核</option>
				<option value="2"<?php if($status==2){ ?> selected<?php } ?>>未审核</option>
			</select></td>
			<?php if($rs['is_attr']){ ?>
			<td><select name="attr" id="search_attr">
				<option value=""><?php echo P_Lang("选择属性…");?></option>
				<?php $attrlist_id["num"] = 0;$attrlist=is_array($attrlist) ? $attrlist : array();$attrlist_id["total"] = count($attrlist);$attrlist_id["index"] = -1;foreach($attrlist AS $key=>$value){ $attrlist_id["num"]++;$attrlist_id["index"]++; ?>
				<option value="<?php echo $key;?>"<?php if($attr == $key){ ?> selected<?php } ?>><?php echo $value;?></option>
				<?php } ?>
			</select></td>
			<?php } ?>
			<?php if($rs['cate'] && $catelist){ ?>
			<td><select name="cateid">
				<option value=""><?php echo P_Lang("选择分类…");?></option>
				<?php $catelist_id["num"] = 0;$catelist=is_array($catelist) ? $catelist : array();$catelist_id["total"] = count($catelist);$catelist_id["index"] = -1;foreach($catelist AS $key=>$value){ $catelist_id["num"]++;$catelist_id["index"]++; ?>
				<option value="<?php echo $value['id'];?>"<?php if($cateid == $value['id']){ ?> selected<?php } ?>><?php echo $value['title'];?></option>
				<?php } ?>
			</select></td>
			<?php } ?>
			<td><?php echo P_Lang("时间范围：");?></td>
			<td><input type="text" name="dateline_start" value="<?php echo $dateline_start;?>" placeholder="开始时间" onfocus="laydate()" style="width:110px;" /></td>
			<td><?php echo P_Lang("至");?></td>
			<td><input type="text" name="dateline_stop" value="<?php echo $dateline_stop;?>" placeholder="结束时间" onfocus="laydate()" style="width:110px;" /></td>
		</tr>
		</table></div>
		<table>
		<tr>
			<td><select name="orderby_search">
				<option value=""><?php echo P_Lang("默认排序");?></option>
				<option value="hits_hot"<?php if($orderby_search=='hits_hot'){ ?> selected<?php } ?>><?php echo P_Lang("查看次数多到少");?></option>
				<option value="hits_cold"<?php if($orderby_search=='hits_cold'){ ?> selected<?php } ?>><?php echo P_Lang("查看次数少到多");?></option>
				<?php if($rs['is_biz']){ ?>
				<option value="price_high"<?php if($orderby_search=='price_high'){ ?> selected<?php } ?>><?php echo P_Lang("价格从高到低");?></option>
				<option value="price_low"<?php if($orderby_search=='price_low'){ ?> selected<?php } ?>><?php echo P_Lang("价格从低到高");?></option>
				<?php } ?>
				<option value="sort_max"<?php if($orderby_search=='sort_max'){ ?> selected<?php } ?>><?php echo P_Lang("排序从高到低");?></option>
				<option value="sort_min"<?php if($orderby_search=='sort_min'){ ?> selected<?php } ?>><?php echo P_Lang("排序从低到高");?></option>
				<option value="dateline_max"<?php if($orderby_search=='dateline_max'){ ?> selected<?php } ?>><?php echo P_Lang("最后发布排在前面");?></option>
				<option value="dateline_min"<?php if($orderby_search=='dateline_min'){ ?> selected<?php } ?>><?php echo P_Lang("以前发布的排在前面");?></option>
			</select></td>
			<td><?php echo P_Lang("关键字查找：");?></td>
			<td><select name="keytype">
				<option value=""><?php echo P_Lang("关键字类型…");?></option>
				<option value="title"<?php if($keytype == 'title'){ ?> selected<?php } ?>><?php echo $rs['alias_title'] ? $rs['alias_title'] : P_Lang('主题');?></option>
				<?php if($rs['is_userid']){ ?>
				<option value="user"<?php if($keytype == 'user'){ ?> selected<?php } ?>><?php echo P_Lang("会员账号");?></option>
				<?php } ?>
				<?php if($rs['is_identifier']){ ?>
				<option value="identifier"<?php if($keytype == 'identifier'){ ?> selected<?php } ?>><?php echo P_Lang("自定义标识");?></option>
				<?php } ?>
				<?php if($rs['is_tag']){ ?>
				<option value="tag"<?php if($keytype == 'tag'){ ?> selected<?php } ?>><?php echo P_Lang("标签");?></option>
				<?php } ?>
				<?php if($rs['is_seo']){ ?>
				<option value="seo_title"<?php if($keytype == 'seo_title'){ ?> selected<?php } ?>><?php echo P_Lang("SEO标题");?></option>
				<option value="seo_keywords"<?php if($keytype == 'seo_keywords'){ ?> selected<?php } ?>><?php echo P_Lang("SEO关键字");?></option>
				<option value="seo_desc"<?php if($keytype == 'seo_desc'){ ?> selected<?php } ?>><?php echo P_Lang("SEO描述");?></option>
				<?php } ?>
				<?php $tmpid["num"] = 0;$ext_list=is_array($ext_list) ? $ext_list : array();$tmpid["total"] = count($ext_list);$tmpid["index"] = -1;foreach($ext_list AS $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
				<?php if($value['search'] == 1 || $value['search'] == 2){ ?>
				<option value="<?php echo $value['identifier'];?>"<?php if($keytype == $value['identifier']){ ?> selected<?php } ?>><?php echo $value['title'];?></option>
				<?php } ?>
				<?php } ?>
			</select></td>
			<td><input type="text" id="keywords" name="keywords" class="default" value="<?php echo $keywords;?>" placeholder="<?php echo P_Lang("请输入要搜索的关键字");?>" /></td>
		</tr>
		</table>
	</div>
	<div style="float:left;width:18%;margin-top:20px;"><input type="submit" value="提交搜索" onclick="" class="submit2" /></div>
	</form>
	<div class="clear"></div>
</div>
<?php } ?>

<?php if($rs['admin_note']){ ?>
<div class="tips clearfix"><?php echo $rs['admin_note'];?></div>
<?php } ?>


<?php if($catelist){ ?>
<ul class="list_cate clearfix">
	<?php $catelist_id["num"] = 0;$catelist=is_array($catelist) ? $catelist : array();$catelist_id["total"] = count($catelist);$catelist_id["index"] = -1;foreach($catelist AS $key=>$value){ $catelist_id["num"]++;$catelist_id["index"]++; ?>
	<li>
		<div class="cate cate_<?php echo $catelist_id['num']%9;?>"><a href="<?php echo admin_url('list','action');?>&id=<?php echo $pid;?>&cateid=<?php echo $value['id'];?>"><?php echo $value['title'];?></a></div>
		<div class="cate_add cate_<?php echo $catelist_id['num']%9;?>"><a href="<?php echo admin_url('list','edit');?>&pid=<?php echo $pid;?>&cateid=<?php echo $value['id'];?>"><img src="images/cate_add.png" border="0" alt="" /></a></div>
	</li>
	<?php } ?>
</ul>
<div class="clear"></div>
<?php } ?>

<?php if($rslist){ ?>
<div class="list clearfix">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<th width="20px">&nbsp;</th>
	<th width="20px">&nbsp;</th>
	<th>&nbsp;</th>
	<th class="lft"><?php echo $rs['alias_title'] ? $rs['alias_title'] : P_Lang('主题');?></th>
	<?php if($rs['cate']){ ?>
	<th><?php echo P_Lang("主分类");?></th>
	<?php } ?>
	<?php $layout_id["num"] = 0;$layout=is_array($layout) ? $layout : array();$layout_id["total"] = count($layout);$layout_id["index"] = -1;foreach($layout AS $key=>$value){ $layout_id["num"]++;$layout_id["index"]++; ?>
		<?php if($key == "dateline"){ ?>
		<th style="width:150px"><?php echo $value;?></th>
		<?php }elseif($key == "hits"){ ?>
		<th style="width:50px"><?php echo P_Lang("点击");?></th>
		<?php } else { ?>
		<th class="lft"><?php echo $value;?></th>
		<?php } ?>
	<?php } ?>
	<th style="width:80px"><?php echo P_Lang("排序");?></th>
	<th style="width:30px">&nbsp;</th>
	<th>&nbsp;</th>
</tr>
<?php $tmp_m = 0;?>
<?php $rslist_id["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$rslist_id["total"] = count($rslist);$rslist_id["index"] = -1;foreach($rslist AS $key=>$value){ $rslist_id["num"]++;$rslist_id["index"]++; ?>
<?php $tmp_m++;?>
<tr id="list_<?php echo $value['id'];?>" title="<?php echo $rs['alias_title'] ? $rs['alias_title'] : P_Lang('主题');?>: <?php echo $value['title'];?>&#10;<?php echo P_Lang("发布日期");?>: <?php echo date('Y-m-d H:i:s',$value['dateline']);?>">
	<td class="center"><input type="checkbox" name="ids[]" id="id_<?php echo $value['id'];?>" value="<?php echo $value['id'];?>" /></td>
	<td><span class="status<?php echo $value['status'];?>" id="status_<?php echo $value['id'];?>" <?php if($popedom['status']){ ?>onclick="set_status(<?php echo $value['id'];?>)"<?php } else { ?> style="cursor: default;"<?php } ?> value="<?php echo $value['status'];?>"></span></td>
	<td class="center"><?php echo $value['id'];?></td>
	<td><label for="id_<?php echo $value['id'];?>">
		<?php echo $value['title'];?>
		<?php if($value['attr']){ ?>
			<?php $attr = explode(",",$value['attr']);?>
			<?php $attr_id["num"] = 0;$attr=is_array($attr) ? $attr : array();$attr_id["total"] = count($attr);$attr_id["index"] = -1;foreach($attr AS $attr_k=>$attr_v){ $attr_id["num"]++;$attr_id["index"]++; ?>
			<a href="<?php echo admin_url('list','action');?>&id=<?php echo $pid;?>&attr=<?php echo $attr_v;?>" class="gray">[<?php echo $attrlist[$attr_v];?>]</a>
			<?php } ?>
		<?php } ?>
		<?php if($value['identifier']){ ?>
		<span class="gray i">（<?php echo $value['identifier'];?>）</span>
		<?php } ?>
		<?php if($rs['is_biz']){ ?>
		<span class="red i"> <?php echo price_format($value['price'],$value['currency_id']);?></span>
		<?php } ?>
		<?php if($value['hidden']){ ?>
		<span class="red i">(<?php echo P_Lang("隐藏");?>)</span>
		<?php } ?>
		<?php if($clist && $clist[$value['id']]){ ?>
		<div class="extcate">
			分类：
			<?php $clist__value_id__id["num"] = 0;$clist[$value['id']]=is_array($clist[$value['id']]) ? $clist[$value['id']] : array();$clist__value_id__id["total"] = count($clist[$value['id']]);$clist__value_id__id["index"] = -1;foreach($clist[$value['id']] AS $ck=>$cv){ $clist__value_id__id["num"]++;$clist__value_id__id["index"]++; ?>
			<a href="<?php echo phpok_url(array('ctrl'=>'list','func'=>'action','id'=>$pid,'cateid'=>$cv));?>" class="i"><?php echo $cateall[$cv];?></a> 
			<?php } ?>
		</div>
		<?php } ?>
	</label>
	</td>
	<?php if($rs['cate']){ ?>
	<td class="gray center">
		<?php if($value['cate_id'] && is_array($value['cate_id'])){ ?>
		<a href="<?php echo admin_url('list','action');?>&id=<?php echo $pid;?>&cateid=<?php echo $value['cate_id']['id'];?>"><?php echo $value['cate_id']['title'];?></a>
		<?php } else { ?>
		<?php echo P_Lang("未设分类");?>
		<?php } ?>
	</td>
	<?php } ?>
	
	<?php $layout_id["num"] = 0;$layout=is_array($layout) ? $layout : array();$layout_id["total"] = count($layout);$layout_id["index"] = -1;foreach($layout AS $k=>$v){ $layout_id["num"]++;$layout_id["index"]++; ?>
		<?php if($k == "dateline"){ ?>
		<td class="center"><?php echo date('Y-m-d',$value['dateline']);?></td>
		<?php }elseif($k == "hits"){ ?>
		<td class="center"><?php echo $value['hits'];?></td>
		<?php }elseif($k == "user_id"){ ?>
		<td><?php echo $value['_user'] ? $value['_user'] : '-';?></td>
		<?php } else { ?>
			<?php if(is_array($value[$k])){ ?>
				<?php $c_list = $value[$k]['_admin'];?>
				<?php if($c_list['type'] == 'pic'){ ?>
				<td><img src="<?php echo $c_list['info'];?>" width="28px" height="28px" border="0" class="hand" onclick="preview_attr('<?php echo $c_list['id'];?>')" style="border:1px solid #dedede;padding:1px;" /></td>
				<?php } else { ?>
					<?php if(is_array($c_list['info'])){ ?>
					<td><?php echo implode(' / ',$c_list['info']);?></td>
					<?php } else { ?>
					<td><?php echo $c_list['info'] ? $c_list['info'] : '-';?></td>
					<?php } ?>
				<?php } ?>
			<?php } else { ?>
			<td><?php echo $value[$k] ? $value[$k] : '-';?></td>
			<?php } ?>
		<?php } ?>
	<?php } ?>
	<td class="center"><input type="text" class="short center" value="<?php echo $value['sort'];?>" tabindex="<?php echo $tmp_m;?>" onblur="update_taxis(this.value,'<?php echo $value['id'];?>')" /></td>
	<td class="center"><span id="taxis_<?php echo $value['id'];?>"></span></td>
	<td>
		<div class="button-group">
			<?php if($popedom['modify']){ ?><input type="button" value="<?php echo P_Lang("编辑");?>" onclick="$.phpok.go('<?php echo phpok_url(array('ctrl'=>'list','func'=>'edit','id'=>$value['id']));?>')" class="phpok-btn" /><?php } ?>
			<?php if($popedom['delete']){ ?><input type="button" value="<?php echo P_Lang("删除");?>" onclick="content_del('<?php echo $value['id'];?>')" class="phpok-btn" /><?php } ?>
			<?php if($session['admin_rs']['if_system'] && $rs['is_appoint']){ ?><input type="button" value="<?php echo P_Lang("指派");?>" class="phpok-btn" onclick="set_admin_id('<?php echo $value['id'];?>')" /><?php } ?>
			<?php if($popedom['comment'] && $rs['comment_status'] && $comments[$value['id']]){ ?><input type="button" class="phpok-btn" value="<?php echo P_Lang("评论");?>" onclick="reply_it('<?php echo $value['id'];?>','<?php echo $value['title'];?>')"<?php if($comments[$value['id']]['uncheck']){ ?> style="color:red;" title="<?php echo P_Lang("未审核评论：");?><?php echo $comments[$value['id']]['uncheck'];?>"<?php } ?> /><?php } ?>
			<?php if($rs['subtopics'] && !$value['parent_id'] && $popedom['add']){ ?><input type="button" value="加子主题" onclick="$.phpok.go('<?php echo phpok_url(array('ctrl'=>'list','func'=>'edit','parent_id'=>$value['id'],'pid'=>$value['project_id']));?>')" class="phpok-btn" /><?php } ?>
		</div>
	</td>
</tr>
	<?php $value_sonlist_id["num"] = 0;$value['sonlist']=is_array($value['sonlist']) ? $value['sonlist'] : array();$value_sonlist_id["total"] = count($value['sonlist']);$value_sonlist_id["index"] = -1;foreach($value['sonlist'] AS $kk=>$vv){ $value_sonlist_id["num"]++;$value_sonlist_id["index"]++; ?>
	<?php $tmp_m++;?>
	<tr id="list_<?php echo $vv['id'];?>" title="<?php echo $rs['alias_title'] ? $rs['alias_title'] : '主题';?>：<?php echo $vv['title'];?>&#10;发布日期：<?php echo date('Y-m-d H:i:s',$vv['dateline']);?>">
		<td class="center"><input type="checkbox" name="ids[]" id="id_<?php echo $vv['id'];?>" value="<?php echo $vv['id'];?>" /></td>
		<td><span class="status<?php echo $vv['status'];?>" id="status_<?php echo $vv['id'];?>" <?php if($popedom['status']){ ?>onclick="set_status(<?php echo $vv['id'];?>)"<?php } else { ?> style="cursor: default;"<?php } ?> value="<?php echo $vv['status'];?>"></span></td>
		<td class="center"><?php echo $vv['id'];?></td>
		<td><label for="id_<?php echo $vv['id'];?>">
			&nbsp; &nbsp; ├─ <?php echo $vv['title'];?>
			<?php if($vv['attr']){ ?>
				<?php $attr = explode(",",$vv['attr']);?>
				<?php $attr_id["num"] = 0;$attr=is_array($attr) ? $attr : array();$attr_id["total"] = count($attr);$attr_id["index"] = -1;foreach($attr AS $attr_k=>$attr_v){ $attr_id["num"]++;$attr_id["index"]++; ?>
				[<?php echo $attrlist[$attr_v];?>]
				<?php } ?>
			<?php } ?>
			<?php if($vv['identifier']){ ?>
			<span class="gray i">（<?php echo $vv['identifier'];?>）</span>
			<?php } ?>
			<?php if($rs['is_biz']){ ?>
			<span class="red i"> <?php echo price_format($vv['price'],$vv['currency_id']);?></span>
			<?php } ?>
			<?php if($vv['hidden']){ ?>
			<span class="red i">(隐藏)</span>
			<?php } ?>
			<?php if($clist && $clist[$vv['id']]){ ?>
			<div class="extcate">
				分类：
				<?php $clist__vv_id__id["num"] = 0;$clist[$vv['id']]=is_array($clist[$vv['id']]) ? $clist[$vv['id']] : array();$clist__vv_id__id["total"] = count($clist[$vv['id']]);$clist__vv_id__id["index"] = -1;foreach($clist[$vv['id']] AS $ck=>$cv){ $clist__vv_id__id["num"]++;$clist__vv_id__id["index"]++; ?>
				<a href="<?php echo phpok_url(array('ctrl'=>'list','func'=>'action','id'=>$pid,'cateid'=>$cv));?>" class="i"><?php echo $cateall[$cv];?></a> 
				<?php } ?>
			</div>
			<?php } ?>
		</label>
		</td>
		<?php if($rs['cate']){ ?>
		<td class="gray center">
			<?php if($vv['cate_id'] && is_array($vv['cate_id'])){ ?>
			<a href="<?php echo admin_url('list','action');?>&id=<?php echo $pid;?>&cateid=<?php echo $vv['cate_id']['id'];?>"><?php echo $vv['cate_id']['title'];?></a>
			<?php } else { ?>
			未设分类
			<?php } ?>
		<?php } ?>
		<?php $layout_id["num"] = 0;$layout=is_array($layout) ? $layout : array();$layout_id["total"] = count($layout);$layout_id["index"] = -1;foreach($layout AS $k=>$v){ $layout_id["num"]++;$layout_id["index"]++; ?>
			<?php if($k == "dateline"){ ?>
			<td class="center"><?php echo date("Y-m-d",$vv['dateline']);?></td>
			<?php }elseif($k == "hits"){ ?>
			<td class="center"><?php echo $vv['hits'];?></td>
			<?php }elseif($k == 'user_id'){ ?>
			<td><?php echo $vv['_user'] ? $vv['_user'] : '-';?></td>
			<?php } else { ?>
				<?php if(is_array($vv[$k])){ ?>
					<?php $c_list = $vv[$k]['_admin'];?>
					<?php if($c_list['type'] == 'pic'){ ?>
					<td><img src="<?php echo $c_list['info'];?>" width="28px" height="28px" border="0" class="hand" onclick="preview_attr('<?php echo $c_list['id'];?>')" style="border:1px solid #dedede;padding:1px;" /></td>
					<?php } else { ?>
						<?php if(is_array($c_list['info'])){ ?>
						<td><?php echo implode(' / ',$c_list['info']);?></td>
						<?php } else { ?>
						<td><?php echo $c_list['info'] ? $c_list['info'] : '-';?></td>
						<?php } ?>
					<?php } ?>
				<?php } else { ?>
				<td><?php echo $vv[$k] ? $vv[$k] : '-';?></td>
				<?php } ?>
			<?php } ?>
		<?php } ?>
		<td class="center"><input type="text" class="short center" value="<?php echo $vv['sort'];?>" tabindex="<?php echo $tmp_m;?>" onblur="update_taxis(this.value,'<?php echo $vv['id'];?>')" /></td>
		<td class="center"><span id="taxis_<?php echo $vv['id'];?>"></span></td>
		<td>
			<div class="button-group">
				<?php if($popedom['modify']){ ?><input type="button" value="<?php echo P_Lang("编辑");?>" onclick="$.phpok.go('<?php echo phpok_url(array('ctrl'=>'list','func'=>'edit','id'=>$vv['id']));?>')" class="phpok-btn" /><?php } ?>
				<?php if($popedom['delete']){ ?><input type="button" value="<?php echo P_Lang("删除");?>" onclick="content_del('<?php echo $vv['id'];?>')" class="phpok-btn" /><?php } ?>
				<?php if($session['admin_rs']['if_system'] && $rs['is_appoint']){ ?><input type="button" value="<?php echo P_Lang("指派");?>" class="phpok-btn" onclick="set_admin_id('<?php echo $vv['id'];?>')" /><?php } ?>
				<?php if($popedom['comment'] && $rs['comment_status'] && $comments[$vv['id']]){ ?><input type="button" class="phpok-btn" value="<?php echo P_Lang("评论");?>" onclick="reply_it('<?php echo $vv['id'];?>','<?php echo $vv['title'];?>')"<?php if($comments[$vv['id']]['uncheck']){ ?> style="color:red;" title="<?php echo P_Lang("未审核评论：");?><?php echo $comments[$vv['id']]['uncheck'];?>"<?php } ?> /><?php } ?>
			</div>
		</td>
	</tr>
	<?php } ?>
<?php } ?>
</table>
</div>
<?php } ?>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td style="padding-top:5px;">
		<?php if($rslist){ ?>
		<ul class="layout">
			<li>
				<div class="button-group">
					<input type="button" value="<?php echo P_Lang("全选");?>" class="phpok-btn" onclick="$.input.checkbox_all()" />
					<input type="button" value="<?php echo P_Lang("全不选");?>" class="phpok-btn" onclick="$.input.checkbox_none()" />
					<input type="button" value="<?php echo P_Lang("反选");?>" class="phpok-btn" onclick="$.input.checkbox_anti()" />
				</div>
			</li>
			<li><select id="list_action_val" style="width:200px;margin-top:0px;" onchange="update_select()">
				<option value=""><?php echo P_Lang("选择要执行的动作…");?></option>
				<?php if($opt_catelist){ ?>
				<optgroup label="<?php echo P_Lang("分类操作");?>">
					<?php $opt_catelist_id["num"] = 0;$opt_catelist=is_array($opt_catelist) ? $opt_catelist : array();$opt_catelist_id["total"] = count($opt_catelist);$opt_catelist_id["index"] = -1;foreach($opt_catelist AS $key=>$value){ $opt_catelist_id["num"]++;$opt_catelist_id["index"]++; ?>
					<option value="cate:<?php echo $value['id'];?>"><?php echo $value['_space'];?><?php echo $value['title'];?></option>
					<?php } ?>
				</optgroup>
				<?php } ?>
				<?php if($rs['is_attr']){ ?>
				<optgroup label="<?php echo $rs['alias_title'] ? $rs['alias_title'] : P_Lang('主题');?><?php echo P_Lang("属性");?>">
					<?php $attrlist_id["num"] = 0;$attrlist=is_array($attrlist) ? $attrlist : array();$attrlist_id["total"] = count($attrlist);$attrlist_id["index"] = -1;foreach($attrlist AS $key=>$value){ $attrlist_id["num"]++;$attrlist_id["index"]++; ?>
					<option value="attr:<?php echo $key;?>"><?php echo $value;?> <?php echo $key;?></option>
					<?php } ?>
				</optgroup>
				<?php } ?>
				<optgroup label="其他">
					<?php if($popedom['status']){ ?>
					<option value="status"><?php echo P_Lang("审核");?></option>
					<option value="unstatus"><?php echo P_Lang("取消审核");?></option>
					<?php } ?>
					<option value="hidden"><?php echo P_Lang("隐藏");?></option>
					<option value="show"><?php echo P_Lang("显示");?></option>
					<?php if($popedom['delete']){ ?>
					<option value="delete"><?php echo P_Lang("删除");?></option>
					<?php } ?>
					<?php if($session['admin_rs']['if_system'] && $rs['is_appoint']){ ?>
					<option value="appoint"><?php echo P_Lang("指派管理员维护");?></option>
					<?php } ?>
					<?php if($popedom['modify'] && $rs['subtopics']){ ?>
					<option value="set_parent"><?php echo P_Lang("绑定父层");?></option>
					<option value="unset_parent"><?php echo P_Lang("取消父层");?></option>
					<?php } ?>
				</optgroup>
				</select></li>
			<li id="attr_set_li" class="hide">
				<select name="attr_set_val" style="margin-top:0px;" id="attr_set_val">
					<option value="add"><?php echo P_Lang("添加");?></option>
					<option value="delete"><?php echo P_Lang("移除");?></option>
				</select>
			</li>
			<?php if($opt_catelist){ ?>
			<li id="cate_set_li" class="hide">
				<select name="cate_set_val" style="margin-top:0px;" id="cate_set_val">
					<?php if($rs['cate_multiple']){ ?>
					<option value="add"><?php echo P_Lang("添加扩展分类");?></option>
					<option value="delete"><?php echo P_Lang("移除分类绑定");?></option>
					<?php } ?>
					<option value="move"><?php echo P_Lang("移动主分类");?></option>
				</select>
			</li>
			<?php } ?>
			<li id="plugin_button"><input type="button" value="<?php echo P_Lang("执行操作");?>" onclick="list_action_exec()" class="phpok-btn" /></li>
		</ul>
		<?php } ?>
	</td>
	<td align="right"><?php $this->output("pagelist","file"); ?></td>
</tr>
</table>

<?php $this->output("foot","file"); ?>
