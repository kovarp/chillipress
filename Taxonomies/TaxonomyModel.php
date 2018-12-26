<?php declare(strict_types=1);

namespace ChilliPress\Taxonomies;

use Nette\Utils\Arrays;

abstract class TaxonomyModel {

	/** @var string */
	protected $taxonomy;

	/** @var array */
	protected $args = [];

	public function __construct() {
		$this->setArgs(
			array(
				'hierarchical' => TRUE,
				'rewrite'      => array('slug' => $this->taxonomy)
			)
		);

		add_action(
			'init',
			array(
				$this,
				'registerTaxonomy'
			)
		);
	}

	/**
	 * @param array $args
	 */
	protected function setArgs($args = array()): void {
		$this->args = Arrays::mergeTree($args, $this->args);
	}

	/**
	 * @return array
	 */
	protected function getArgs() {
		return $this->args;
	}

	public function registerTaxonomy(): void {
		register_taxonomy($this->taxonomy, $this->getArgs()['object_type'], $this->getArgs());
	}
}