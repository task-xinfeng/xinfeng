<div class="page-header">
<h1>新风产品列表</h1>
</div>
<div class="container">
	<section id="adminmachinegroups">
		<div style="overflow: hidden;">
			<table class="table table-striped">
				<?php foreach($products as $product):?>
				<tr id="product_<?php echo $product['Product']['id'];?>">
					<td width=30%>
						<?php
							$thumbnail = $this->Phpthumb->generate(
								array(
									'save_path' => WWW_ROOT . IMAGE_ROOT . 'thumbs',     
									'display_path' => '/' . IMAGE_ROOT . 'thumbs',  
									'error_image_path' => '/' . IMAGE_ROOT  . 'logo.jpg',
									'src' => WWW_ROOT . IMAGE_ROOT . PRODUCT . $product['Product']['avatar'],
									'w' => 200, 
									'h' => 200,
									'q' => 100,
									'zc' => 1
								)
							);
						?>
						<?php echo $this->Html->image($thumbnail['src'], array('width' => $thumbnail['w'], 'height' => $thumbnail['h'])); ?>
					</td>
					<td width=70%>
						<ul class="unstyled">
							<li><strong>来    自</strong>：<?php echo $product['Brand']['name'];?></li>
							<li><strong>产品名称</strong>：
								<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "productInfo", "?"=>array("product_id" => $product['Product']['id'])));?>">
									<?php echo $product['Product']['name'];?>
								</a>
							</li>
							<li>
								<strong>产品介绍</strong>：<?php echo $this->StringUtil->sysSubStr($product['Product']['intro'], 1000);?>
							</li>
							<p></p>
							<li>
								<a href="javascript:void(0)" class="btn-mini btn-danger delProduct" data-pname="<?php echo $product['Product']['name'];?>" data-pid="<?php echo $product['Product']['id'];?>">
									删除该产品
								</a>
								&nbsp;
								<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "editProduct", "?"=>array("product_id" => $product['Product']['id'])));?>" class="btn-mini btn-warning">
									编辑该产品
								</a>
							</li>
						</ul>
					</td>
				</tr>
				<?php endforeach;?>
			</table>
			<div class="pagination pagination-right">
				<ul>
				<?php
					$this->Paginator->options(array(
						'url'=> array('controller'=>'dashboard', 'action'=>'products')
					));
				?>
				<?php
					if(count($products) >= 1){
						echo "<li>".$this->Paginator->first("首页")."</li>";
						echo "<li>".$this->Paginator->prev("上一页", null, null, array('class' => 'hide'))."</li>";
						echo "<li>".$this->Paginator->numbers(array('separator'=>'</li><li>'))."</li>";
						echo "<li>".$this->Paginator->next("下一页", null, null, array('class' => 'hide'))."</li>";
						echo "<li>".$this->Paginator->last("末页")."</li>";
						//echo $this->Paginator->counter(array('format' => '%page%/%pages%'));
					}
				?>
				</ul>
			</div>
		</div>
	</section>
</div>


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
	$('.delProduct').click(function(){
		var element = $(this);
		$("#confirmDel").data('pid',element.data('pid'));
		$('#noticeNote').html('确定删除： '+element.data('pname') + ' ?');
		
		$('#noticeDelGroup').modal({'backdrop':true});
		return false;
	});
	
	//no_redirect这个参数随便写，只要带这个参数就跳转，不带这个参数就不跳转
	$('#confirmDel').click(function(){
		var pid = $("#confirmDel").data('pid');
		$.ajax({
					type:		"POST",
					url:		"<?php echo $this->webroot;?>" + "dashboard/delProduct",
					dataType:	"html",
					data:		{	product_id:pid,
									no_redirect:true
								},
					success: 	function(data,textStatus){
									$('#product_'+pid).remove();
									$("#confirmDel").removeAttr('pid');
									$('#noticeNote').html('');
								}
				});
	});
	
	//取消删除
	$('#cancelDel').click(function(){
		$("#confirmDel").removeAttr('pid');
		$('#noticeNote').html('');
	});
});
</script>