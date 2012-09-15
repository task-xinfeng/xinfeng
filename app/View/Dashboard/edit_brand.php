<div class="page-header">
<h1>编辑 - <?php echo $brand['Brand']['name'];?></h1>
</div>
<div class="row">
	<div class="span3">
		<?php
			$thumbnail = $this->Phpthumb->generate(
				array(
					'save_path' => WWW_ROOT . IMAGE_ROOT . 'thumbs',     
					'display_path' => '/' . IMAGE_ROOT . 'thumbs',  
					'error_image_path' => '/' . IMAGE_ROOT  . 'logo.jpg',
					'src' => WWW_ROOT . IMAGE_ROOT . BRAND . $brand['Brand']['logo'],
					'w' => 150, 
					'h' => 58,
					'q' => 100,
					'zc' => 1
				)
			);
		?>
		<?php echo $this->Html->image($thumbnail['src'], array('width' => $thumbnail['w'], 'height' => $thumbnail['h'])); ?>
	</div>
	<div class="span9">
	<form class="form-horizontal" action="<?php echo $this->webroot?>dashboard/updateBrand" method="POST" enctype="multipart/form-data">
		<table class="table table-striped">
			<tr>
				<th width=10%>品牌标识</th>
				<td><input type="file" class="input-file" id="avatar" name="avatar">
				&nbsp;&nbsp;<span class="label label-important">如不需换logo，请勿选择!</span></td>
			</tr>
			<tr>
				<th width=10%>品牌名称</th>
				<td><input type="text" class="input-xlarge" id="name" value="<?php echo $brand['Brand']['name'];?>" name="name"></td>
			</tr>
			<tr>
				<th width=10%>品牌网址</th>
				<td><input type="text" class="input-xlarge" id="url" value="<?php echo $brand['Brand']['url'];?>" name="url"></td>
			</tr>
			<tr>
				<th width=10%>品牌权重</th>
				<td>
					<button class="btn btn-mini" id="btn_dec">-</button>
					<input type="text" class="input-mini uneditable-input" id="weight" value="<?php echo $brand['Brand']['weight'];?>" name="weight">
					<button class="btn btn-mini" id="btn_inc">+</button>
				</td>
			</tr>
			<tr>
				<th width=10%>品牌介绍</th>
				<td><textarea rows="8" id="intro" class="input-xxlarge" name="intro"><?php echo $brand['Brand']['intro'];?></textarea></td>
			</tr>
			<tr>
				<th width=10%></th>
				<td>
					<input type="hidden" name="brand_id" value="<?php echo $brand['Brand']['id'];?>">
					<button class="btn btn-primary" type="submit" id="save">保存</button>
				</td>
			</tr>
		</table>
		</form>
	</div>
</div>

<script type="text/javascript">
$(function(){
	$("#btn_dec").click(function(){
		if(parseInt($("#weight").val()) >= 5){
			$("#weight").val(parseInt($("#weight").val()) - 5);
		}
		return false;
	});
	
	$("#btn_inc").click(function(){
		if(parseInt($("#weight").val()) <= 95){
			$("#weight").val(parseInt($("#weight").val()) + 5);
		}
		return false;
	});
	
	$('#save').click(function(){
		var checkStatus = true;
		
		//验证品牌名称有没有输入
		if($.trim($('#name').val()) == ''){
			alert('请输入品牌名称');
			checkStatus = false;
			$('#name').focus();
		}
		
		//验证品牌权重有没有输入
		if($.trim($('#weight').val()) == ''){
			alert('请输入品牌权重');
			checkStatus = false;
			$('#weight').focus();
		}
		
		//验证品牌LOGO有没有
		logoFile = $.trim($("#avatar").val());
		logoFileArr = logoFile.split('.');
		//alert(logoFileArr[1]);
		if(logoFile != ''){
			if(logoFileArr.length<2){
				alert('文件格式错误');
				checkStatus = false;
			}else if(logoFileArr[1]!='jpg' && logoFileArr[1]!='png'){
				alert('Logo只能是jpg或者png格式');
				checkStatus = false;
			}else{
				
			}
		} 
		
		//验证品牌介绍有没有输入
		if($.trim($('#intro').val()) == ''){
			alert('请输入品牌介绍');
			checkStatus = false;
			$('#intro').focus();
		}

		return checkStatus;
	});
	
});
</script>