<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\Import\TenderCSVImporter;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'tenders:import:csv', description: 'Загрузка тендеров из файла csv')]
class ImportTendersFromCSVCommand extends Command
{
    private TenderCSVImporter $service;

    public function __construct(TenderCSVImporter $importer)
    {
        parent::__construct();

        $this->service = $importer;
    }

    protected function configure()
    {
        $this->addOption('file', 'f', InputOption::VALUE_REQUIRED, 'Путь к файлу csv', '../tender-task/test_task_data.csv');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $file = $input->getOption('file');

        $this->service->import($file);

        return Command::SUCCESS;
    }
}
