<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class BranchCommand extends AbstractCommand
{
    public const ARGUMENT_SPEC = 'spec';
    public const OPTION_DELETE = '--delete';
    public const OPTION_DELETE_FORCE = '-D';
    public const OPTION_CREATE_REFLOG = '--create-reflog';
    public const OPTION_FORCE = '--force';
    public const OPTION_MOVE = '--move';
//    public const OPTION_ = '-M';
    public const OPTION_COPY = '--copy';
//    public const OPTION_ = '-C';
    public const OPTION_COLOR = '--color';
    public const OPTION_NO_COLOR = '--no-color';
    public const OPTION_IGNORE_CASE = '--ignore-case';
    public const OPTION_COLUMN = '--column';
    public const OPTION_NO_COLUMN = '--no-column';
    public const OPTION_REMOTES = '--remotes';
    public const OPTION_ALL = '--all';
    public const OPTION_LIST = '--list';
    public const OPTION_SHOW_CURRENT = '--show-current';
    public const OPTION_VERBOSE = '--verbose';
    public const OPTION_QUIET = '--quiet';
    public const OPTION_ABBREV = '--abbrev';
    public const OPTION_NO_ABBREV = '--no-abbrev';
    public const OPTION_TRACK = '--track';
    public const OPTION_NO_TRACK = '--no-track';
    public const OPTION_SET_UPSTREAM_TO = '--set-upstream-to';
    public const OPTION_UNSET_UPSTREAM = '--unset-upstream';
//    public const OPTION_EDIT_DESCRIPTION = '--edit-description';
    public const OPTION_CONTAINS = '--contains';
    public const OPTION_NO_CONTAINS = '--no-contains';
    public const OPTION_MERGED = '--merged';
    public const OPTION_NO_MERGED = '--no-merged';
    public const OPTION_SORT = '--sort';
    public const OPTION_POINTS_AT = '--points-at';
    public const OPTION_FORMAT = '--format';

    public function getName(): string
    {
        return 'branch';
    }
}
