<?php
App::uses('Dealer', 'Model');

/**
 * Dealer Test Case
 *
 */
class DealerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.dealer',
		'app.brand',
		'app.article',
		'app.product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Dealer = ClassRegistry::init('Dealer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Dealer);

		parent::tearDown();
	}

}
