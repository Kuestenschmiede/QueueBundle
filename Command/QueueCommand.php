<?php
/**
 * QueueCommand
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
        $queueManeger   = new QueueManager();

        ob_start();
        $queueManeger->run($queueName, $queueCount);
        $content = ob_get_contents();
        ob_end_clean();

        $output->writeln($content);

        return 0;
    }
}
