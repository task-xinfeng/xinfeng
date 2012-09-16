<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $title_for_layout;?></title>
<?php echo $this->Html->css(array('style')); ?>
<?php echo $this->Html->script(array('jquery-1.7.2')); ?>
</head>
<body>
<?php echo $this->element('classic_header'); ?> 
<?php echo $content_for_layout; ?>
<?php echo $this->element('classic_footer'); ?>
</body>
</html>