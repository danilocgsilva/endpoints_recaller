<?php

namespace App\Command;

use App\Entity\Application;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Question\Question;

#[AsCommand(
    name: 'application:add',
    description: 'Add a short description for your command',
)]
class ApplicationAddCommand extends Command
{
    private EntityManagerInterface $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();

        $this->em = $em;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');

        $application = new Application();

        $application->setApplication(
            $helper->ask(
                $input, 
                $output, 
                new Question("Which is the application name to add?\n")
            )
        );

        $application->setDescription(
            $helper->ask(
                $input, 
                $output,
                new Question("Write an application description (if applicable)\n", )
            )
        );

        $this->writeDb($application);
        $io = new SymfonyStyle($input, $output);
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
        return Command::SUCCESS;
    }

    private function writeDb(Application $application)
    {
        $this->em->persist($application);
        $this->em->flush();
    }
}
