<?php declare(strict_types=1);

namespace ChilliPress\Core;

class Container {

	/** @var string[] */
	private $registry = [];

	/** @var object[] */
	private $services = [];

	public function run(): void {
		foreach ($this->registry as $name => $service) {
			$this->services[$name] = new $service;
		}
	}

	/**
	 * @param string $name
	 * @param string $service
	 * @return Container
	 */
	public function addService(string $name, string $service): Container {
		if (!isset($this->registry[$name])) {
			$this->registry[$name] = $service;
		}

		return $this;
	}

	/**
	 * @param string $name
	 * @return bool|object
	 */
	public function getService(string $name) {
		return isset($this->services[$name]) ? $this->services[$name] : FALSE;
	}
}