<?php

namespace AppBundle\CommandBus\FOH\RegisterUser;

use AppBundle\Entity\FOH\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

class RegisterUserHandler
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var UserPasswordEncoder
     */
    private $encoder;

    /**
     * RegisterUserHandler constructor.
     * @param EntityManager $em
     * @param UserPasswordEncoder $encoder
     */
    public function __construct(EntityManager $em, UserPasswordEncoder $encoder)
    {
        $this->em = $em;
        $this->encoder = $encoder;
    }

    /**
     * @param RegisterUserCommand $cmd
     */
    public function handle(RegisterUserCommand $cmd)
    {
        $user = new User();
        $user->setUsername($cmd->getUsername());
        $user->setEmail($cmd->getEmail());
        $user->setPassword($this->encoder->encodePassword(\AppBundle\Security\User::create(), $cmd->getPassword()));
        $user->setGroups($cmd->getGroups());
        $user->setCreated(new \DateTime());

        $this->em->persist($user);
        $this->em->flush();
    }
}
