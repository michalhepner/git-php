<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class UpdateIndexCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'update-index';
    }
}
