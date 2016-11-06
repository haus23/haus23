<?php

namespace Haus23\FOH\Command;

use Doctrine\ORM\EntityManager;
use Haus23\FOH\Entity\User;

class RegisterUserHandler
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function handle(RegisterUser $registerUser)
    {
        $user = new User();
        $user->setUsername($registerUser->getUsername());
        $user->setPassword($registerUser->getPassword());
        $user->setEmail($registerUser->getEmail());
        $user->setNickname($registerUser->getNickname());
        $user->setRoles($registerUser->getRoles());

        $this->em->persist($user);
        $this->em->flush();
    }
}
