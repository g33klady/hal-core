<?php
/**
 * @copyright ©2015 Quicken Loans Inc. All rights reserved. Trade Secret,
 *    Confidential and Proprietary. Any dissemination outside of Quicken Loans
 *    is strictly prohibited.
 */

namespace QL\Hal\Core\Entity;

use JsonSerializable;

class UserType implements JsonSerializable
{
    /**
     * @type string
     */
    protected $id;

    /**
     * @type string
     */
    protected $type;

    /**
     * @type User
     */
    protected $user;

    /**
     * @type Repository|null
     */
    protected $application;

    public function __construct()
    {
        $this->id = '';
        $this->type = '';

        $this->user = null;
        $this->application = null;
    }

    /**
     * @return string
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * @return User
     */
    public function user()
    {
        return $this->user;
    }

    /**
     * @return Repository|null
     */
    public function application()
    {
        return $this->application;
    }

    /**
     * @param string $id
     *
     * @return self
     */
    public function withId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $type
     *
     * @return self
     */
    public function withType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param User $user
     *
     * @return self
     */
    public function withUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @param Repository $application
     *
     * @return self
     */
    public function withApplication(Repository $application)
    {
        $this->application = $application;
        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $json = [
            'id' => $this->id(),
            'type' => $this->type(),

            'user' => $this->user()->getId(),
            'application' => $this->application() ? $this->application()->getId() : null,
        ];

        return $json;
    }
}