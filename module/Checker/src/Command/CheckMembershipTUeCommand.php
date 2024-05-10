<?php

declare(strict_types=1);

namespace Checker\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'check:membership:tue',
    description: 'Check whether ordinary members are still studying at the TU/e.',
)]
class CheckMembershipTUeCommand extends AbstractCheckerCommand
{
    protected function execute(
        InputInterface $input,
        OutputInterface $output,
    ): int {
        $this->getCheckerService()->checkAtTUe();

        return Command::SUCCESS;
    }
}
