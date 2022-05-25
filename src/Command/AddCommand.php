<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class AddCommand extends AbstractCommand
{
    public const OPTION_DRY_RUN = '--dry-run';
    public const OPTION_VERBOSE = '--verbose';
    public const OPTION_FORCE = '--force';
    public const OPTION_INTERACTIVE = '--interactive';
    public const OPTION_PATCH = '--patch';
    public const OPTION_EDIT = '--edit';
    public const OPTION_UPDATE = '--update';
    public const OPTION_ALL = '--all';
    public const OPTION_NO_IGNORE_REMOVAL = '--no-ignore-removal';
    public const OPTION_NO_ALL = '--no-all';
    public const OPTION_IGNORE_REMOVAL = '--ignore-removal';
    public const OPTION_INTENT_TO_ADD = '--intent-to-add';
    public const OPTION_REFRESH = '--refresh';
    public const OPTION_IGNORE_ERRORS = '--ignore-errors';
    public const OPTION_IGNORE_MISSING = '--ignore-missing';
    public const OPTION_NO_WARN_EMBEDDED_REPO = '--no-warn-embedded-repo';
    public const OPTION_RENORMALIZE = '--renormalize';
    public const OPTION_CHMOD = '--chmod';
    public const OPTION_PATHSPEC_FROM_FILE = '--pathspec-from-file';
    public const OPTION_PATHSPEC_FILE_NUL = '--pathspec-file-nul';

    public function getName(): string
    {
        return 'add';
    }
}
