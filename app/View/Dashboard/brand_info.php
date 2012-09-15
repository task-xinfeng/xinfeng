<ul class="breadcrumb">
	<li>
		<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "index"));?>">
			品牌管理
		</a> <span class="divider">/</span>
	</li>
	<li class="active"><?php echo $brand['Brand']['name'];?></li>
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
			<tr>
				<th width=10%>危险操作</th>
				<td>
					<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "delBrand", "?"=>array("brand_id" => $brand['Brand']['id'])));?>" class="btn-small btn-danger" title="危险操作，请谨慎" onClick="return confirm('确定删除？所有关联数据将全部删除！')">
						删除该品牌
					</a>
					&nbsp;
					<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "editBrand", "?"=>array("brand_id" => $brand['Brand']['id'])));?>" class="btn-small btn-warning" title="编辑品牌基本信息">
						编辑该品牌
					</a>
				</td>
			</tr>
			<tr>
				<th width=10%>快捷添加</th>
				<td>
					<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "addProduct", "?"=>array("brand_id" => $brand['Brand']['id'])));?>" class="btn-small btn-success">
						+添加产品
					</a>
					&nbsp;
					<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "addArticle", "?"=>array("brand_id" => $brand['Brand']['id'], 'type' => 'guide')));?>" class="btn-small btn-success">
						+添加导购
					</a>
					&nbsp;
					<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "addArticle", "?"=>array("brand_id" => $brand['Brand']['id'], 'type' => 'news')));?>" class="btn-small btn-success">
						+添加新闻
					</a>
				</td>
			</tr>
			<tr>
				<th width=10%>快捷管理</th>
				<td>
					<a href=<?php echo $this->Html->url(array("controller" => "dashboard","action" => "brandDealers", "?"=>array("brand_id" => $brand['Brand']['id'])));?> class="btn-small btn-info">
						+管理经销商
					</a>
				</td>
			</tr>
		</table>
	</div>
</div>

<ul class="nav nav-tabs">
<li class="active">
<a href="#" data-toggle="tab" data-target='#products' fun='getProductsByBrand'>
产品</a>
</li>
<li><a href="#" data-toggle="tab" data-target='#news' fun='getNewsByBrand'>新闻</a></li>
<li><a href="#" data-toggle="tab" data-target='#guides' fun='getGuidesByBrand'>导购</a></li>
<li><a href="#" data-toggle="tab" data-target='#dealers' fun='getDealersByBrand'>经销商(只读)</a></li>
</ul>

<div class="tab-content">
<div class="tab-pane active" id="products"></div>
<div class="tab-pane" id="news"></div>
<div class="tab-pane" id="guides"></div>
<div class="tab-pane" id="dealers"></div>
</div>

<script>
$(function () {
	//默认加载该品牌的所有商品
	$('#products').load("<?php echo $this->webroot;?>" + "dashboard/getProductsByBrand",
		{
			"brand_id":"<?php echo $brand['Brand']['id'];?>"
		},function(){
			//$('#loadingImg').hide();
		}
	);
	
    $('a[data-toggle="tab"]').on('show', function (e) {
		//alert(e.target); // activated tab
		//alert(e.relatedTarget); // previous tab
		$($(this).attr('data-target')).load("<?php echo $this->webroot;?>" + "dashboard/" + $(this).attr('fun'),
			{
				"brand_id":"<?php echo $brand['Brand']['id'];?>"
			},function(){
				//$('#loadingImg').hide();
			}
		);
    })
});
</script>