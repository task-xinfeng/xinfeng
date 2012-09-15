<?php
/**
 * BrandDealerMapFixture
 *
 */
class BrandDealerMapFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'brand_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'dealer_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'brand_id' => 1,
			'dealer_id' => 1,
			'created' => '2012-09-11 15:14:28',
			'modified' => '2012-09-11 15:14:28'
		),
	);

}
