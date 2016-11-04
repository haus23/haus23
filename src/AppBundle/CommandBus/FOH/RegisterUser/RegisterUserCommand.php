<?php

namespace AppBundle\CommandBus\FOH\RegisterUser;

class RegisterUserCommand
{
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string[]
     */
    private $groups;

    /**
     * RegisterUserCommand constructor.
     * @param string $username
     * @param string $email
     * @param string $password
     * @param \string[] $groups
     */
    public function __construct($username, $email, $password, array $groups)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->groups = $groups;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return \string[]
     */
    public function getGroups(): array
    {
        return $this->groups;
    }
}