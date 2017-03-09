<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->assign("title",$page_rs['title']); ?><?php $this->assign("menutitle",$page_rs['title']); ?><?php $this->output("head","file"); ?>
<script type="text/javascript">
$(document).ready(function(){
	$("#book_post").submit(function(){
		//提交表单
		if(!$('#title').val()){
			$.dialog.alert("留言主题不能为空");
			return false;
		}
		if(!$('#fullname').val()){
			$.dialog.alert('留言人姓名不能为空');
			return false;
		}
		if(!$('#email').val()){
			$.dialog.alert('邮箱不能为空');
			return false;
		}
		if(!$('#content').val()){
			$.dialog.alert('留言内容不能为空');
			return false;
		}
		$(this).ajaxSubmit({
			'url':api_url('post','save'),
			'type':'post',
			'dataType':'json',
			'success':function(rs){
				if(rs.status == 'ok'){
					$.dialog.alert('您的留言信息已发布，请耐心等候管理员审核，感谢您的提交',function(){
						$.phpok.reload();
					},'succeed');
				}else{
					$.dialog.alert(rs.content,function(){
						$("#update_vcode").phpok_vcode();
						$("#_chkcode").val('');
					});
					return false;
				}
			}
		});
		return false;
	});
});
</script>
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
		<?php $this->output("block/contact","file"); ?>
		<?php $this->output("block/hot_products","file"); ?>
	</div>
	<div class="right">
		<div class="pfw book mb10">
			<h3>发布新留言</h3>
			<div class="content mess">
				<form method="post" id="book_post">
				<input type="hidden" name="id" id="id" value="<?php echo $page_rs['identifier'];?>" />
				<?php $list=phpok('_fields',array('pid'=>$page_rs['id'],'fields_format'=>"1",'in_title'=>"1"));?>
				<table width="100%">
				<?php $list_id["num"] = 0;$list=is_array($list) ? $list : array();$list_id["total"] = count($list);$list_id["index"] = -1;foreach($list AS $key=>$value){ $list_id["num"]++;$list_id["index"]++; ?>
				<?php if($value['identifier'] != 'adm_reply'){ ?>
				<tr>
					<td width="150px" align="right" valign="top"><?php echo $value['title'];?>：</td>
					<td class="td"><?php echo $value['html'];?></td>
				</tr>
				<?php } ?>
				<?php } ?>
				<?php if($sys['is_vcode'] && function_exists("imagecreate")){ ?>
				<tr>
					<td align="right" valign="top">验证码：</td>
					<td class="td">
						<table cellpadding="0" cellspacing="0" width="180px">
						<tr>
							<td><input type="text" name="_chkcode" id="_chkcode" class="vcode" /></td>
							<td align="right"><img src="" border="0" align="absmiddle" id="update_vcode" class="hand"></td>
						</tr>
						</table>
						<script type="text/javascript">
						$(document).ready(function(){
							$("#update_vcode").phpok_vcode();
							//更新点击时操作
							$("#update_vcode").click(function(){
								$(this).phpok_vcode();
							});
						});
						</script>
					</td>
				</tr>
				<?php } ?>
				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" value=" 提交 " class="submit" /></td>
				</tr>
				</table>
				</form>
			</div>
		</div>
		<?php $tmpid["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$tmpid["total"] = count($rslist);$tmpid["index"] = -1;foreach($rslist AS $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
		<div class="pfw<?php if($tmpid['num'] != $tmpid['total']){ ?> mb10<?php } ?>">
			<h3><?php echo $value['title'];?><small>（<?php echo time_format($value['dateline']);?>）</small></h3>
			<div class="content"><?php echo $value['content'];?></div>
			<?php if($value['adm_reply']){ ?>
			<div class="adm_reply"><div class="adminer">管理员回复：</div><?php echo $value['adm_reply'];?></div>
			<?php } ?>
		</div>
		<?php } ?>
		<?php $this->output("block_pagelist","file"); ?>
	</div>
</div>
<?php $this->output("foot","file"); ?>