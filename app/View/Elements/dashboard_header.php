<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
	<div class="container">
	  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </a>
	  <a class="brand" href="#">
		<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "index"));?>" class="brand">
			新风网 - 管理平台
		</a>
	  <div class="nav-collapse">
		<ul class="nav">
		  <!--<li class="active"><a href="#">首页</a></li>-->
		 <li>
			<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "brands"));?>">
				品牌管理
			</a>
		</li>
		<li>
			<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "products"));?>">
				产品管理
			</a>
		</li>
		<li>
			<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "dealers"));?>">
				经销商管理
			</a>
		</li>
		<li>
			<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "news"));?>">
				新闻管理
			</a>
		</li>
		<li>
			<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "guides"));?>">
				导购管理
			</a>
		</li>
		</ul>
	  </div><!--/.nav-collapse -->
	</div>
  </div>
</div>