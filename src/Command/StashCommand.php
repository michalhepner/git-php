<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

use MichalHepner\Git\Infrastructure\ProcessFactory\ProcessFactoryInterface;

class StashCommand extends AbstractCommand
{
    public function __construct(
        ProcessFactoryInterface $processFactory,
        string $cwd,
        protected string $subcommand,
        array|string|null $args = null,
        array $options = [],
        array $env = []
    ) {
        parent::__construct($processFactory, $cwd, $args, $options, $env);
    }

    public function getName(): string
    {
        return sprintf('stash %s', $this->subcommand);
    }
}
