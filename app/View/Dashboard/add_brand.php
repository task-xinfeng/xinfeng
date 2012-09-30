<div class="container content">
	<div class="page-header">
		<h1>新增新风品牌</h1>
	</div>
	<div>
		<form class="form-horizontal" action="<?php echo $this->webroot?>dashboard/saveBrand" method="POST" enctype="multipart/form-data">
			<fieldset>
				<div class="control-group" id="name-ctrl-grp">
					<label class="control-label">品牌名称（中英文，必填）</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="name" value="" name="name">
						<span class="help-inline"></span>
					</div>
				</div>
				<div class="control-group" id="logo-ctrl-grp">
					<label class="control-label">品牌LOGO(必填)</label>
					<div class="controls">
						<input type="file" class="input-file" id="logo" name="logo">
						<span class="help-inline"></span>
						<span class="help-inline2">注意，图片格式为jpg或者png，尺寸320*290</span>
					</div>
				</div>
				<div class="control-group" id="logo-ctrl-grp">
					<label class="control-label">品牌Avatar(必填)</label>
					<div class="controls">
						<input type="file" class="input-file" id="avatar" name="avatar">
						<span class="help-inline"></span>
						<span class="help-inline2">注意，图片格式为jpg或者png，尺寸320*290</span>
					</div>
				</div>
				<div class="control-group" id="intro-ctrl-grp">
					<label class="control-label">品牌简介（必填）</label>
					<div class="controls">
						<textarea rows="8" id="intro" class="input-xlarge" name="intro"></textarea>
						<span class="help-inline"></span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">品牌网址（选填）</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="url" value="" name="url">
						<span class="help-inline"></span>
					</div>
				</div>
				<div class="form-actions">
					<button class="btn btn-primary" type="submit" id="save">保存</button>
				</div>
			</fieldset>
		</form>
	</div>
</div>

<script type="text/javascript">
$(function(){

	$('#name').focus();
	
	$('#save').click(function(){
		var checkStatus = true;
		
		//验证品牌名称有没有输入
		if($.trim($('#name').val()) == ''){
			$('#name-ctrl-grp').addClass('error');
			$('#name-ctrl-grp .help-inline').html('请输入品牌名称');
			checkStatus = false;
			$('#name').focus();
		}else{
			$('#name-ctrl-grp').removeClass('error');
			$('#name-ctrl-grp .help-inline').html('');
		}
		
		//验证品牌LOGO有没有
		logoFile = $.trim($("#avatar").val());
		logoFileArr = logoFile.split('.');
		//alert(logoFileArr[1]);
		if(logoFile == ''){
			$('#logo-ctrl-grp').addClass('error');
			$('#logo-ctrl-grp .help-inline').html('请上传品牌图片');
			checkStatus = false;
		}else if(logoFileArr.length<2){
			$('#logo-ctrl-grp').addClass('error');
			$('#logo-ctrl-grp .help-inline').html('文件格式错误');
			checkStatus = false;
		}else if(logoFileArr[1]!='jpg' && logoFileArr[1]!='png'){
			$('#logo-ctrl-grp').addClass('error');
			$('#logo-ctrl-grp .help-inline').html('Logo只能是jpg或者png格式');
			checkStatus = false;
		}else{
			$('#logo-ctrl-grp').removeClass('error');
			$('#logo-ctrl-grp .help-inline').html('');
		}
		
		//验证品牌介绍有没有输入
		if($.trim($('#intro').val()) == ''){
			$('#intro-ctrl-grp').addClass('error');
			$('#intro-ctrl-grp .help-inline').html('请输入品牌介绍');
			checkStatus = false;
			$('#intro').focus();
		}else{
			$('#intro-ctrl-grp').removeClass('error');
			$('#intro-ctrl-grp .help-inline').html('');
		}

		return checkStatus;
	});
	
});
</script>