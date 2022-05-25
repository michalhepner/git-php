<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class CountObjectsCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'count-objects';
    }
}
