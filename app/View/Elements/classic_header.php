<div class="header block_center">
	<div class="logo">
    	<a href="#"></a>
    </div>
	<div class="header_nav">
    	<ul class="header_nav_ul clearfix">
			<li>
				<a href="<?php echo $this->Html->url(array("controller" => "pages","action" => "index"));?>">
					首页
				</a>
			</li>
        	<li>
				<a href="<?php echo $this->Html->url(array("controller" => "brands","action" => "index"));?>">
					新风品牌
				</a>
			</li>
            <li>
				<a href="<?php echo $this->Html->url(array("controller" => "articles","action" => "news"));?>">	
					行业新闻
				</a>
			</li>
            <li>
				<a href="<?php echo $this->Html->url(array("controller" => "articles","action" => "guides"));?>">	
					产品导购
				</a>
			</li>
            <li>
				<a href="<?php echo $this->Html->url(array("controller" => "products","action" => "index"));?>">	
					新风产品
				</a>
			</li>
        </ul>
    </div>
</div>