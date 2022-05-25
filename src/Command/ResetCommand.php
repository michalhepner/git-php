<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class ResetCommand extends AbstractCommand
{
    const OPTION_HARD = '--hard';

    public function getName(): string
    {
        return 'reset';
    }
}
