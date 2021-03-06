<?php declare(strict_types=1);

namespace kovarp\ChilliPress\Posts;

use kovarp\ChilliPress\Acf\Acf;
use Nette\Utils\Arrays;

abstract class PostModel {

	/** @var string */
	protected $postType;

	/** @var array */
	protected $args = [];

	/** @var array */
	private $fields = [];

	public function __construct() {
		$this->setArgs(
			array(
				'public'      => TRUE,
				'has_archive' => TRUE,
				'supports' => array(
					'title',
					'editor',
					'thumbnail',
					'author'
				)
			)
		);

		add_action(
			'init',
			array(
				$this,
				'registerPostType'
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

	/**
	 * @return \WP_Error|\WP_Post_Type|bool
	 */
	public function registerPostType() {
		if ($this->postType !== 'post') {
			return register_post_type($this->postType, $this->getArgs());
		} else {
			return FALSE;
		}
	}

	/**
	 * @param int $postID
	 * @return PostInterface|null
	 */
	public function getPost(int $postID): ?PostInterface {
		return $this->postFromPostFactory(get_post($postID));
	}

	/**
	 * @param string $slug
	 * @return PostInterface|null
	 */
	public function getPostBySlug(string $slug): ?PostInterface {
		$posts = $this->getPosts(
			array(
				'name'           => $slug,
				'posts_per_page' => 1
			)
		);

		return (isset($posts[0])) ? $posts[0] : NULL;
	}

	/**
	 * @param array $args
	 * @return Post[]
	 */
	public function getPosts(array $args = array()): array {
		$defaultArgs = array(
			'post_type'      => $this->postType,
			'posts_per_page' => -1
		);

		$args = Arrays::mergeTree($args, $defaultArgs);

		return $this->postsFromPostsFactory(get_posts($args));
	}

	/**
	 * @param \WP_Post $post
	 * @return PostInterface|null
	 */
	abstract protected function postFromPostFactory(\WP_Post $post): ?PostInterface;

	/**
	 * @param \WP_Post[] $posts
	 * @return array
	 */
	protected function postsFromPostsFactory(array $posts): array {
		$rows = [];
		foreach ($posts as $post) {
			$rows[] = $this->postFromPostFactory($post);
		}

		return $rows;
	}

	/**
	 * @param array $args
	 * @param array $parentArgs
	 */
	public function addField(array $args, array $parentArgs = array()): void {
		$defaultArgs = array(
			'parent' => 'group_post_' . $this->postType,
		);
		$args = Arrays::mergeTree($args, $defaultArgs);

		$defaultParentArgs = array(
			'key'      => $args['parent'],
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => $this->postType
					)
				)
			)
		);
		$parentArgs = Arrays::mergeTree($parentArgs, $defaultParentArgs);

		if (!isset($this->fields[$args['parent']])) {
			Acf::addGroup($parentArgs);
		}

		Acf::addField($args);
	}
}