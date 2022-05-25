<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class ForEachRefCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'for-each-ref';
    }
}
