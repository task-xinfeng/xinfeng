<!--big_top_intro-->
<!--<div class="big_top_intro">
	<a href="#">
    	<img src="http://xinfeng/app/webroot/img/big_top_intro.jpg" width="1319" height="384" />
    </a>
</div>-->
<!--big_top_intro-->

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

<div class="content block_center index">
<!--供应商-->
    <div class="block_center thumb_list_block thumb_list_block_opposite brands clearfix">
    	<div class="top_title">
            <h2>品牌推荐</h2>
        </div>
        <div class="main">
        	<ul class="items_group clearfix">
            	<li class="item">
                	<div class="pic">
                    	<a href="#">
                        	<img src="#" width="165" height="100" />
                        </a>
                    </div>
                    <h3><a href="#">title</a></h3>
                </li>
                <li class="item">
                	<div class="pic">
                    	<a href="#">
                        	<img src="#" width="165" height="100" />
                        </a>
                    </div>
                    <h3><a href="#">title</a></h3>
                </li>
                <li class="item">
                	<div class="pic">
                    	<a href="#">
                        	<img src="#" width="165" height="100" />
                        </a>
                    </div>
                    <h3><a href="#">title</a></h3>
                </li>
                <li class="item">
                	<div class="pic">
                    	<a href="#">
                        	<img src="#" width="165" height="100" />
                        </a>
                    </div>
                    <h3><a href="#">title</a></h3>
                </li>
                <li class="item">
                	<div class="pic">
                    	<a href="#">
                        	<img src="#" width="165" height="100" />
                        </a>
                    </div>
                    <h3><a href="#">title</a></h3>
                </li>
                <li class="item">
                	<div class="pic">
                    	<a href="#">
                        	<img src="#" width="165" height="100" />
                        </a>
                    </div>
                    <h3><a href="#">title</a></h3>
                </li>
                <li class="item">
                	<div class="pic">
                    	<a href="#">
                        	<img src="#" width="165" height="100" />
                        </a>
                    </div>
                    <h3><a href="#">title</a></h3>
                </li>
                <li class="item">
                	<div class="pic">
                    	<a href="#">
                        	<img src="#" width="165" height="100" />
                        </a>
                    </div>
                    <h3><a href="#">title</a></h3>
                </li>
                <!--<li class="item more">
                	<a href="#" target="_blank" title="更多">
                        <span class="more_icon"></span>
                        <span class="more_text">更多</span>
                    </a>
                </li>-->
            </ul>
        </div>
        <div class="side">
        	<div class="a a_b">
            	<a href="#" target="_blank">
                	<img src="#" width="238" height="298" />
                </a>
            </div>
        </div>

    </div>
<!--供应商 ends-->

<!--通栏广告-->
<div class="a_w block_center">
	<a href="#">
    	<img width="990" height="80" src="#" />
    </a>
</div>
<!--通栏广告 ends-->

<!--新风品牌-->
	<div class="block_center thumb_list_block suppliers clearfix">
    	<div class="top_title top_title_blue">
            <h2>新风品牌</h2>
        </div>
    	<div class="main">
        	<ul class="items_group clearfix">
				<?php foreach($brands as $brand):?>
            	<li class="item">
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
						<a href="<?php echo $this->Html->url(array("controller" => "brands","action" => "item", "?"=>array("bid" => $brand['Brand']['id'])));?>" target="_blank">
						<?php echo $this->Html->image($thumbnail['src'], array('width' => $thumbnail['w'], 'height' => $thumbnail['h'])); ?>
						</a>
                    </div>
                    <h3>
						<a href="<?php echo $this->Html->url(array("controller" => "brands","action" => "item", "?"=>array("bid" => $brand['Brand']['id'])));?>" target="_blank">
							<?php echo $brand['Brand']['name'];?>
						</a>
					</h3>
                </li>
				<?php endforeach;?>
                <li class="item more">
                	<a href="<?php echo $this->Html->url(array("controller" => "brands","action" => "index"));?>" target="_blank" title="更多">
                        <span class="more_icon"></span>
                        <span class="more_text">更多品牌</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="side">
        	<div class="a a_b">
            	<a href="#" target="_blank">
                	<img src="#" width="238" height="298" />
                </a>
            </div>
            <div class="a a_s">
            	<a href="#" target="_blank">
                	<img src="#" width="238" height="98" />
                </a>
            </div>
        </div>
	</div>
<!--新风品牌 ends-->

<!--通栏广告-->
<div class="a_w block_center">
	<a href="#">
    	<img width="990" height="80" src="#" />
    </a>
</div>
<!--通栏广告 ends-->

<!--行业新闻-->
    <div class="block_center news_list_block news clearfix">
    	<div class="top_title top_title_green">
            <h2>行业新闻</h2>
        </div>
        <div class="main">
        	<ul class="items_group clearfix">
				<?php foreach($news as $newItem):?>
            	<li class="item">
					<a href="<?php echo $this->Html->url(array("controller" => "articles","action" => "item", "?"=>array("aid" => $newItem['Article']['id'])));?>" target="_blank">
							<?php echo $this->StringUtil->sysSubStr($newItem['Article']['title'],60);?>
						</a>
					<span class="date">
						<?php echo date('Y-m-d', strtotime($newItem['Article']['created'])); ?>
					</span>
				</li>
				<?php endforeach;?>
                <li class="item more">
					<a href="<?php echo $this->Html->url(array("controller" => "articles","action" => "news"));?>" target="_blank">
						查看更多
					</a>
				</li>
            </ul>
        </div>
        <div class="side">
        	<div class="a a_b">
            	<a href="#" target="_blank">
                	<img src="#" width="238" height="298" />
                </a>
            </div>
        </div>
    </div>
