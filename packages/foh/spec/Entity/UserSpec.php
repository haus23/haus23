<?php

namespace spec\Haus23\FOH\Entity;

use Haus23\FOH\Command\RegisterUser;
use Haus23\FOH\Entity\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserSpec extends ObjectBehavior
{
    const USERNAME = 'wanda';
    const PASSWORD = 'scrambled';
    const EMAIL    = 'wanda@punk.com';
    const NICKNAME = 'Wanda';
    const ROLES    = ['ROLE_USER','ROLE_ADMIN'];

    function it_is_initializable()
    {
        $this->shouldHaveType(User::class);
    }

    function it_has_an_id()
    {
        $this->getId()->shouldBe(null);
    }

    function it_has_a_username()
    {
        $this->setUsername(self::USERNAME)->getUsername()->shouldBe(self::USERNAME);
    }

    function it_has_a_password()
    {
        $this->setPassword(self::PASSWORD)->getPassword()->shouldBe(self::PASSWORD);
    }

    function it_has_a_email()
    {
        $this->setEmail(self::EMAIL)->getEmail()->shouldBe(self::EMAIL);
    }

    function it_has_a_nickname()
    {
        $this->setNickname(self::NICKNAME)->getNickname()->shouldBe(self::NICKNAME);
    }

    function it_has_optional_nickname()
    {
        $this->setNickname(null)->getNickname()->shouldBe(null);
    }

    function it_has_roles()
    {
        $this->setRoles(self::ROLES)->getRoles()->shouldBe(self::ROLES);
    }

    function it_has_a_creation_date(\DateTime $now)
    {
        $this->setCreatedAt($now)->getCreatedAt()->shouldBe($now);
    }

    function it_has_a_initial_creation_date()
    {
        $this->getCreatedAt()->shouldNotBe(null);
    }
}
