<div class="container content">
	<div class="page-header">
		<h1><?php echo $brand['Brand']['name'];?> - 新增新风产品</h1>
	</div>
	<div>
		<form class="form-horizontal" action="<?php echo $this->webroot?>dashboard/saveProduct" method="POST" enctype="multipart/form-data">
			<fieldset>
				<div class="control-group" id="name-ctrl-grp">
					<label class="control-label">产品名称（必填）</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="name" value="" name="name">
						<span class="help-inline"></span>
					</div>
				</div>
				<div class="control-group" id="logo-ctrl-grp">
					<label class="control-label">品牌图片(必填)</label>
					<div class="controls">
						<input type="file" class="input-file" id="avatar" name="avatar">
						<span class="help-inline"></span>
						<span class="help-inline2">注意，图片格式为jpg或者png，尺寸150*58</span>
					</div>
				</div>
				<div class="control-group" id="intro-ctrl-grp">
					<label class="control-label">品牌简介（必填）</label>
					<div class="controls">
						<textarea style="width:600px;height:300px;visibility:hidden;" id="intro" name="intro"></textarea>
						<span class="help-inline"></span>
					</div>
				</div>
				<div class="form-actions">
					<input type='hidden' name="brand_id" value="<?php echo $brand['Brand']['id'];?>">
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
		editor = K.create('textarea[name="intro"]', {
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

	$('#name').focus();
	
	$('#save').click(function(){
		var checkStatus = true;
		
		//验证产品名称有没有输入
		if($.trim($('#name').val()) == ''){
			$('#name-ctrl-grp').addClass('error');
			$('#name-ctrl-grp .help-inline').html('请输入产品名称');
			checkStatus = false;
			$('#name').focus();
		}else{
			$('#name-ctrl-grp').removeClass('error');
			$('#name-ctrl-grp .help-inline').html('');
		}
		
		//验证产品LOGO有没有
		logoFile = $.trim($("#avatar").val());
		logoFileArr = logoFile.split('.');
		//alert(logoFileArr[1]);
		if(logoFile == ''){
			$('#logo-ctrl-grp').addClass('error');
			$('#logo-ctrl-grp .help-inline').html('请上传产品图片');
			checkStatus = false;
		}else if(logoFileArr.length<2){
			$('#logo-ctrl-grp').addClass('error');
			$('#logo-ctrl-grp .help-inline').html('文件格式错误');
			checkStatus = false;
		}else if(logoFileArr[1]!='jpg' && logoFileArr[1]!='png'){
			$('#logo-ctrl-grp').addClass('error');
			$('#logo-ctrl-grp .help-inline').html('图片只能是jpg或者png格式');
			checkStatus = false;
		}else{
			$('#logo-ctrl-grp').removeClass('error');
			$('#logo-ctrl-grp .help-inline').html('');
		}
		
		//验证产品介绍有没有输入
		/*if($.trim($('#intro').val()) == ''){
			$('#intro-ctrl-grp').addClass('error');
			$('#intro-ctrl-grp .help-inline').html('请输入产品介绍');
			checkStatus = false;
			$('#intro').focus();
		}else{
			$('#intro-ctrl-grp').removeClass('error');
			$('#intro-ctrl-grp .help-inline').html('');
		}*/

		return checkStatus;
	});
	
});
</script>