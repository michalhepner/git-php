<?php

declare(strict_types = 1);

namespace MichalHepner\Git;

interface Ref
{
    public const TYPE_BRANCH = 'branch';
    public const TYPE_TAG = 'tag';
    public const TYPE_COMMIT = 'commit';

    public function getRefSpec(): string;
}
