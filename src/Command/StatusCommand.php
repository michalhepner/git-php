<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class StatusCommand extends AbstractCommand
{
    public const ARGUMENT_SPEC = 'spec';
    public const OPTION_SHORT = '--short';
    public const OPTION_BRANCH = '--branch';
    public const OPTION_SHOW_STASH = '--show-stash';
    public const OPTION_PORCELAIN = '--porcelain';
    public const OPTION_LONG = '--long';
    public const OPTION_VERBOSE = '--verbose';
    public const OPTION_UNTRACKED_FILES = '--untracked-files';
    public const OPTION_IGNORE_SUBMODULES = '--ignore-submodules';
    public const OPTION_IGNORED = '--ignored';
    public const OPTION_COLUMN = '--column';
    public const OPTION_NO_COLUMN = '--no-column';
    public const OPTION_AHEAD_BEHIND = '--ahead-behind';
    public const OPTION_NO_AHEAD_BEHIND = '--no-ahead-behind';
    public const OPTION_RENAMES = '--renames';
    public const OPTION_NO_RENAMES = '--no-renames';
    public const OPTION_FIND_RENAMES = '--find-renames';

    public function getName(): string
    {
        return 'status';
    }
}
