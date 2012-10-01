<?php
App::uses('AppController', 'Controller');
class ArticlesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Articles';
	public $layout = 'classic';
	public $uses = array('Brand', 'Article', 'Dealer', 'Product', 'BrandDealerMap');

	public function news(){
		if(!empty($this->request->named['bid'])){
			$bid = $this->request->named['bid'];
			$brand = $this->Brand->findById($bid);
			$this->set('brand', $brand);
			$conditions = array('Article.type' => 'news', 'Article.brand_id' => $bid);
		}else if(!empty($this->request->query['bid'])){
			$bid = $this->request->query['bid'];
			$brand = $this->Brand->findById($bid);
			$this->set('brand', $brand);
			$conditions = array('Article.type' => 'news', 'Article.brand_id' => $bid);
		}else{
			$conditions = array('Article.type' => 'news');
		}
		$this->paginate = array(
				'Article' => array (
				'recursive' => 2,
				'conditions' => $conditions,
				'order' => 'Article.id desc',
				'limit' => 10,
				'page'=>1)
		);
		$news = $this->paginate('Article');
		$this->set('news', $news);
		
		$this->set('title_for_layout','新风网 —— 新风行业新闻');//标题
	}
	
	public function guides(){
		if(!empty($this->request->named['bid'])){
			$bid = $this->request->named['bid'];
			$brand = $this->Brand->findById($bid);
			$this->set('brand', $brand);
			$conditions = array('Article.type' => 'guide', 'Article.brand_id' => $bid);
		}else if(!empty($this->request->query['bid'])){
			$bid = $this->request->query['bid'];
			$brand = $this->Brand->findById($bid);
			$this->set('brand', $brand);
			$conditions = array('Article.type' => 'guide', 'Article.brand_id' => $bid);
		}else{
			$conditions = array('Article.type' => 'guide');
		}
		$this->paginate = array(
				'Article' => array (
				'recursive' => 2,
				'conditions' => $conditions,
				'order' => 'Article.id desc',
				'limit' => 10,
				'page'=>1)
		);
		$guides = $this->paginate('Article');
		$this->set('guides', $guides);
		
		$this->set('title_for_layout','新风网 —— 新风产品导购');//标题
	}
	
	public function item(){
		if(empty($this->request->query['aid'])){
			throw new NotFoundException("404");
		}
		$aid = $this->request->query['aid'];
		if(!$this->Article->exists($aid)){
			throw new NotFoundException("404");
		}
		
		$article = $this->Article->findById($aid);
		$this->set('article', $article);
		
		$curClicks = $article['Article']['clicks'];
		$c = $curClicks +1;
		$sql = "UPDATE articles SET clicks=" . $c . " where id=" . $aid . ";";
		$this->Article->query($sql);
		
		$this->set('title_for_layout','新风网  —— '.$article['Article']['title']);//标题
	}
}
