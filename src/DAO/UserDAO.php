<?php

namespace kindcms\DAO;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use kindcms\Domain\User;

class UserDAO extends DAO implements UserProviderInterface {
	/**
	 * Returns a user matching the supplied id.
	 *
	 * @param integer $id The user id.
	 *
	 * @return \kindcms\Domain\User|throws an exception if no matching user is found
	 */
	public function find( $id ) {
		$sql = 'SELECT * FROM t_user WHERE usr_id=?';
		$row = $this->getDb()->fetchAssoc( $sql, array( $id ) );

		if ( $row ) {
			return $this->buildDomainObject( $row );
		} else {
			throw new \Exception( 'No user matching id' . $id );
		}
	}

	/**
	 * {@inheritDoc}
	 */
	public function loadUserByUsername( $username ) {
		$sql = 'SELECT * FROM t_user WHERE usr_name=?';
		$row = $this->getDb()->fetchAssoc( $sql, array( $username ) );

		if ( $row ) {
			return $this->buildDomainObject( $row );
		} else {
			throw new UsernameNotFoundException( sprintf( 'User "%s" not found' . $username ) );
		}
	}

	/**
	 *{@inheritDoc}
	 */
	public function refreshUser( UserInterface $user ) {
		$class = get_class( $user );
		if ( ! $this->supportsClass( $class ) ) {
			throw new UnsupportedUserException( sprintf( 'Instances of "%s" are not supported' . $class ) );
		}

		return $this->loadUserByUsername( $user->getUsername() );
	}

	/**
	 * {@inheritDoc}
	 */
	public function supportsClass( $class ) {
		return 'kindcms\Domain\User' === $class;
	}

	/**
	 * Creates a User obkect based on a DB row.
	 *
	 * @param array $row The DV row containing User data.
	 *
	 * @return \kindcms\Domain\User
	 */
	protected function buildDomainObject( array $row ) {
		$user = new User();
		$user->setId( $row['usr_id'] );
		$user->setUsername( $row['usr_name'] );
		$user->setPassword( $row['usr_password'] );
		$user->setSalt( $row['usr_salt'] );
		$user->setRole( $row['usr_role'] );

		return $user;
	}
}