<?php

declare(strict_types=1);

namespace Database\Command;

use Database\Service\Member as MemberService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateAuthenticationKeysCommand extends Command
{
    /** @var string $defaultName */
    protected static $defaultName = 'database:members:generate-keys';
    /** @var string $defaultDescription */
    protected static $defaultDescription = 'Forcefully update the keys used for external authentication on members.';

    public function __construct(private readonly MemberService $memberService)
    {
        parent::__construct();
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output,
    ): int {
        $this->memberService->generateAuthenticationKeys();

        return Command::SUCCESS;
    }
}
