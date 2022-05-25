<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class DescribeCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'describe';
    }
}
