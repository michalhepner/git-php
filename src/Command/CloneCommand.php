<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class CloneCommand extends AbstractCommand
{
    public const ARGUMENT_REPOSITORY = 'repository';
    public const ARGUMENT_DIRECTORY = 'directory';
    public const OPTION_LOCAL = '--local';
    public const OPTION_NO_HARDLINKS = '--no-hardlinks';
    public const OPTION_SHARED = '--shared';
    public const OPTION_REFERENCE = '--reference';
    public const OPTION_REFERENCE_IF_ABLE = '--reference-if-able';
    public const OPTION_DISSOCIATE = '--dissociate';
    public const OPTION_QUIET = '--quiet';
    public const OPTION_VERBOSE = '--verbose';
    public const OPTION_SERVER_OPTION = '--server-option';
    public const OPTION_NO_CHECKOUT = '--no-checkout';
    public const OPTION_REJECT_SHALLOW = '--reject-shallow';
    public const OPTION_NO_REJECT_SHALLOW = '--no-reject-shallow';
    public const OPTION_BARE = '--bare';
    public const OPTION_SPARSE = '--sparse';
    public const OPTION_FILTER = '--filter';
    public const OPTION_MIRROR = '--mirror';
    public const OPTION_ORIGIN = '--origin';
    public const OPTION_BRANCH = '--branch';
    public const OPTION_UPLOAD_PACK = '--upload-pack';
    public const OPTION_TEMPLATE = '--template';
    public const OPTION_CONFIG = '--config';
    public const OPTION_DEPTH = '--depth';
    public const OPTION_SHALLOW_SINCE = '--shallow-since';
    public const OPTION_SHALLOW_EXCLUDE = '--shallow-exclude';
    public const OPTION_SINGLE_BRANCH = '--single-branch';
    public const OPTION_NO_SINGLE_BRANCH = '--no-single-branch';
    public const OPTION_NO_TAGS = '--no-tags';
    public const OPTION_RECURSE_SUBMODULES = '--recurse-submodules';
    public const OPTION_SHALLOW_SUBMODULES = '--shallow-submodules';
    public const OPTION_NO_SHALLOW_SUBMODULES = '--no-shallow-submodules';
    public const OPTION_REMOTE_SUBMODULES = '--remote-submodules';
    public const OPTION_NO_REMOTE_SUBMODULES = '--no-remote-submodules';
    public const OPTION_SEPARATE_GIT_DIR = '--separate-git-dir';
    public const OPTION_JOBS = '--jobs';

    public function getName(): string
    {
        return 'clone';
    }
}
