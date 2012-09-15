<div class="container content">
	<div class="page-header">
		<?php if($type == 'news'){?>
			<h1><?php echo $brand['Brand']['name'];?> - 新增文章 - 新闻</h1>
		<?php }?>
		<?php if($type == 'guide'){?>
			<h1><?php echo $brand['Brand']['name'];?> - 新增文章 - 导购</h1>
		<?php }?>
	</div>
	<div>
		<form class="form-horizontal" action="<?php echo $this->webroot?>dashboard/saveArticle" method="POST" enctype="multipart/form-data">
			<fieldset>
				<div class="control-group" id="title-ctrl-grp">
					<label class="control-label">标题</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="title" value="" name="title">
						<span class="help-inline"></span>
					</div>
				</div>
				<div class="control-group" id="content-ctrl-grp">
					<label class="control-label">正文</label>
					<div class="controls">
						<textarea style="width:600px;height:300px;visibility:hidden;" id="content" name="content"></textarea>
						<span class="help-inline"></span>
					</div>
				</div>
				<div class="form-actions">
					<input type='hidden' name="brand_id" value="<?php echo $brand['Brand']['id'];?>">
					<input type='hidden' name="type" value="<?php echo $type;?>">
					<button class="btn btn-primary" type="submit" id="save">保存</button>
				</div>
			</fieldset>
		</form>
	</div>
</div>

<?php echo $this->Html->script(array('kindeditor/kindeditor')); ?>
<script>
	var editor;
	KindEditor.ready(function(K) {
		editor = K.create('textarea[name="content"]', {
			resizeType : 1,
			uploadJson : '<?php echo $this->webroot?>' + 'kindeditor/uploadJson',
			fileManagerJson : '<?php echo $this->webroot?>' + 'kindeditor/fileManagerJson',
			allowPreviewEmoticons : true,
			allowFileManager : true,
			items : [
				'fullscreen', '|','fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline','removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist','insertunorderedlist', '|', 'emoticons', 'image', 'link']
		});
	});
</script>
<script type="text/javascript">
$(function(){

	$('#title').focus();
	
	$('#save').click(function(){
		var checkStatus = true;
		
		//验证产品名称有没有输入
		if($.trim($('#title').val()) == ''){
			$('#title-ctrl-grp').addClass('error');
			$('#title-ctrl-grp .help-inline').html('请输入标题');
			checkStatus = false;
			$('#title').focus();
		}else{
			$('#title-ctrl-grp').removeClass('error');
			$('#title-ctrl-grp .help-inline').html('');
		}

		return checkStatus;
	});
	
});
</script>