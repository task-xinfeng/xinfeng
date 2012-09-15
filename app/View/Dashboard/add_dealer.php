<div class="container content">
	<div class="page-header">
		<h1>新增经销商</h1>
	</div>
	<div>
		<form class="form-horizontal" action="<?php echo $this->webroot?>dashboard/saveDealer" method="POST" enctype="multipart/form-data">
			<fieldset>
				<div class="control-group" id="name-ctrl-grp">
					<label class="control-label">经销商名称（必填）</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="name" value="" name="name">
						<span class="help-inline"></span>
					</div>
				</div>
				<div class="control-group" id="intro-ctrl-grp">
					<label class="control-label">经销商简介（必填）</label>
					<div class="controls">
						<textarea rows="8" id="intro" class="input-xlarge" name="intro"></textarea>
						<span class="help-inline"></span>
					</div>
				</div>
				
				<div class="control-group" id="city-ctrl-grp">
					<label class="control-label">经销商位置（必填）</label>
					<div class="controls">
						<select class="prov span2" name="prov" id="prov"><option value="">请选择</option></select>
						<select class="city span2" name="city" id="city" disabled="disabled"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				
				<div class="control-group" id="address-ctrl-grp">
					<label class="control-label">经销商地址（必填）</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="address" value="" name="address">
						<span class="help-inline"></span>
					</div>
				</div>
				
				<div class="control-group" id="tel-ctrl-grp">
					<label class="control-label">经销商电话（必填）</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="tel" value="" name="tel">
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

<?php echo $this->Html->script(array('jquery.cityselect')); ?>
<script type="text/javascript">
$(function(){
	$("#city-ctrl-grp").citySelect();
	
	$('#name').focus();
	
	$('#save').click(function(){
		var checkStatus = true;
		
		//验证经销商名称有没有输入
		if($.trim($('#name').val()) == ''){
			$('#name-ctrl-grp').addClass('error');
			$('#name-ctrl-grp .help-inline').html('请输入经销商名称');
			checkStatus = false;
			$('#name').focus();
		}else{
			$('#name-ctrl-grp').removeClass('error');
			$('#name-ctrl-grp .help-inline').html('');
		}
		
		//验证经销商介绍有没有输入
		if($.trim($('#intro').val()) == ''){
			$('#intro-ctrl-grp').addClass('error');
			$('#intro-ctrl-grp .help-inline').html('请输入经销商介绍');
			checkStatus = false;
			$('#intro').focus();
		}else{
			$('#intro-ctrl-grp').removeClass('error');
			$('#intro-ctrl-grp .help-inline').html('');
		}
		
		//验证经销商省份城市有没有输入
		if($.trim($('#prov').val()) == ''){
			$('#city-ctrl-grp').addClass('error');
			$('#city-ctrl-grp .help-inline').html('请选择经销商所在的省份城市');
			checkStatus = false;
		}else{
			$('#city-ctrl-grp').removeClass('error');
			$('#city-ctrl-grp .help-inline').html('');
		}
		
		//验证经销商地址有没有输入
		if($.trim($('#address').val()) == ''){
			$('#address-ctrl-grp').addClass('error');
			$('#address-ctrl-grp .help-inline').html('请输入经销商介绍');
			checkStatus = false;
			$('#address').focus();
		}else{
			$('#address-ctrl-grp').removeClass('error');
			$('#address-ctrl-grp .help-inline').html('');
		}
		
		//验证经销商地址有没有输入
		if($.trim($('#tel').val()) == ''){
			$('#tel-ctrl-grp').addClass('error');
			$('#tel-ctrl-grp .help-inline').html('请输入经销商介绍');
			checkStatus = false;
			$('#tel').focus();
		}else{
			$('#tel-ctrl-grp').removeClass('error');
			$('#tel-ctrl-grp .help-inline').html('');
		}

		return checkStatus;
	});
	
});
</script>