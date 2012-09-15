<ul class="breadcrumb">
	<li>
		<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "index"));?>">
			品牌管理
		</a> <span class="divider">/</span>
	</li>
	<li>
		<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "brandInfo", "?"=>array("brand_id" => $brand['Brand']['id'])));?>">
			<?php echo $brand['Brand']['name'];?>
		</a> <span class="divider">/</span>
	</li>
	<li class="active">
		经销商管理
	</li>
</ul>


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
		<table class="table table-striped">
			<tr>
				<th width=10%>品牌名称</th>
				<td><?php echo $brand['Brand']['name'];?></td>
			</tr>
			<tr>
				<th width=10%>品牌网址</th>
				<td><?php echo $brand['Brand']['url'];?></td>
			</tr>
			<tr>
				<th width=10%>品牌权重</th>
				<td><?php echo $brand['Brand']['weight'];?></td>
			</tr>
			<tr>
				<th width=10%>品牌介绍</th>
				<td><?php echo $brand['Brand']['intro'];?></td>
			</tr>
		</table>
	</div>
</div>

<h3>新风全国经销商</h3>
<table class="table table-striped">
	<tr>
		<th width=70%>经销商名称</th>
		<td width=30%>
			状态
			<span class="label label-success"><i class="icon-ok icon-white"></i></span>已经是经销商 |
			<span class="label label-warning"><i class="icon-question-sign icon-white"></i></span>还不是经销商
		</td>
	</tr>
	<?php foreach($dealers as $dealer):?>
	<tr>
		<td>
			[<?php echo $dealer['Dealer']['prov'];?> - <?php echo $dealer['Dealer']['city'];?>]
			&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $dealer['Dealer']['name'];?> 
		</th>
		<td>
		<?php if(in_array($dealer['Dealer']['id'], $dealerIdArray)){?>
			<span class="label label-success"><i class="icon-ok icon-white"></i></span>
			<a href="#" class="unbind" data-did="<?php echo $dealer['Dealer']['id'];?>">解除合作</a>
		<?php }else{?>
			<span class="label label-warning"><i class="icon-question-sign icon-white"></i></span>
			<a href="javascript:void(0);" class="bind" data-did="<?php echo $dealer['Dealer']['id'];?>">成为经销商</a>
		<?php }?>
		</td>
	</tr>
	<?php endforeach;?>
</table>
<script>
$(function () {
	/*成为经销商*/
	$('.bind').click(function(){
		var element = $(this);
		$.ajax({
					type:		"POST",
					url:		"<?php echo $this->webroot;?>" + "dashboard/bindDealer",
					dataType:	"html",
					data:		{	brand_id:<?php echo $brand['Brand']['id'];?>,
									dealer_id:element.data('did')
								},
					success: 	function(data,textStatus){
									window.location.reload();
								}
				});
	});
	
	/*解除合作*/
	$('.unbind').click(function(){
		var element = $(this);
		$.ajax({
					type:		"POST",
					url:		"<?php echo $this->webroot;?>" + "dashboard/unbindDealer",
					dataType:	"html",
					data:		{	brand_id:<?php echo $brand['Brand']['id'];?>,
									dealer_id:element.data('did')
								},
					success: 	function(data,textStatus){
									window.location.reload();
								}
				});
	});
});
</script>