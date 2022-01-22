<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class DisplayYCommand extends Command
{
    protected static $defaultName = 'app:DisplayY';
    protected static $defaultDescription = 'Add a short description for your command';

    protected function configure(): void
    {
        $this
            ->addArgument('X', InputArgument::REQUIRED, 'nb_iteration')
            ->addArgument('Y', InputArgument::REQUIRED, 'element_to_display')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $x = $input->getArgument('X');
        $y = $input->getArgument('Y');

        for($i=0; $i < $x; $i++)
        {
            $output->writeln($y);
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
