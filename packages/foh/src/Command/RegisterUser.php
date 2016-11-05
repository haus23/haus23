<?php

namespace Haus23\FOH\Command;

use Symfony\Component\HttpKernel\Controller\ArgumentResolver;

class RegisterUser
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $nickname;

    /**
     * @var string[]
     */
    private $roles;

    /**
     * RegisterUser constructor.
     * @param string $username
     * @param string $password
     * @param string $email
     * @param string $nickname
     * @param \string[] $roles
     */
    public function __construct(string $username, string $password, string $email, string $nickname, array $roles)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->nickname = $nickname;
        $this->roles = $roles;
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
    public function getPassword(): string
    {
        return $this->password;
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
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @return \string[]
     */
    public function getRoles(): array
    {
        return $this->roles;
    }
}
