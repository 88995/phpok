<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $pageid = G('pageid');?>
<?php $pageid = $pageid ? $pageid : 1;?>
<?php $comment = phpok('_comment','tid='.$tid.'&pageid='.$pageid.'&psize=10');?>
<style type="text/css">
.comment{clear:both;display:block;width:100%;margin:10px 0;padding:0;border-top:1px dashed #ccc;}
.comment div.phpok-title{height:24px;padding:15px 0 13px 0;color:#333;font-size:18px;}
.comment div.phpok-title em{color:#e74851;font-family: Georgia;font-size:20px;}
.comment input.comment-submit{cursor:pointer;padding:3px 10px;background:#C6C6C6;border:1px solid #ccc;border-radius:5px;margin-top:10px;}
.comment input.comment-submit:hover{background:#BDBDBD;font-weight:bold;}
.comment textarea.comment-textarea{width:99%;border:1px solid #ccc;height:84px;}
.comment dl{ margin-bottom:15px;; overflow:hidden;}
.comment dt{ float:left; width:50px;}
.comment dt img{ width:42px; height:42px; border-radius:3px;}
.comment dd{ float:left; width:700px;}
.comment dd .remarks{ background:#fff;border:1px solid #e0e0e0;border-radius:5px; padding:10px;position:relative; margin-bottom:5px;}
.comment dd .remarks .postmessage {margin-top: 4px;margin-bottom: 4px;font-size: 14px;line-height: 1.5em;}
.comment dd .remarks .postmessage p{margin-top: 4px;}
.comment dd .remarks .moddiv{ padding:5px 0; text-align:right; color:#888888;}
.comment dd .remarks .moddiv .nickname{font-weight:bold;padding-right:10px;}
.comment dd fieldset.reply{margin:3px;border: 1px solid #efefef;padding:0 10px 10px 20px;border-radius:5px;line-height:170%;}
.comment dd fieldset.reply legend{padding:0 5px;color:red;}
.comment dd fieldset.reply div.rdate{color:#D9D9D9;font-style:italic;display:block;clear:both;line-height:170%;}
</style>
<script type="text/javascript">
function save_comment()
{
	var url = api_url('comment','save','id=<?php echo $tid;?>');
	var uid = "<?php echo $comment['uid'];?>";
	if(uid && uid>0){
		var comment = UE.getEditor('comment').getContent();
	}else{
		var comment = $("#comment").val();
	}
	if(!comment){
		$.dialog.alert('评论内容不能为空',function(){},'error');
		return false;
	}
	url += '&comment='+$.str.encode(comment);
	$.phpok.json(url,function(rs){
		if(rs.status == 'ok'){
			$.dialog.alert('感谢您提交的评论',function(){
				$.phpok.reload();
			},'succeed');
		}else{
			$.dialog.alert(rs.content);
			return false;
		}
	});
}
$(document).ready(function(){
	$("#comment-post").submit(function(){
		save_comment();
		return false;
	});
});
$(document).keypress(function(e){
	if(e.ctrlKey && e.which == 13 || e.which == 10) {
		save_comment();
		return false;
	}
});
</script>
<div class="comment">
	<div class="phpok-title">评论（<em><?php if($comment && $comment['total']){ ?><?php echo $comment['total'];?><?php } else { ?>0<?php } ?></em> 条评论）</div>
	<dl>
		<dt><img src="<?php echo $comment['avatar'];?>" alt="<?php echo $comment['user'];?>" /></dt>
		<dd><?php echo $comment['form'];?>
			<form method="post" id="comment-post">
				<?php if($comment['uid']){ ?>
				<?php echo form_edit('comment',$comment['content'],'editor','width=100%&height=84&btn_image=1');?>
				<?php } else { ?>
				<textarea name="comment" id="comment" class="comment-textarea"></textarea>
				<?php } ?>
				<input name="" type="submit" class="comment-submit" value="提交" />
			</form>
		</dd>
	</dl>
	<?php $tmpid["num"] = 0;$comment['rslist']=is_array($comment['rslist']) ? $comment['rslist'] : array();$tmpid["total"] = count($comment['rslist']);$tmpid["index"] = -1;foreach($comment['rslist'] AS $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
	<dl>
		<dt><img src="<?php echo $value['uid']['avatar'];?>" alt="<?php echo $value['uid']['user'];?>" /></dt>
		<dd>
			<div class="remarks">
				<div class="postmessage"><?php echo $value['content'];?></div>
				<div class="moddiv"><span class="nickname"><?php echo $value['uid']['user'];?></span>发表于<?php echo time_format($value['addtime']);?></div>
				<?php if($value['adm_content'] && $value['adm_time']){ ?>
				<fieldset class="reply">
					<legend>管理员回复</legend>
					<?php echo $value['adm_content'];?>
					<div class="rdate">回复时间：<?php echo time_format($value['adm_time']);?></div>
				</fieldset>
				<?php } ?>
			</div>
		</dd>
	</dl>
	<?php } ?>
	<?php $pagelist = phpok_page($comment['arc']['url'],$comment['total'],$comment['pageid'],$comment['psize'],"prev=上一页&next=下一页&last=末页&home=首页&always=1");?>
	<?php if($pagelist){ ?>
	<div class="pages">
		<ul>
			<?php $pagelist_id["num"] = 0;$pagelist=is_array($pagelist) ? $pagelist : array();$pagelist_id["total"] = count($pagelist);$pagelist_id["index"] = -1;foreach($pagelist AS $key=>$value){ $pagelist_id["num"]++;$pagelist_id["index"]++; ?>
			<li<?php if($value['status']){ ?> class="current"<?php } ?>><a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>"><?php echo $value['title'];?></a></li>
			<?php } ?>
		</ul>
	</div>
	<?php } ?>
</div>