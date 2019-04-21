<?php declare(strict_types = 1);

new kovarp\ChilliPress\Security\HideBackend();
new kovarp\ChilliPress\Security\RestApi();
new kovarp\ChilliPress\Core\Updates();
new kovarp\ChilliPress\Theme\Setup();
new kovarp\ChilliPress\Theme\Seo();
new kovarp\ChilliPress\Admin\Topbar();
new kovarp\ChilliPress\Admin\Dashboard();

add_action('plugins_loaded', 'runContainer');

function runContainer() {
	global $container;

	$container->run();
}