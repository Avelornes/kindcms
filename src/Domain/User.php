<?php

namespace kindcms\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface {
	/**
	 * User id.
	 *
	 * @var integer
	 */
	private $id;

	/**
	 * User name.
	 *
	 * @var string
	 */
	private $username;

	/**
	 * User password.
	 *
	 * @var string
	 */
	private $password;

	/**
	 * Salt that was originally used to encode the password.
	 *
	 * @var string
	 */
	private $salt;

	/**
	 * Role.
	 * Values : ROLE_USER or ROLE_ADMIN.
	 *
	 * @var string
	 */
	private $role;

	public function getId() {
		return $this->id;
	}

	/**
	 * @param $id
	 *
	 * @return $this
	 */
	public function setId( $id ) {
		$this->id = $id;

		return $this;
	}

	/**
	 * @inheritDoc
	 *
	 * @return mixed
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * @param $username
	 *
	 * @return $this
	 */

	public function setUsername( $username ) {
		$this->username = $username;

		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function getPassword() {
		// TODO: Implement getPassword() method.
		return $this->password;
	}

	/**
	 * @param mixed $password
	 */
	public function setPassword( $password ) {
		$this->password = $password;

		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function getSalt() {
		// TODO: Implement getSalt() method.
		return $this->salt;
	}

	/**
	 * @param mixed $salt
	 */
	public function setSalt( $salt ) {
		$this->salt = $salt;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getRole() {
		return $this->role;
	}

	/**
	 * @param mixed $role
	 */
	public function setRole( $role ) {
		$this->role = $role;

		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function getRoles() {
		// TODO: Implement getRoles() method.
		return array( $this->getRole() );
	}

	/**
	 * @inheritDoc
	 */
	public function eraseCredentials() {
		// TODO: Implement eraseCredentials() method.
	}
}
