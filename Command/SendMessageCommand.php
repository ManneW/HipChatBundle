<?php

namespace Mannew\HipchatBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Sends a message to a HipChat room
 */

class SendMessageCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        parent::configure();

        $this
                ->setName('hipchat:send:message')
                ->setDescription('Sends a message to a HipChat room')
                ->addArgument('room', InputArgument::REQUIRED, 'The HipChat Room')
                ->addArgument('message', InputArgument::REQUIRED, 'The Message')
                ->addArgument('from', InputArgument::OPTIONAL, 'Sender Name', 'HipchatBundle')
                ->addOption('notify', null, InputOption::VALUE_NONE, 'Notify room members')
                ->addOption('color', null, InputOption::VALUE_OPTIONAL, 'Color', 'yellow')
                ->addOption('format', null, InputOption::VALUE_OPTIONAL, 'Message format', 'html');

    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;

        $room = $input->getArgument('room');
        $message = $input->getArgument('message');
        $from = $input->getArgument('from');

        $notify = $input->getOption('notify');
        $color = $input->getOption('color');
        $format = $input->getOption('format');

        $hipChat = $this->getContainer()->get('hipchat');

        $hipChat->message_room($room, $from, $message, $notify, $color, $format);
    }
}