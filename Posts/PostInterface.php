<?php declare(strict_types=1);

namespace ChilliPress\Posts;

interface PostInterface {

	public function getID(): int;

	public function getTitle(): string;

	public function getDate(): string;

	public function getLink(): ?string;

	public function getExcerpt(): string;

	public function getThumbnail(): ?string;

	public function hasThumbnail(): bool;
}