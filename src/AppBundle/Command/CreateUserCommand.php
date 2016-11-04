<?php

namespace AppBundle\Command;

use AppBundle\CommandBus\FOH\RegisterUser\RegisterUserCommand;
use League\Tactician\CommandBus;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

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
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');

        $username = $input->getArgument('username');
        $email = $input->getArgument('email');

        $isAdmin = $input->getOption('admin');
        $groups = ['ROLE_USER'];
        if( $isAdmin ) {
            array_push($groups, 'ROLE_ADMIN');
        }

        $question = new Question('Password? ');
        $question->setHidden(true);
        $password = $helper->ask($input, $output, $question);

        /** @var CommandBus $commandBus */
        $commandBus = $this->getContainer()->get('tactician.commandbus');
        $cmd = new RegisterUserCommand($username, $email, $password, $groups);
        $commandBus->handle($cmd);
    }
}