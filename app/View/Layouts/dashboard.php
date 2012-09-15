<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $title_for_layout;?></title>
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	<?php echo $this->Html->css(array('bootstrap', 'common')); ?>
	<?php echo $this->Html->script(array('jquery-1.7.2', 'bootstrap')); ?>
	<style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
   
</head>
<body class="home home-new  logged-out ">
<?php echo $this->element('dashboard_header'); ?> 
<div class="container"> 
<?php echo $content_for_layout; ?>
<hr>
<?php echo $this->element('footer'); ?>
</div>
</body>
</html>
