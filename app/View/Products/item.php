<!--面包屑-->
<div class="page_route block_center">
	<a href="<?php echo $this->Html->url(array("controller" => "brands","action" => "item"));?>">首页</a>
	<span class="arr">/</span>
	<a href="<?php echo $this->Html->url(array("controller" => "brands","action" => "item", "?"=>array("bid" => $product['Brand']['id'])));?>"><?php echo $product['Brand']['name'];?></a>
	<span class="arr">/</span>
	<?php echo $product['Product']['name'];?>
</div>
<!--面包屑 ends-->

<div class="content block_center products_item clearfix">
	<div class="cmain">
    	
        <div class="article_detail">
			<h2 class="stitle"><?php echo $product['Product']['name'];?></h2>
                <dl class="sinfo clearfix">
                    <dd class="brand"><span class="icon"></span><?php echo $product['Brand']['name'];?></dd>
                    <dd class="total"><span class="icon"></span>
						<?php echo $product['Product']['clicks'];?>次浏览
					</dd>
                    <dd class="date"><span class="icon"></span>
						<?php echo date('Y年m月d日', strtotime($product['Product']['created'])); ?>
					</dd>
                </dl>
                <div class="smain clearfix">
                    <div class="para">
                        <?php echo $product['Product']['intro'];?>
                    </div>
                </div>
    	</div>
        
    </div>
    
    <div class="cside">
        <div class="cside_thumb_240_block block_cside ">
        	<ul class="cside_thumb_240_ul">
            	<li>
                    <h2>
						<a href="<?php echo $this->Html->url(array("controller" => "brands","action" => "item", "?"=>array("bid" => $product['Brand']['id'])));?>">
							<?php echo $product['Brand']['name'];?>
						</a>
					</h2>
                    <div class="pic">
						<a href="<?php echo $this->Html->url(array("controller" => "brands","action" => "item", "?"=>array("bid" => $product['Brand']['id'])));?>">
							<?php
								$thumbnail = $this->Phpthumb->generate(
									array(
										'save_path' => WWW_ROOT . IMAGE_ROOT . 'thumbs',     
										'display_path' => '/' . IMAGE_ROOT . 'thumbs',  
										'error_image_path' => '/' . IMAGE_ROOT  . 'default.jpg',
										'src' => WWW_ROOT . IMAGE_ROOT . BRAND . $product['Brand']['logo'],
										'w' => 240, 
										'h' => 218,
										'q' => 100,
										'zc' => 1
									)
								);
							?>
							<?php echo $this->Html->image($thumbnail['src'], array('width' => $thumbnail['w'], 'height' => $thumbnail['h'])); ?>
						</a>
					</div>
                </li>
            </ul>
        </div>
        
    </div>

</div>