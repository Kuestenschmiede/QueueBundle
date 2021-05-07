<?php
/*
 * This file is part of con4gis, the gis-kit for Contao CMS.
 * @package con4gis
 * @version 8
 * @author con4gis contributors (see "authors.txt")
 * @license LGPL-3.0-or-later
 * @copyright (c) 2010-2021, by Küstenschmiede GmbH Software & Design
 * @link https://www.con4gis.org
 */
namespace con4gis\QueueBundle\Command;

use con4gis\QueueBundle\Classes\Queue\QueueManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class QueueCommand
 * @package con4gis\QueueBundle\Command
 */
class QueueCommand extends ContainerAwareCommand
{

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('con4gis:queue')
             ->addArgument('jobname', InputArgument::REQUIRED, 'Name of the job to run?')
            ->addArgument('showOutput', InputArgument::OPTIONAL, 'Do you want to display the queue output?', "false")
            ->addArgument('jobcount', InputArgument::OPTIONAL, 'How many jobs should be executed?', 10)
             ->setDescription('Run a job in the con4gis queue.')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('contao.framework')->initialize();

        $queueName      = $input->getArgument('jobname');
        $queueCount     = $input->getArgument('jobcount');
        $displayOutput  = $input->getArgument('showOutput');
        $queueManeger   = new QueueManager();
        $queueManeger->run($queueName, $queueCount);
        $content        = $queueManeger->getContent();
        if ($displayOutput !== "false") {
            $output->writeln($content);
        }

        return 0;
    }
}
