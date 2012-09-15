<div class="page-header">
<h1>新风品牌列表</h1>
</div>
<table class="table table-bordered">
<tr>
	<th>品牌ID</th>
	<th>品牌权重</th>
	<th>品牌Logo</th>
	<th>品牌名称</th>
	<th>经销商数量</th>
	<th>新闻/导购数量</th>
	<th>产品数量</th>
	<th>操作</th>
</tr>
<?php foreach($brands as $brand):?>
<tr id="brand_<?php echo $brand['Brand']['id'];?>">
	<td># <?php echo $brand['Brand']['id'];?></td>
	<td><?php echo $brand['Brand']['weight'];?></td>
	<td>
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
		<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "brandInfo", "?"=>array("brand_id" => $brand['Brand']['id'])));?>">
		<?php echo $this->Html->image($thumbnail['src'], array('width' => $thumbnail['w'], 'height' => $thumbnail['h'])); ?>
		</a>
	</td>
	<td>
		<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "brandInfo", "?"=>array("brand_id" => $brand['Brand']['id'])));?>">
		<?php echo $brand['Brand']['name'];?>
		</a>
	</td>
	<td><?php echo count($brand['BrandDealerMap']);?></td>
	<td><?php echo count($brand['Article']);?></td>
	<td><?php echo count($brand['Product']);?></td>
	<td>
		<a href="javascript:void(0);" class="btn-small btn-danger delBrand" title="危险操作，请谨慎" data-bname="<?php echo $brand['Brand']['name'];?>" data-bid="<?php echo $brand['Brand']['id'];?>">
			删除品牌
		</a>
		&nbsp;
		<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "editBrand", "?"=>array("brand_id" => $brand['Brand']['id'])));?>" class="btn-small btn-warning" title="编辑品牌基本信息">
			编辑该品牌
		</a>
	</td>
</tr>
<?php endforeach;?>
</table>
<p align='right'>
	<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "addBrand"));?>" class="btn-small btn-success">
		+新增品牌
	</a>
</p>

<!--弹出警告框-->
<div class="modal hide fade" id="noticeDelGroup">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>提醒 - 确认删除操作？</h3>
  </div>
  <div class="modal-body">
    <p id="noticeNote"></p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal" id="confirmDel">确认删除</a>
    <a href="#" class="btn btn-primary" data-dismiss="modal" id="cancelDel">等等，取消删除</a>
  </div>
</div>

<script type="text/javascript">
$(function(){
	
	/*confirm删除*/
	$('.delBrand').click(function(){
		var element = $(this);
		$("#confirmDel").data('bid',element.data('bid'));
		$('#noticeNote').html('确定删除新风品牌： '+element.data('bname') + ' ?');
		
		$('#noticeDelGroup').modal({'backdrop':true});
		return false;
	});
	
	//no_redirect这个参数随便写，只要带这个参数就跳转，不带这个参数就不跳转
	$('#confirmDel').click(function(){
		var bid = $("#confirmDel").data('bid');
		$.ajax({
					type:		"POST",
					url:		"<?php echo $this->webroot;?>" + "dashboard/delBrand",
					dataType:	"html",
					data:		{	brand_id:bid,
									no_redirect:true
								},
					success: 	function(data,textStatus){
									$('#brand_'+bid).remove();
									$("#confirmDel").removeAttr('bid');
									$('#noticeNote').html('');
								}
				});
	});
	
	//取消删除
	$('#cancelDel').click(function(){
		$("#confirmDel").removeAttr('bid');
		$('#noticeNote').html('');
	});
});
</script>