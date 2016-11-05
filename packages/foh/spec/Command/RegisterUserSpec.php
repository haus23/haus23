<?php

namespace spec\Haus23\FOH\Command;

use Haus23\FOH\Command\RegisterUser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RegisterUserSpec extends ObjectBehavior
{
    const USERNAME = 'wanda';
    const PASSWORD = 'scrambled';
    const EMAIL    = 'wanda@punk.com';
    const NICKNAME = 'Wanda';
    const ROLES    = ['ROLE_USER','ROLE_ADMIN'];

    function let()
    {
        $this->beConstructedWith(
            self::USERNAME,
            self::PASSWORD,
            self::EMAIL,
            self::NICKNAME,
            self::ROLES
        );
    }

    function it_has_a_username()
    {
        $this->getUsername()->shouldBe(self::USERNAME);
    }

    function it_has_a_password()
    {
        $this->getPassword()->shouldBe(self::PASSWORD);
    }

    function it_has_an_email()
    {
        $this->getEmail()->shouldBe(self::EMAIL);
    }

    function it_has_a_nickname()
    {
        $this->getNickname()->shouldBe(self::NICKNAME);
    }

    function it_has_roles()
    {
        $this->getRoles()->shouldBe(self::ROLES);
    }
}
