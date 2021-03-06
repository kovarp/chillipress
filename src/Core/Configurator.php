<?php declare(strict_types=1);

namespace kovarp\ChilliPress\Core;

use Nette\Neon\Neon;
use Nette\Utils\Arrays;

class Configurator {

	/** @var array */
	protected $config = [];

	/** @var array */
	protected $services = [];

	public function createContainer(): Container {
		$container = new Container();

		if (!is_null($this->config['services'])) {
			foreach ($this->config['services'] as $name => $service) {
				$container->addService($name, $service);
			}
		}

		return $container;
	}

	/**
	 * @param string $file
	 */
	public function addConfig(string $file): void {
		$fileContent = file_get_contents($file);

		if (is_string($fileContent)) {
			$config = Neon::decode($fileContent);

			$this->config = Arrays::mergeTree($config, $this->config);
		}
	}

	/**
	 * @return array
	 */
	public function getConfig(): array {
		return $this->config;
	}
}
