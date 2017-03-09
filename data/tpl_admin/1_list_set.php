<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->output("head","file"); ?>
<script type="text/javascript" src="<?php echo include_js('list.js');?>"></script>
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
			if(rs.status == "ok")
			{
				var list = rs.content;
				var html = '<em class="toptip">{total}</em>';
				var total = 0;
				for(var key in list)
				{
					$("li[id=project_"+list[key]['id']+"] em").remove();
					$("li[id=project_"+list[key]['id']+"]").append(html.replace('{total}',list[key]['total']));
				}
				//每隔一分钟检测一次
				window.setTimeout("pendding_info()", 60000);
			}
			else
			{
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
		if(url)
		{
			direct(url);
		}
		else
		{
			alert("未指定动作！");
			return false;
		}
	});
});
</script>
<div class="tips">
	<span class="red"><?php echo $rs['title'];?></span> 子项信息，请点击进入修改
</div>
<ul class="project" id="project">
	<?php $project_list_id["num"] = 0;$project_list=is_array($project_list) ? $project_list : array();$project_list_id["total"] = count($project_list);$project_list_id["index"] = -1;foreach($project_list AS $key=>$value){ $project_list_id["num"]++;$project_list_id["index"]++; ?>
	<li id="project_<?php echo $value['id'];?>" title="<?php echo $value['title'];?>" status="<?php echo $value['status'];?>" href="<?php echo admin_url('list','action');?>&id=<?php echo $value['id'];?>">
		<div class="project" href="<?php echo admin_url('list','action');?>&id=<?php echo $value['id'];?>">
			<div class="img"><img src="<?php echo $value['ico'] ? $value['ico'] : 'images/ico/default.png';?>" /></div>
			<div class="txt" id="txt_<?php echo $value['id'];?>"><?php echo $value['nick_title'] ? $value['nick_title'] : $value['title'];?></div>
		</div>
	</li>
	<?php } ?>
</ul>
<div class="clear"></div>
<?php } ?>

<?php if($popedom['set'] || $session['admin_rs']['if_system']){ ?>
<div class="tips">
	您当前的位置：
	<a href="<?php echo admin_url('list');?>">内容管理</a>
	<?php if($pid){ ?>
		<?php $plist_id["num"] = 0;$plist=is_array($plist) ? $plist : array();$plist_id["total"] = count($plist);$plist_id["index"] = -1;foreach($plist AS $key=>$value){ $plist_id["num"]++;$plist_id["index"]++; ?>
		&raquo; <a href="<?php echo admin_url('list','action');?>&id=<?php echo $value['id'];?>" title="<?php echo $value['title'];?>"><?php echo $value['title'];?></a>		
		<?php } ?>
	<?php } ?>
	&raquo; 编辑页面属性
</div>

<?php if($rs['admin_note']){ ?>
<div class="tips"><?php echo $rs['admin_note'];?></div>
<?php } ?>

<ul class="group">
	<li class="on" onclick="$.admin.group(this)" name="main">基本设置</li>
	<li onclick="$.admin.group(this)" name="seo">SEO优化</li>
</ul>

<form method="post" id="<?php echo $ext_module;?>" action="<?php echo admin_url('list','save');?>" onsubmit="return project_check();">
<input type="hidden" id="id" name="id" value="<?php echo $id;?>" />
<div id="main_setting">
	<div class="table">
		<div class="title">
			名称：
			<span class="note">设置名称</span>
		</div>
		<div class="content"><input type="text" id="title" name="title" class="long" value="<?php echo $rs['title'];?>" /></div>
	</div>
	<?php $extlist_id["num"] = 0;$extlist=is_array($extlist) ? $extlist : array();$extlist_id["total"] = count($extlist);$extlist_id["index"] = -1;foreach($extlist AS $key=>$value){ $extlist_id["num"]++;$extlist_id["index"]++; ?>
	<div class="table">
		<div class="title">
			<table cellspacing="0" cellpadding="0">
			<tr>
				<td height="25"><?php echo $value['title'];?><span class="darkblue">[<?php echo $value['identifier'];?>]</span>：</td>
				<td><span class="note"><?php echo $value['note'];?></span></td>
			</tr>
			</table>
		</div>
		<div class="content"><?php echo $value['html'];?></div>
	</div>
	<?php } ?>
</div>
<div id="seo_setting" class="hide">
	<div class="table">
		<div class="title">
			SEO标题：
			<span class="note">设置此标题后，网站Title将会替代默认定义的，不能超过85个汉字</span>
		</div>
		<div class="content">
			<input type="text" id="seo_title" name="seo_title" class="long" value="<?php echo $rs['seo_title'];?>" />
		</div>
	</div>
	<div class="table">
		<div class="title">
			SEO关键字：
			<span class="note">多个关键字用英文逗号或英文竖线隔开</span>
		</div>
		<div class="content">
			<input type="text" id="seo_keywords" name="seo_keywords" class="long" value="<?php echo $rs['seo_keywords'];?>" />
		</div>
	</div>
	<div class="table">
		<div class="title">
			SEO描述：
			<span class="note">简单描述该主题信息，用于搜索引挈，不支持HTML，不能超过85个汉字</span>
		</div>
		<div class="content">
			<textarea name="seo_desc" id="seo_desc" class="long"><?php echo $rs['seo_desc'];?></textarea>
		</div>
	</div>
	<div class="table">
		<div class="title">
			Tag标签：
			<span class="note">多个标签用英文空格隔开，最多不能超过10个词</span>
		</div>
		<div class="content">
			<input type="text" id="tag" name="tag" class="long" value="<?php echo $rs['tag'];?>" />
		</div>
	</div>
</div>

<div class="table">
	<div class="content">
		<br />
		<input type="submit" value="提 交" class="submit" />
		<br />
	</div>
</div>
</form>

<?php } ?>

<?php $this->output("foot","file"); ?>