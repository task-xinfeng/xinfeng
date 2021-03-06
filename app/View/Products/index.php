<!--top 广告-->
<div class="p_slide block_center">
	<ul class="p_ul">
    	<li>
        	<a href="#"><img src="#" /></a>
        </li>
    </ul>
    <ul class="c_ul clearfix">
    	<li>1</li>
        <li class="current">2</li>
    </ul>
</div>
<!--top 广告 ends-->

<!--面包屑-->
<div class="page_route block_center">
	<a href="<?php echo $this->webroot;?>">首页</a>
		<span class="arr">/</span>
	<?php if(isset($brand)){?>
		<a href="<?php echo $this->Html->url(array("controller" => "brands","action" => "item", "?"=>array("bid" => $brand['Brand']['id'])));?>"><?php echo $brand['Brand']['name'];?></a>
		<span class="arr">/</span>
		<span class="current">新风产品</span>
	<?php }else{?>
		<a href="<?php echo $this->Html->url(array("controller" => "products","action" => ""));?>">
			新风产品
		</a>
	<?php }?>
</div>
<!--面包屑 ends-->

<div class="content block_center products clearfix">
	<div class="cmain">
    	<!--摘要列表-->
    	<div class="summary_list_block">	
        	<ul class="summary_list">
				<?php foreach($products as $product):?>
            	<li>
                	<h2 class="stitle">
						<a href="<?php echo $this->Html->url(array("controller" => "products","action" => "item", "?"=>array("pid" => $product['Product']['id'])));?>">
							<?php echo $product['Product']['name'];?>
						</a>
					</h2>
                    <dl class="sinfo clearfix">
                    	<dd class="brand"><span class="icon"></span>
							<?php echo $product['Brand']['name'];?>
						</dd>
                        <dd class="total"><span class="icon"></span>
							<?php echo $product['Product']['clicks'];?>次浏览
						</dd>
                        <dd class="date"><span class="icon"></span>
							<?php echo date('Y年m月d日', strtotime($product['Product']['created'])); ?>
						</dd>
                    </dl>
                    <div class="smain clearfix">
                    	<div class="thumb">
							<?php
								$thumbnail = $this->Phpthumb->generate(
									array(
										'save_path' => WWW_ROOT . IMAGE_ROOT . 'thumbs',     
										'display_path' => '/' . IMAGE_ROOT . 'thumbs',  
										'error_image_path' => '/' . IMAGE_ROOT  . 'default.jpg',
										'src' => WWW_ROOT . IMAGE_ROOT . PRODUCT . $product['Product']['avatar'],
										'w' => 200, 
										'h' => 200,
										'q' => 100,
										'zc' => 1
									)
								);
							?>
							<?php echo $this->Html->image($thumbnail['src'], array('width' => $thumbnail['w'], 'height' => $thumbnail['h'])); ?>
                        </div>
                        <div class="para">
                        	<p><?php //echo $this->StringUtil->sysSubStr($product['Product']['intro'],800);?></p>
							<p><?php echo $this->StringUtil->blog_summary($product['Product']['intro'],400);?></p>
                        </div>
                    </div>
                </li>
				<?php endforeach;?>
            </ul>
            <div class="paging_con clearfix">
                <ul class="paging">
                    <?php
						if(isset($brand)){
							$this->Paginator->options(array(
								'url'=> array('controller'=>'products', 'action'=>'index/bid:'.$brand['Brand']['id'])
							));
						}else{
							$this->Paginator->options(array(
								'url'=> array('controller'=>'products', 'action'=>'index')
							));
						}
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
        <!--摘要列表 ends-->
    </div>

	<div class="cside">
    	<?php if(!isset($brand)){?>
        <div class="block_cside side_a_240 block_cside">
        	
        </div>
        <?php }else{?>
        <div class="cside_thumb_240_block block_cside ">
        	<ul class="cside_thumb_240_ul">
            	<li>
                    <h2>
						<a href="<?php echo $this->Html->url(array("controller" => "brands","action" => "item", "?"=>array("bid" => $brand['Brand']['id'])));?>">
							<?php echo $brand['Brand']['name'];?>
						</a>
					</h2>
                    <div class="pic">
						<a href="<?php echo $this->Html->url(array("controller" => "brands","action" => "item", "?"=>array("bid" => $brand['Brand']['id'])));?>">
							<img src="<?php echo $this->webroot;?>img/brand/<?php echo $brand['Brand']['logo'];?>" width="240" height="218"/>
						</a>
					</div>
                    <div class="figures clearfix">
                        <div class="num_item">
                            <span class="num">
								<a href="<?php echo $this->Html->url(array("controller" => "products","action" => "index", "?"=>array("bid" => $brand['Brand']['id'])));?>">
									<?php echo count($brand['Product']);?>
								</a>
							</span>
                            <div class="t">新风产品</div>
                        </div>
                        <div class="num_item">
                            <span class="num">
								<a href="<?php echo $this->Html->url(array("controller" => "articles","action" => "news", "?"=>array("bid" => $brand['Brand']['id'])));?>">
									<?php echo count($brand['Article']);?>
								</a>
							</span>
                            <div class="t">新闻导购</div>
                        </div>
                        <div class="num_item">
                            <span class="num">
								<a href="javascript:void(0);">
									<?php echo count($brand['BrandDealerMap']);?>
								</a>
							</span>
                            <div class="t">经销商</div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
		<?php }?>
        
    </div>

</div>