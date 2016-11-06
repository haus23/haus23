<?php

namespace spec\Haus23\FOH\Command;

use Doctrine\ORM\EntityManager;
use Haus23\FOH\Command\RegisterUser;
use Haus23\FOH\Command\RegisterUserHandler;
use Haus23\FOH\Entity\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RegisterUserHandlerSpec extends ObjectBehavior
{
    const USERNAME = 'wanda';
    const PASSWORD = 'scrambled';
    const EMAIL    = 'wanda@punk.com';
    const NICKNAME = 'Wanda';
    const ROLES    = ['ROLE_USER','ROLE_ADMIN'];
    
    function it_persists_a_registered_user(EntityManager $em)
    {
        $this->beConstructedWith($em);

        $registerUser = new RegisterUser(self::USERNAME,self::PASSWORD,self::EMAIL,self::NICKNAME,self::ROLES);

        $em->persist(Argument::type(User::class))->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->handle($registerUser);
    }
}
