<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class InitCommand extends AbstractCommand
{
    public const OPTION_QUIET = '--quiet';
    public const OPTION_BARE = '--bare';
    public const OPTION_TEMPLATE = '--template';
    public const OPTION_SEPARATE_GIT_DIR = '--separate-git-dir';
    public const OPTION_OBJECT_FORMAT = '--object-format';
    public const OPTION_INITIAL_BRANCH = '--initial-branch';
    public const OPTION_SHARED = '--shared';

    public function getName(): string
    {
        return 'init';
    }
}
