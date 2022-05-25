<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class FormatPatchCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'format-patch';
    }
}
