<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class TagCommand extends AbstractCommand
{
    public const OPTION_ANNOTATE = '--annotate';
    public const OPTION_SIGN = '--sign';
    public const OPTION_NO_SIGN = '--no-sign';
    public const OPTION_LOCAL_USER = '--local-user';
    public const OPTION_FORCE = '--force';
    public const OPTION_DELETE = '--delete';
    public const OPTION_VERIFY = '--verify';
    public const OPTION_N = '-n';
    public const OPTION_LIST = '--list';
    public const OPTION_SORT = '--sort';
    public const OPTION_COLOR = '--color';
    public const OPTION_IGNORE_CASE = '--ignore-case';
    public const OPTION_COLUMN = '--column';
    public const OPTION_NO_COLUMN = '--no-column';
    public const OPTION_CONTAINS = '--contains';
    public const OPTION_NO_CONTAINS = '--no-contains';
    public const OPTION_MERGED = '--merged';
    public const OPTION_NO_MERGED = '--no-merged';
    public const OPTION_POINTS_AT = '--points-at';
    public const OPTION_MESSAGE = '--message';
    public const OPTION_FILE = '--file';
    public const OPTION_EDIT = '--edit';
    public const OPTION_CLEANUP = '--cleanup';
    public const OPTION_CREATE_REFLOG = '--create-reflog';
    public const OPTION_FORMAT = '--format';

    public function getName(): string
    {
        return 'tag';
    }
}
