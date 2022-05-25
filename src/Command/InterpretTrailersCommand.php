<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class InterpretTrailersCommand extends AbstractCommand
{
    public function getName(): string
    {
        return 'interpret-trailers';
    }
}
