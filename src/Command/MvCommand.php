<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class MvCommand extends AbstractCommand
{
    public const ARGUMENT_SPEC = 'spec';
    public const OPTION_FORCE = '--force';
    public const OPTION_K = '-k';
    public const OPTION_DRY_RUN = '--dry-run';
    public const OPTION_VERBOSE = '--verbose';

    public function getName(): string
    {
        return 'mv';
    }
}
