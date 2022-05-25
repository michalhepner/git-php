<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class ShortlogCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'shortlog';
    }
}