<!--行业新闻 ends-->

<!--通栏广告-->
<div class="a_w block_center">
	<a href="#">
    	<img width="990" height="80" src="#" />
    </a>
</div>
<!--通栏广告 ends-->

<!--推荐产品-->
	<div class="block_center thumb_list_block products clearfix">
    	<div class="top_title top_title_orange">
            <h2>推荐产品</h2>
        </div>
    	<div class="main">
        	<ul class="items_group clearfix">
				<?php foreach($products as $product):?>
            	<li class="item">
                	<div class="pic">
                    	<?php
							$thumbnail = $this->Phpthumb->generate(
								array(
									'save_path' => WWW_ROOT . IMAGE_ROOT . 'thumbs',     
									'display_path' => '/' . IMAGE_ROOT . 'thumbs',  
									'error_image_path' => '/' . IMAGE_ROOT  . 'default.jpg',
									'src' => WWW_ROOT . IMAGE_ROOT . PRODUCT . $product['Product']['avatar'],
									'w' => 165, 
									'h' => 150,
									'q' => 100,
									'zc' => 1
								)
							);
						?>
						<a href="<?php echo $this->Html->url(array("controller" => "products","action" => "item", "?"=>array("pid" => $product['Product']['id'])));?>" target="_blank">
						<?php echo $this->Html->image($thumbnail['src'], array('width' => $thumbnail['w'], 'height' => $thumbnail['h'])); ?>
						</a>
                    </div>
                    <h3>
						<a href="<?php echo $this->Html->url(array("controller" => "products","action" => "item", "?"=>array("pid" => $product['Product']['id'])));?>" target="_blank">
							<?php echo $product['Product']['name'];?>
						</a>
					</h3>
                </li>
				<?php endforeach;?>
                <li class="item more">
                	<a href="<?php echo $this->Html->url(array("controller" => "products","action" => "index"));?>" target="_blank" title="更多">
                        <span class="more_icon"></span>
                        <span class="more_text">更多产品</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="side">
        	<div class="a a_b">
            	<a href="#" target="_blank">
                	<img src="#" width="238" height="298" />
                </a>
            </div>
            <div class="a a_s">
            	<a href="#" target="_blank">
                	<img src="#" width="238" height="98" />
                </a>
            </div>
        </div>
	</div>
<!--推荐产品 ends-->

<!--通栏广告-->
<div class="a_w block_center">
	<a href="#">
    	<img width="990" height="80" src="#" />
    </a>
</div>
<!--通栏广告 ends-->

<!--新风导购-->
    <div class="block_center news_list_block guide clearfix">
    	<div class="top_title">
            <h2>新风导购</h2>
        </div>
        <div class="main">
        	<ul class="items_group clearfix">
            	<?php foreach($guides as $guide):?>
            	<li class="item">
					<a href="<?php echo $this->Html->url(array("controller" => "articles","action" => "item", "?"=>array("aid" => $guide['Article']['id'])));?>" target="_blank">
							<?php echo $this->StringUtil->sysSubStr($guide['Article']['title'],60);?>
						</a>
					<span class="date">
						<?php echo date('Y-m-d', strtotime($guide['Article']['created'])); ?>
					</span>
				</li>
				<?php endforeach;?>
                <li class="item more">
					<a href="<?php echo $this->Html->url(array("controller" => "articles","action" => "guides"));?>" target="_blank">
						查看更多
					</a>
				</li>
            </ul>
        </div>
        <div class="side">
        	<div class="a a_b">
            	<a href="#" target="_blank">
                	<img src="#" width="238" height="298" />
                </a>
            </div>
        </div>
    </div>
<!--新风导购 ends-->

<!--底部介绍-->
	<div class="block_center intro_bottom">
    	<ul class="intro_ul">
        	<li class="i i_1">
            	<span class="icon"></span>
                <p>最权威的新风行业动态</p>
                <em>汇聚全国数百家新风厂商第一手的新闻资料，聚合全网最新最全的新风行业信息。</em>
            </li>
            <li class="i i_2">
            	<span class="icon"></span>
                <p>找到一切你想找的</p>
                <em>在新风网，你可以搜索到最新最全的新风行业的产品、新闻、厂商、经销商。</em>
            </li>
            <li class="i i_3">
            	<span class="icon"></span>
                <p>零距离接近消费群</p>
                <em>在新风网，厂商、经销商将和消费者史无前例地零距离接触。</em>
            </li>
            <li class="i i_4">
            	<span class="icon"></span>
                <p>传播你的品牌</p>
                <em>通过搜索引擎营销、微博营销、数据库营销，为你打造一个立体的传播环境。</em>
             </li>
        </ul>
    </div>
<!--底部介绍 ends-->

<!--底部加入-->
	<div class="block_center join_bottom">
    	<a href="<?php echo $this->Html->url(array("controller" => "pages","action" => "cooperate"));?>" class="join_link"></a>
    </div>
<!--底部加入 ends-->


</div>






