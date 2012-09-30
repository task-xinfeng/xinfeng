<?php
App::uses('AppController', 'Controller');
class BrandsController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Brands';
	public $layout = 'classic';
	public $uses = array('Brand', 'Article', 'Dealer', 'Product', 'BrandDealerMap');

	public function index() {
		$option = array('recursive'=>2, 'order' => 'Brand.weight desc');
		$brands = $this->Brand->find('all', $option);
		//debug($brands);die();
		$this->set('brands', $brands);
		
		$this->set('title_for_layout','新风网 —— 只推荐最好的新风品牌');//标题
		
	}
	
	public function item() {
		$bid = $this->request->query['bid'];
		$brand = $this->Brand->findById($bid);
		$this->set('brand', $brand);
		//debug($brand);die();
		
		$sql = "select dealer_id from brand_dealer_maps where brand_id=".$bid.";";
		$dealerIds = $this->BrandDealerMap->query($sql);
		$dealerIdArray = array();
		foreach($dealerIds as $dealerId){
			$dealerIdArray[] = $dealerId['brand_dealer_maps']['dealer_id'];
		}
		$this->set('dealerIdArray', $dealerIdArray);
		
		//TODO：这个将来经销商多了的话需要改成tab的分省份查询
		$conditions = array('Dealer.id' => $dealerIdArray);
		$option = array('recursive'=>1, 'order' => 'Dealer.id desc', 'conditions' => $conditions);
		$dealers = $this->Dealer->find('all', $option);
		$this->set('dealers', $dealers);
		//debug($dealers);die();
		
		$this->set('title_for_layout','新风网 —— 新风品牌 —— '.$brand['Brand']['name']);//标题
	}
	
}
