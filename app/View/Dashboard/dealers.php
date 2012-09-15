<div class="page-header">
<h1>经销商列表</h1>
</div>
<div class="container">
	<section id="adminmachinegroups">
		<div style="overflow: hidden;">
			<table class="table table-striped">
				<tr>
					<th width=25%>经销商公司名称</th>
					<th width=35%>经销商信息</th>
					<th width=20%>经销品牌</th>
					<th width=20%>操作</th>
				</tr>
				<?php foreach($dealers as $dealer):?>
				<tr id="dealer_<?php echo $dealer['Dealer']['id'];?>">
					<td>
						<h5><?php echo $dealer['Dealer']['name'];?></h5>
					</td>
					<td>
						<ul class="unstyled">
							<li><strong>省份城市</strong>：
								<?php echo $dealer['Dealer']['prov'];?> - <?php echo $dealer['Dealer']['city'];?>
							</li>
							<li><strong>地址</strong>：<?php echo $dealer['Dealer']['address'];?></li>
							<li><strong>电话</strong>：<?php echo $dealer['Dealer']['tel'];?></li>
							<li>
								<strong>简介</strong>：<?php echo $this->StringUtil->sysSubStr($dealer['Dealer']['intro'], 200);?>
							</li>
						</ul>
					</td>
					<td>
						<?php foreach($dealer['BrandDealerMap'] as $brandDealerMapItem):?> 
							<span class="label label-info">
								<?php echo $brandDealerMapItem['Brand']['name'];?>
							</span>
							&nbsp;
						<?php endforeach;?>
					</td>
					<td>
						<ul class="unstyled">
							<li>
								<a href="javascript:void(0);" class="btn-mini btn-danger delDealer" data-dname="<?php echo $dealer['Dealer']['name'];?>" data-did="<?php echo $dealer['Dealer']['id'];?>">
									删除经销商
								</a>
								&nbsp;
								<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "editDealer", "?"=>array("dealer_id" => $dealer['Dealer']['id'])));?>" class="btn-mini btn-warning" title="编辑该经销商">
									编辑经销商
								</a>
							</li>
						</ul>
					</td>
				</tr>
				<?php endforeach;?>
			</table>
			<div class="pagination pagination-right">
				<ul>
				<?php
					$this->Paginator->options(array(
						'url'=> array('controller'=>'dashboard', 'action'=>'dealers')
					));
				?>
				<?php
					if(count($dealers) >= 1){
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
		<p align='right'>
			<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "addDealer"));?>" class="btn-small btn-success">
				+新增经销商
			</a>
		</p>
	</section>
</div>


<!--弹出警告框-->
<div class="modal hide fade" id="noticeDelGroup">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>提醒 - 确认删除操作？</h3>
  </div>
  <div class="modal-body">
    <p id="noticeNote"></p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal" id="confirmDel">确认删除</a>
    <a href="#" class="btn btn-primary" data-dismiss="modal" id="cancelDel">等等，取消删除</a>
  </div>
</div>

<script type="text/javascript">
$(function(){
	
	/*confirm删除*/
	$('.delDealer').click(function(){
		var element = $(this);
		$("#confirmDel").data('did',element.data('did'));
		$('#noticeNote').html('确定删除： '+element.data('dname') + ' ?');
		
		$('#noticeDelGroup').modal({'backdrop':true});
		return false;
	});
	
	//no_redirect这个参数随便写，只要带这个参数就跳转，不带这个参数就不跳转
	$('#confirmDel').click(function(){
		var did = $("#confirmDel").data('did');
		$.ajax({
					type:		"POST",
					url:		"<?php echo $this->webroot;?>" + "dashboard/delDealer",
					dataType:	"html",
					data:		{	dealer_id:did,
									no_redirect:true
								},
					success: 	function(data,textStatus){
									$('#dealer_'+did).remove();
									$("#confirmDel").removeAttr('did');
									$('#noticeNote').html('');
								}
				});
	});
	
	//取消删除
	$('#cancelDel').click(function(){
		$("#confirmDel").removeAttr('did');
		$('#noticeNote').html('');
	});
});
</script>