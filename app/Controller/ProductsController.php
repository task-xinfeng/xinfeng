<?php
App::uses('AppController', 'Controller');
class ProductsController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Products';
	public $layout = 'classic';
	public $uses = array('Brand', 'Article', 'Dealer', 'Product', 'BrandDealerMap');


	public function index(){
		if(!empty($this->request->named['bid'])){
			$bid = $this->request->named['bid'];
			$brand = $this->Brand->findById($bid);
			$this->set('brand', $brand);
			$conditions = array('Product.brand_id' => $bid);
		}else if(!empty($this->request->query['bid'])){
			$bid = $this->request->query['bid'];
			$brand = $this->Brand->findById($bid);
			$this->set('brand', $brand);
			$conditions = array('Product.brand_id' => $bid);
		}else{
			$conditions = array();
		}
		$this->paginate = array(
				'Product' => array (
				'recursive' => 2,
				'conditions' => $conditions,
				'order' => 'Product.id desc',
				'limit' => 1,
				'page'=>1)
		);
		$products = $this->paginate('Product');
		$this->set('products', $products);
		
		$this->set('title_for_layout','新风网  —— 新风产品列表');//标题
	}
	
	public function item(){
		$pid = $this->request->query['pid'];
		$product = $this->Product->findById($pid);
		$this->set('product', $product);
		
		$curClicks = $product['Product']['clicks'];
		$c = $curClicks +1;
		$sql = "UPDATE products SET clicks=" . $c . " where id=" . $pid . ";";
		$this->Product->query($sql);
		
		$this->set('title_for_layout','新风网  —— '.$product['Product']['name']);//标题
	}
}
