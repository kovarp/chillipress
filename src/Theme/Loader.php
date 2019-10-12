<?php declare(strict_types=1);

namespace kovarp\ChilliPress\Theme;

use kovarp\ChilliPress\Core\Psr4AutoloaderClass;

class Loader {
	public function __construct() {
		$this->registerThemeNamespace();
	}

	public function registerThemeNamespace(): void {
		$autoloader = new Psr4AutoloaderClass();
		$autoloader->addNamespace('Theme', get_template_directory() . '/src/');
		$autoloader->register();
	}
}