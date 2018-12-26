<?php declare(strict_types=1);

namespace ChilliPress\Core;

class Updates {
	public function __construct() {
		/** Admin Footer Text Remover */
		add_filter('admin_footer_text', '__return_empty_string', 11);
		add_filter('update_footer', '__return_empty_string', 11);

		/** Disable automatic updates */
		add_filter('auto_update_plugin', '__return_false');
		add_filter('auto_update_theme', '__return_false');
		add_action('admin_head', array($this, 'hideUpdateNotice'), 1);

		add_filter('pre_site_transient_update_core', array($this, 'removeCoreUpdates'));
		add_filter('pre_site_transient_update_plugins', array($this, 'removeCoreUpdates'));
		add_filter('pre_site_transient_update_themes', array($this, 'removeCoreUpdates'));
	}

	/**
	 * Hide notice about updates
	 */
	public function hideUpdateNotice() {
		remove_action('admin_notices', 'update_nag', 3);
	}

	public function removeCoreUpdates() {
		global $wp_version;

		return (object)array(
			'last_checked'    => time(),
			'version_checked' => $wp_version
		);
	}
}