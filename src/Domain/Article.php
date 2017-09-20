<?php

namespace kindcms\Domain;

class Article
{
	/**
	 * Article id.
	 *
	 * @var integer
	 */
	private $id;

	/**
	 * Article title.
	 *
	 * @var string
	 */
	private $title;

	/**
	 * Article content.
	 *
	 * @var string
	 */
	private $content;

	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId( $id ) {
		$this->id = $id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param string $title
	 */
	public function setTitle( $title ) {
		$this->title = $title;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * @param string $content
	 */
	public function setContent( $content ) {
		$this->content = $content;
		return $this;
	}
}