<?php declare(strict_types=1);

namespace ChilliPress\Posts;

use WP_Post;

abstract class Post implements PostInterface {

	/** @var WP_Post */
	protected $post;

	public function __construct(WP_Post $post) {
		$this->post = $post;
	}

	/**
	 * @return int
	 */
	public function getID(): int {
		return $this->post->ID;
	}

	/**
	 * @return string
	 */
	public function getSlug(): string {
		return $this->post->post_name;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string {
		return $this->post->post_title;
	}

	/**
	 * @param string $format
	 * @return string
	 */
	public function getDate($format = 'd. m. Y H:i'): string {
		$time = strtotime($this->post->post_date);

		if (!is_int($time)) {
			return '';
		}

		return date($format, $time);
	}

	/**
	 * @return null|string
	 */
	public function getLink(): ?string {
		$link = get_the_permalink($this->getID());

		return ($link === FALSE) ? NULL : $link;
	}

	/**
	 * @param int $words
	 * @return string
	 */
	public function getExcerpt(int $words = 0): string {
		if (has_excerpt($this->getID())) {
			$excerpt = get_the_excerpt($this->getID());
		} else {
			$excerpt = strip_shortcodes($this->post->post_content);
			$excerpt = apply_filters('the_content', $excerpt);
			$excerpt = str_replace(']]>', ']]&gt;', $excerpt);
			$excerpt_length = ($words > 0)? $words : apply_filters('excerpt_length', 55);
			$excerpt_more = apply_filters('excerpt_more', '...');
			$excerpt = wp_trim_words($excerpt, $excerpt_length, $excerpt_more);
		}

		return $excerpt;
	}

	/**
	 * @return string
	 */
	public function getContent(): string {
		$content = apply_filters('the_content', $this->post->post_content);
		$content = str_replace(']]>', ']]&gt;', $content);

		return $content;
	}

	/**
	 * @param string $size
	 * @return null|string
	 */
	public function getThumbnail(string $size = 'post-thumbnail'): ?string {
		$thumbnail = get_the_post_thumbnail_url($this->getID(), $size);

		return ($thumbnail === FALSE) ? NULL : $thumbnail;
	}

	/**
	 * @param string $taxonomy
	 * @return array
	 */
	public function getCategories(string $taxonomy = 'category'): array {
		$terms = get_the_terms($this->getID(), $taxonomy);

		return (is_array($terms))? $terms : array();
	}

	/**
	 * @return bool
	 */
	public function hasThumbnail(): bool {
		return has_post_thumbnail($this->getID());
	}
}