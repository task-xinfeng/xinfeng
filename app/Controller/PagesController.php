<?php
App::uses('AppController', 'Controller');
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';
	public $layout = 'classic';
	public $uses = array('Brand', 'Article', 'Dealer', 'Product', 'BrandDealerMap');

	public function index() {
		//品牌
		$option = array('recursive'=>-1, 'limit' => 7, 'order' => 'Brand.weight desc');
		$brands = $this->Brand->find('all', $option);
		//debug($brands);die();
		$this->set('brands', $brands);
		
		//行业新闻
		$conditions = array('Article.type' => 'news');
		$option = array('recursive'=>-1, 'limit' => 19, 'order' => 'Article.id desc', 'conditions' => $conditions);
		$news = $this->Article->find('all', $option);
		//debug($news);die();
		$this->set('news', $news);
		
		//产品
		$option = array('recursive'=>-1, 'limit' => 7, 'order' => 'Product.id desc');
		$products = $this->Product->find('all', $option);
		//debug($products);die();
		$this->set('products', $products);
		
		//导购
		$conditions = array('Article.type' => 'guide');
		$option = array('recursive'=>-1, 'limit' => 19, 'order' => 'Article.id desc', 'conditions' => $conditions);
		$guides = $this->Article->find('all', $option);
		//debug($guides);die();
		$this->set('guides', $guides);
		
		$this->set('title_for_layout','新风网  —— 中国高端品质新风行业门户，新风网，只推荐最好的新风供应商和新风系列产品');//标题
	}
	
	public function about(){
	}
	
	public function policy(){
	}
	
	public function cooperate(){
	}
	
	public function contract(){
	}
	
	public function error400(){
	}
}
