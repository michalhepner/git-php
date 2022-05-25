<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class QuiltimportCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'quiltimport';
    }
}
