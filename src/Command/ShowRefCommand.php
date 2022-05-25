<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class ShowRefCommand extends AbstractCommand
{
    public const OPTION_HEAD = '--head';
    public const OPTION_HEADS = '--heads';
    public const OPTION_TAGS = '--tags';
    public const OPTION_DEREFERENCE = '--dereference';
    public const OPTION_HASH = '--hash';
    public const OPTION_VERIFY = '--verify';
    public const OPTION_ABBREV = '--abbrev';
    public const OPTION_QUIET = '--quiet';
    public const OPTION_EXCLUDE_EXISTING = '--exclude-existing';

    public function getName(): string
    {
        return 'show-ref';
    }
}
