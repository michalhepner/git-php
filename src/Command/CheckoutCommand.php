<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

use MichalHepner\Git\Infrastructure\ProcessFactory\ProcessFactoryInterface;
use MichalHepner\Git\Ref;

class CheckoutCommand extends AbstractCommand
{
    public const ARGUMENT_SPEC = 'spec';
    public const OPTION_QUIET = '--quiet';
    public const OPTION_PROGRESS = '--progress';
    public const OPTION_NO_PROGRESS = '--no-progress';
    public const OPTION_FORCE = '--force';
    public const OPTION_OURS = '--ours';
    public const OPTION_THEIRS = '--theirs';
    public const OPTION_B = '-b';
    public const OPTION_B_FORCE = '-B';
    public const OPTION_TRACK = '--track';
    public const OPTION_NO_TRACK = '--no-track';
    public const OPTION_GUESS = '--guess';
    public const OPTION_NO_GUESS = '--no-guess';
    //public const OPTION_CREATE_REFLOG = '-l';
    public const OPTION_DETACH = '--detach';
    public const OPTION_ORPHAN = '--orphan';
    public const OPTION_IGNORE_SKIP_WORKTREE_BITS = '--ignore-skip-worktree-bits';
    public const OPTION_MERGE = '--merge';
    public const OPTION_CONFLICT = '--conflict';
    public const OPTION_PATCH = '--patch';
    public const OPTION_IGNORE_OTHER_WORKTREES = '--ignore-other-worktrees';
    public const OPTION_OVERWRITE_IGNORE = '--overwrite-ignore';
    public const OPTION_NO_OVERWRITE_IGNORE = '--no-overwrite-ignore';
    public const OPTION_RECURSE_SUBMODULES = '--recurse-submodules';
    public const OPTION_NO_RECURSE_SUBMODULES = '--no-recurse-submodules';
    public const OPTION_OVERLAY = '--overlay';
    public const OPTION_NO_OVERLAY = '--no-overlay';
    public const OPTION_PATHSPEC_FROM_FILE = '--pathspec-from-file';
    public const OPTION_PATHSPEC_FILE_NUL = '--pathspec-file-nul';

    public function __construct(
        ProcessFactoryInterface $processFactory,
        string $cwd,
        array|string|null|Ref $args = null,
        array $options = [],
        array $env = []
    ) {
        if (is_array($args)) {
            foreach ($args as $k => $arg) {
                $args[$k] = $arg instanceof Ref ? $arg->getRefSpec() : $arg;
            }
        } elseif ($args instanceof Ref) {
            $args = $args->getRefSpec();
        }

        parent::__construct($processFactory, $cwd, $args, $options, $env);
    }

    public function getName(): string
    {
        return 'checkout';
    }
}
