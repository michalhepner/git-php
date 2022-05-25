<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class FetchCommand extends AbstractCommand
{
    public const ARGUMENT_SPEC = 'spec';
    public const OPTION_ALL = '--all';
    public const OPTION_APPEND = '--append';
    public const OPTION_ATOMIC = '--atomic';
    public const OPTION_DEPTH = '--depth';
    public const OPTION_DEEPEN = '--deepen';
    public const OPTION_SHALLOW_SINCE = '--shallow-since';
    public const OPTION_SHALLOW_EXCLUDE = '--shallow-exclude';
    public const OPTION_UNSHALLOW = '--unshallow';
    public const OPTION_UPDATE_SHALLOW = '--update-shallow';
    public const OPTION_NEGOTIATION_TIP = '--negotiation-tip';
    public const OPTION_NEGOTIATE_ONLY = '--negotiate-only';
    public const OPTION_DRY_RUN = '--dry-run';
    public const OPTION_WRITE_FETCH_HEAD = '--write-fetch-head';
    public const OPTION_NO_WRITE_FETCH_HEAD = '--no-write-fetch-head';
    public const OPTION_FORCE = '--force';
    public const OPTION_KEEP = '--keep';
    public const OPTION_MULTIPLE = '--multiple';
    public const OPTION_AUTO_MAINTENANCE = '--auto-maintenance';
    public const OPTION_NO_AUTO_MAINTENANCE = '--no-auto-maintenance';
    public const OPTION_AUTO_GC = '--auto-gc';
    public const OPTION_NO_AUTO_GC = '--no-auto-gc';
    public const OPTION_WRITE_COMMIT_GRAPH = '--write-commit-graph';
    public const OPTION_NO_WRITE_COMMIT_GRAPH = '--no-write-commit-graph';
    public const OPTION_PREFETCH = '--prefetch';
    public const OPTION_PRUNE = '--prune';
    public const OPTION_PRUNE_TAGS = '--prune-tags';
    public const OPTION_NO_TAGS = '--no-tags';
    public const OPTION_REFMAP = '--refmap';
    public const OPTION_TAGS = '--tags';
    public const OPTION_RECURSE_SUBMODULES = '--recurse-submodules';
    public const OPTION_JOBS = '--jobs';
    public const OPTION_NO_RECURSE_SUBMODULES = '--no-recurse-submodules';
    public const OPTION_SET_UPSTREAM = '--set-upstream';
    public const OPTION_SUBMODULE_PREFIX = '--submodule-prefix';
    public const OPTION_RECURSE_SUBMODULES_DEFAULT = '--recurse-submodules-default';
    public const OPTION_UPDATE_HEAD_OK = '--update-head-ok';
    public const OPTION_UPLOAD_PACK = '--upload-pack';
    public const OPTION_QUIET = '--quiet';
    public const OPTION_VERBOSE = '--verbose';
    public const OPTION_PROGRESS = '--progress';
    public const OPTION_SERVER_OPTION = '--server-option';
    public const OPTION_SHOW_FORCED_UPDATES = '--show-forced-updates';
    public const OPTION_NO_SHOW_FORCED_UPDATES = '--no-show-forced-updates';
    public const OPTION_IPV4 = '--ipv4';
    public const OPTION_IPV6 = '--ipv6';
    public const OPTION_STDIN = '--stdin';

    public function getName(): string
    {
        return 'fetch';
    }
}
