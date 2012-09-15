<?php
App::uses('BrandDealerMap', 'Model');

/**
 * BrandDealerMap Test Case
 *
 */
class BrandDealerMapTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.brand_dealer_map',
		'app.brand',
		'app.article',
		'app.dealer',
		'app.product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BrandDealerMap = ClassRegistry::init('BrandDealerMap');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BrandDealerMap);

		parent::tearDown();
	}

}
