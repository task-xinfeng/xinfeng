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

<div class="content block_center brands">

<!--品牌缩略图列表-->
<div class="block_center thumb_320_block">
	<ul class="thumb_320_ul clearfix">
		<?php $index = 0;?>
		<?php foreach($brands as $brand):?>
		<?php $index += 1;?>
		<li <?php if($index%3 == 0){echo "class='right'";}?>>
        	<h2>
				<a href="<?php echo $this->Html->url(array("controller" => "brands","action" => "item", "?"=>array("bid" => $brand['Brand']['id'])));?>">
					<?php echo $brand['Brand']['name'];?>
				</a>
			</h2>
            <div class="pic">
				<a href="<?php echo $this->Html->url(array("controller" => "brands","action" => "item", "?"=>array("bid" => $brand['Brand']['id'])));?>">
					<img src="<?php echo $this->webroot;?>img/brand/<?php echo $brand['Brand']['avatar'];?>" width="320" height="290"/>
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
            <div class="shadow"></div>
        </li>
		<?php endforeach;?>
    </ul>
</div>
<!--品牌缩略图列表 ends-->

</div>