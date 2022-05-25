<?php
declare(strict_types=1);

namespace MichalHepner\Git\Repository;

use IteratorAggregate;
use MichalHepner\Git\Infrastructure\Collection\AbstractCollection;

/**
 * @implements IteratorAggregate<int, Commit>
 */
class CommitCollection extends AbstractCollection
{
}
