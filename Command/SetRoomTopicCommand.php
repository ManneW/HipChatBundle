<?php

namespace Mannew\HipchatBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Sets the topic for a HipChat room
 */

class SetRoomTopicCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        parent::configure();

        $this
                ->setName('hipchat:set:room:topic')
                ->setDescription('Sets the topic for a HipChat room')
                ->addArgument('room', InputArgument::REQUIRED, 'The HipChat Room')
                ->addArgument('topic', InputArgument::REQUIRED, 'The Topic')
                ->addArgument('from', InputArgument::OPTIONAL, 'User name', 'HipchatBundle');

    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;

        $room = $input->getArgument('room');
        $topic = $input->getArgument('topic');
        $from = $input->getArgument('from');

        $hipChat = $this->getContainer()->get('hipchat');

        $hipChat->set_room_topic($room, $topic, $from);
    }
}