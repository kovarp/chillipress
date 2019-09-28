<?php declare(strict_types=1);

namespace ChilliPress\Acf\Fields;

class Link {

	private $url;

	private $target;

	private $title;

	public function __construct($link) {
		$this->url = (is_string($link['url']))? $link['url'] : '';
		$this->target = (is_string($link['url']) && !empty($link['url']))? $link['url'] : '_self';
		$this->title = (is_string($link['title']))? $link['title'] : '';
	}

	public function getUrl(): string {
		return $this->url;
	}

	public function getTarget(): string {
		return $this->target;
	}

	public function getTitle(): string {
		return $this->title;
	}
}