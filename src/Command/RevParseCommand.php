<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class RevParseCommand extends AbstractCommand
{
    public const ARGUMENT_SPEC = 'spec';
    public const OPTION_PARSEOPT = '--parseopt';
    public const OPTION_SQ_QUOTE = '--sq-quote';
    public const OPTION_KEEP_DASHDASH = '--keep-dashdash';
    public const OPTION_STOP_AT_NON_OPTION = '--stop-at-non-option';
    public const OPTION_STUCK_LONG = '--stuck-long';
    public const OPTION_REVS_ONLY = '--revs-only';
    public const OPTION_NO_REVS = '--no-revs';
    public const OPTION_FLAGS = '--flags';
    public const OPTION_NO_FLAGS = '--no-flags';
    public const OPTION_DEFAULT = '--default';
    public const OPTION_PREFIX = '--prefix';
    public const OPTION_VERIFY = '--verify';
    public const OPTION_QUIET = '--quiet';
    public const OPTION_SQ = '--sq';
    public const OPTION_SHORT = '--short';
    public const OPTION_NOT = '--not';
    public const OPTION_ABBREV_REF = '--abbrev-ref';
    public const OPTION_SYMBOLIC = '--symbolic';
    public const OPTION_SYMBOLIC_FULL_NAME = '--symbolic-full-name';
    public const OPTION_ALL = '--all';
    public const OPTION_BRANCHES = '--branches';
    public const OPTION_TAGS = '--tags';
    public const OPTION_REMOTES = '--remotes';
    public const OPTION_GLOB = '--glob';
    public const OPTION_EXCLUDE = '--exclude';
    public const OPTION_DISAMBIGUATE = '--disambiguate';
    public const OPTION_LOCAL_ENV_VARS = '--local-env-vars';
    public const OPTION_PATH_FORMAT = '--path-format';
    public const OPTION_GIT_DIR = '--git-dir';
    public const OPTION_GIT_COMMON_DIR = '--git-common-dir';
    public const OPTION_RESOLVE_GIT_DIR = '--resolve-git-dir';
    public const OPTION_GIT_PATH = '--git-path';
    public const OPTION_SHOW_TOPLEVEL = '--show-toplevel';
    public const OPTION_SHOW_SUPERPROJECT_WORKING_TREE = '--show-superproject-working-tree';
    public const OPTION_SHARED_INDEX_PATH = '--shared-index-path';
    public const OPTION_ABSOLUTE_GIT_DIR = '--absolute-git-dir';
    public const OPTION_IS_INSIDE_GIT_DIR = '--is-inside-git-dir';
    public const OPTION_IS_INSIDE_WORK_TREE = '--is-inside-work-tree';
    public const OPTION_IS_BARE_REPOSITORY = '--is-bare-repository';
    public const OPTION_IS_SHALLOW_REPOSITORY = '--is-shallow-repository';
    public const OPTION_SHOW_CDUP = '--show-cdup';
    public const OPTION_SHOW_PREFIX = '--show-prefix';
    public const OPTION_SHOW_OBJECT_FORMAT = '--show-object-format';
    public const OPTION_SINCE = '--since';
    public const OPTION_AFTER = '--after';
    public const OPTION_UNTIL = '--until';
    public const OPTION_BEFORE = '--before';

    public function getName(): string
    {
        return 'rev-parse';
    }
}
