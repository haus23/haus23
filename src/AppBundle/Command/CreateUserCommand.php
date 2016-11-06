<?php

namespace AppBundle\Command;

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

        $question = new Question('Password? ');
        $question->setHidden(true);
        $password = $helper->ask($input, $output, $question);

        /** @var UserPasswordEncoder $encoder */
        $encoder = $this->getContainer()->get('security.password_encoder');
        $passwordHash = $encoder->encodePassword(new \AppBundle\Security\User($email, $username, $password, $roles),$password);

        /** @var CommandBus $commandBus */
        $commandBus = $this->getContainer()->get('tactician.commandbus');
        $cmd = new RegisterUser($username, $passwordHash, $email, $nickname, $roles);
        $commandBus->handle($cmd);
    }
}