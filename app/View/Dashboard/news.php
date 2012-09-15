<div class="page-header">
<h1>新风新闻列表</h1>
</div>
<div class="container">
	<section id="adminmachinegroups">
		<div style="overflow: hidden;">
			<table class="table table-striped">
				<?php foreach($news as $newItem):?>
				<tr id="article_<?php echo $newItem['Article']['id'];?>">
					<td width=30%>
						<h5>
							<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "article", "?"=>array("article_id" => $newItem['Article']['id'])));?>">
								<?php echo $newItem['Article']['title'];?>
							</a>
						</h5>
						<h6>-来自<?php echo $newItem['Brand']['name'];?></h6>
					</td>
					<td width=50%>
						<?php echo $this->StringUtil->sysSubStr($newItem['Article']['content'], 200);?>
					</td>
					<td width=20%>
						<ul class="unstyled">
							<li>
								<a href="javascript:void(0);" class="btn-mini btn-danger delArticle" title="危险操作，请谨慎" data-aname="<?php echo $newItem['Article']['title'];?>" data-aid="<?php echo $newItem['Article']['id'];?>">
									删除该新闻
								</a>
								&nbsp;
								<a href="<?php echo $this->Html->url(array("controller" => "dashboard","action" => "editArticle", "?"=>array("article_id" => $newItem['Article']['id'])));?>" class="btn-mini btn-warning">
									编辑该新闻
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
						'url'=> array('controller'=>'dashboard', 'action'=>'news')
					));
				?>
				<?php
					if(count($news) >= 1){
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
	$('.delArticle').click(function(){
		var element = $(this);
		$("#confirmDel").data('aid',element.data('aid'));
		$('#noticeNote').html('确定删除： '+element.data('aname') + ' ?');
		
		$('#noticeDelGroup').modal({'backdrop':true});
		return false;
	});
	
	//no_redirect这个参数随便写，只要带这个参数就跳转，不带这个参数就不跳转
	$('#confirmDel').click(function(){
		var aid = $("#confirmDel").data('aid');
		$.ajax({
					type:		"POST",
					url:		"<?php echo $this->webroot;?>" + "dashboard/delArticle",
					dataType:	"html",
					data:		{	article_id:aid,
									no_redirect:true
								},
					success: 	function(data,textStatus){
									$('#article_'+aid).remove();
									$("#confirmDel").removeAttr('aid');
									$('#noticeNote').html('');
								}
				});
	});
	
	//取消删除
	$('#cancelDel').click(function(){
		$("#confirmDel").removeAttr('aid');
		$('#noticeNote').html('');
	});
});
</script>