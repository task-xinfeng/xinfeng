<div class="container">	<section id="adminmachinegroups">		<div style="overflow: hidden;">			<table class="table table-striped">				<?php foreach($products as $product):?>				<tr>					<td width=30%>						<?php							$thumbnail = $this->Phpthumb->generate(								array(									'save_path' => WWW_ROOT . IMAGE_ROOT . 'thumbs',     									'display_path' => '/' . IMAGE_ROOT . 'thumbs',  									'error_image_path' => '/' . IMAGE_ROOT  . 'logo.jpg',									'src' => WWW_ROOT . IMAGE_ROOT . PRODUCT . $product['Product']['avatar'],									'w' => 200, 									'h' => 200,									'q' => 100,									'zc' => 1								)							);						?>						<?php echo $this->Html->image($thumbnail['src'], array('width' => $thumbnail['w'], 'height' => $thumbnail['h'])); ?>					</td>					<td width=70%>						<ul class="unstyled">							<li>								<strong>产品名称</strong>：								<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "productInfo", "?"=>array("product_id" => $product['Product']['id'])));?>">									<?php echo $product['Product']['name'];?>								</a>							</li>							<li>								<strong>产品介绍</strong>：<?php echo $this->StringUtil->sysSubStr($product['Product']['intro'], 1000);?>							</li>							<p></p>							<li>								<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "delProduct", "?"=>array("product_id" => $product['Product']['id'])));?>" class="btn-mini btn-danger">									删除产品								</a>								&nbsp;								<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "editProduct", "?"=>array("product_id" => $product['Product']['id'])));?>" class="btn-mini btn-warning" title="编辑产品">									编辑产品								</a>							</li>						</ul>					</td>				</tr>				<?php endforeach;?>			</table>			<p align='right'>				<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "addProduct", "?"=>array("brand_id" => $brand_id)));?>" class="btn-small btn-success">					+新增一个产品				</a>			</p>		</div>	</section></div>