<?php

namespace kindcms\DAO;

use kindcms\Domain\Comment;

class CommentDAO extends DAO {
	/**
	 * @var \kindcms\DAO\ArticleDAO
	 */
	private $articleDAO;

	/**
	 * @var \kindcms\DAO\UserDAO
	 */
	private $userDAO;

	/**
	 * @param ArticleDAO $articleDAO
	 */
	public function setArticleDAO( ArticleDAO $articleDAO ) {
		$this->articleDAO = $articleDAO;
	}

	/**
	 * @param UserDAO $userDAO
	 */
	public function setUserDAO( $userDAO ) {
		$this->userDAO = $userDAO;
	}

	/**
	 * Return a list of all comments for an article, sorted by date (most recent last).
	 *
	 * @param integer $articleId The article id.
	 *
	 * @return array A list of all comments for the article.
	 */
	public function findAllByArticle( $articleId ) {
		// The associated article is retrieved only once
		$article = $this->articleDAO->find( $articleId );

		// art_id is not selected by the SQL query
		// The article won't be retrieved during domain objet construction
		$sql    = 'SELECT com_id, com_content, com_author FROM t_comment WHERE art_id=? ORDER BY com_id';
		$result = $this->getDb()->fetchAll( $sql, array( $articleId ) );

		// Convert query result to an array of domain objects
		$comments = array();
		foreach ( $result as $row ) {
			$comId   = $row['com_id'];
			$comment = $this->buildDomainObject( $row );
			// The associated article is defined for the constructed comment
			$comment->setArticle( $article );
			$comments[ $comId ] = $comment;
		}

		return $comments;
	}

	/**
	 * Creates an Comment object based on a DB row.
	 *
	 * @param array $row The DB row containing Comment data.
	 *
	 * @return \kindcms\Domain\Comment
	 */
	protected function buildDomainObject( array $row ) {
		$comment = new Comment();
		$comment->setId( $row['com_id'] );
		$comment->setContent( $row['com_content'] );

		if ( array_key_exists( 'art_id', $row ) ) {
			// Find and set the associated article
			$articleId = $row['art_id'];
			$article   = $this->articleDAO->find( $articleId );
			$comment->setArticle( $article );
		}
		if (array_key_exists('usr_id', $row)) {
			//Find and set the associated author
			$userId = $row['usr_id'];
			$user = $this->userDAO->find($userId);
			$comment->setAuthor($user);
		}

		return $comment;
	}
}