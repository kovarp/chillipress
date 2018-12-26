<?php declare(strict_types=1);

namespace ChilliPress\Theme;

class Seo {
	public function __construct() {
		add_filter(
			'wpseo_metabox_prio',
			array(
				$this,
				'seoMetaboxPosition'
			)
		);
	}

	public function seoMetaboxPosition(): string {
		return 'low';
	}
}