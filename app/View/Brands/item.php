<div class="content block_center brands_item">

    <!--品牌简介-->
    <div class="block_center brands_item_summary">
        <h1 class="brands_item_title">
        	<span class="t"><?php echo $brand['Brand']['name'];?></span>
            <dl class="figures clearfix">
            	<dd class="num_item">
                	<span class="num"><?php echo count($brand['Product']);?></span>
                    <p>新风产品</p>
                </dd>
                <dd class="num_item">
                	<span class="num"><?php echo count($brand['Article']);?></span>
                    <p>新闻导购</p>
                </dd>
                <dd class="num_item">
                	<span class="num"><?php echo count($brand['BrandDealerMap']);?></span>
                    <p>经销商</p>
                </dd>
            </dl>
        </h1>
        <div class="brands_item_des clearfix">
        	<div class="pic">
				<?php
					$thumbnail = $this->Phpthumb->generate(
						array(
							'save_path' => WWW_ROOT . IMAGE_ROOT . 'thumbs',     
							'display_path' => '/' . IMAGE_ROOT . 'thumbs',  
							'error_image_path' => '/' . IMAGE_ROOT  . 'default.jpg',
							'src' => WWW_ROOT . IMAGE_ROOT . BRAND . $brand['Brand']['logo'],
							'w' => 165, 
							'h' => 150,
							'q' => 100,
							'zc' => 1
						)
					);
				?>
				<?php echo $this->Html->image($thumbnail['src'], array('width' => $thumbnail['w'], 'height' => $thumbnail['h'])); ?>
			</div>
            <div class="des_content">
            	<p><strong>品牌故事：</strong><?php echo $brand['Brand']['intro'];?></p>
				<p><strong>品牌网址：</strong>
					<a href="<?php echo $brand['Brand']['url'];?>" target="__blank">
						<?php echo $brand['Brand']['url'];?>
					</a>
				</p>
            </div>
        </div>
    </div>
    <!--品牌缩略图列表 ends-->
    
    <!--宽度是240px的缩略图列表-->
    <div class="block_center thumb_240_block">
    	<div class="top_title top_title_orange">
        	<h2>产品</h2>
            <span class="more">
				<a href="<?php echo $this->Html->url(array("controller" => "products","action" => "index", "?"=>array("bid" => $brand['Brand']['id'])));?>">更多</a>
			</span>
        </div>
    	<ul class="thumb_240_ul clearfix">
			<?php $index=0;?>
			<?php foreach($brand['Product'] as $product):?>
			<?php $index+=1;?>
			<?php if($index>8){break;}?>
    		<li <?php if($index%4==0){echo "class='right'";}?>>
            	<div class="pic">
					<a href="<?php echo $this->Html->url(array("controller" => "products","action" => "item", "?"=>array("pid" => $product['id'])));?>">
						<?php
							$thumbnail = $this->Phpthumb->generate(
								array(
									'save_path' => WWW_ROOT . IMAGE_ROOT . 'thumbs',     
									'display_path' => '/' . IMAGE_ROOT . 'thumbs',  
									'error_image_path' => '/' . IMAGE_ROOT  . 'default.jpg',
									'src' => WWW_ROOT . IMAGE_ROOT . PRODUCT . $product['avatar'],
									'w' => 240, 
									'h' => 225,
									'q' => 100,
									'zc' => 1
								)
							);
						?>
						<?php echo $this->Html->image($thumbnail['src'], array('width' => $thumbnail['w'], 'height' => $thumbnail['h'])); ?>
					</a>
				</div>
                <h2 class="t">
                	<a href="<?php echo $this->Html->url(array("controller" => "products","action" => "item", "?"=>array("pid" => $product['id'])));?>">
						<?php echo $product['name'];?>
					</a>
                </h2>
            </li>
			<?php endforeach;?>
        </ul>
    </div>
    <!--宽度是240px的缩略图列表 ends-->

	<!--新闻列表 & 导购列表-->
    <div class="block_center news_con clearfix">
    	<div class="list_con news_block">
        	<div class="top_title">
            	<h2>新闻</h2>
					<span class="more">
						<a href="<?php echo $this->Html->url(array("controller" => "articles","action" => "news", "?"=>array("bid" => $brand['Brand']['id'])));?>">更多</a>
					</span>
            </div>
            <ul class="list">
				<?php $index=0;?>
				<?php foreach($brand['Article'] as $article):?>
				<?php if($article['type']!='news'){continue;}?>
				<?php $index+=1;?>
				<?php if($index>12){break;}?>
            	<li class="item">
					<a href="<?php echo $this->Html->url(array("controller" => "articles","action" => "item", "?"=>array("aid" => $article['id'])));?>">
						<?php echo $this->StringUtil->sysSubStr($article['title'],70);?>
					</a>
					<span class="date">
						<?php echo date('Y-m-d', strtotime($article['created'])); ?>
					</span>
				</li>
                <?php endforeach;?>
            </ul>
        </div>
        <div class="list_con guide_block">
        	<div class="top_title">
            	<h2>导购</h2>
					<span class="more">
						<a href="<?php echo $this->Html->url(array("controller" => "articles","action" => "guides", "?"=>array("bid" => $brand['Brand']['id'])));?>">更多</a>
					</span>
            </div>
            <ul class="list">
				<?php $index=0;?>
				<?php foreach($brand['Article'] as $article):?>
				<?php if($article['type']!='guide'){continue;}?>
				<?php $index+=1;?>
				<?php if($index>12){break;}?>
            	<li class="item">
					<a href="<?php echo $this->Html->url(array("controller" => "articles","action" => "item", "?"=>array("aid" => $article['id'])));?>">
						<?php echo $this->StringUtil->sysSubStr($article['title'],70);?>
					</a>
					<span class="date">
						<?php echo date('Y-m-d', strtotime($article['created'])); ?>
					</span>
				</li>
               <?php endforeach;?>
            </ul>
        </div>
    </div>
    <!--新闻列表 & 导购列表 ends-->
    
    <!--经销商列表-->
    <div class="block_center dealer_list_block">
    	<div class="top_title top_title_orange">
        	<h2>经销商</h2>
        </div>
    	<ul class="dealer_list clearfix">
			<?php foreach($dealers as $dealer):?>
			<li>
            	<p class="title">
					<?php echo $dealer['Dealer']['name'];?>
					<span class="city">
						<?php echo $dealer['Dealer']['prov'];?>
					</span>
				</p>
                <p class="tel"><span class="t">电话：</span>
					<span class="tel_num"><?php echo $dealer['Dealer']['tel'];?></span>
				</p>
                <p class="addr"><span class="t">地址：</span><?php echo $dealer['Dealer']['address'];?></p>
            </li>
			<?php endforeach;?>
        </ul>
    </div>
    <!--经销商列表 ends-->

</div>