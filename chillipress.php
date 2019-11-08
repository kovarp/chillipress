<?php declare(strict_types = 1);

/**
 * Security
 */
new kovarp\ChilliPress\Security\HideBackend();
new kovarp\ChilliPress\Security\RestApi();

/**
 * Core
 */
new kovarp\ChilliPress\Core\Updates();

/**
 * Theme
 */
new kovarp\ChilliPress\Theme\Loader();
new kovarp\ChilliPress\Theme\Setup();
new kovarp\ChilliPress\Theme\Seo();

/**
 * Admin
 */
new kovarp\ChilliPress\Admin\Topbar();
new kovarp\ChilliPress\Admin\Dashboard();

add_action('plugins_loaded', 'runContainer');

function runContainer() {
	global $container;

	$container->run();
}