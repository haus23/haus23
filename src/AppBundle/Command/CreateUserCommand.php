<?php

namespace AppBundle\Command;

use Doctrine\ORM\EntityManager;
use Haus23\FOH\Command\RegisterUser;
use Haus23\FOH\Entity\User;
use League\Tactician\CommandBus;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

class CreateUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:create-user')
            ->setDescription('Creates new user.')
            ->setHelp("This command allows you to create users...")
            ->addArgument('username', InputArgument::REQUIRED, 'The username of the user.')
            ->addArgument('email', InputArgument::REQUIRED, 'The email address of the user.')
            ->addOption('admin',null,InputOption::VALUE_NONE,"The user is an admin.",null)
            ->addOption('nickname',null,InputOption::VALUE_REQUIRED,"User's nickname")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');

        $username = $input->getArgument('username');
        $email = $input->getArgument('email');

        $isAdmin = $input->getOption('admin');
        $roles = ['ROLE_USER'];
        if( $isAdmin ) {
            array_push($roles, 'ROLE_ADMIN');
        }

        $nickname = null;
        if( $input->hasOption('nickname') ) {
            $nickname = $input->getOption('nickname');
        }

        $user = new \AppBundle\Entity\FOH\User();

        $question = new Question('Password? ');
        $question->setHidden(true);
        $password = $helper->ask($input, $output, $question);

        /** @var UserPasswordEncoder $encoder */
        $encoder = $this->getContainer()->get('security.password_encoder');
        $passwordHash = $encoder->encodePassword($user,$password);

        $user->setUsername($username);
        $user->setPassword($passwordHash);
        $user->setEmail($email);
        $user->setNickname($nickname);
        $user->setRoles($roles);

        /** @var EntityManager $em */
        $em = $this->getContainer()->get('doctrine.orm.foh_entity_manager');
        $em->persist($user);
        $em->flush();
    }
}