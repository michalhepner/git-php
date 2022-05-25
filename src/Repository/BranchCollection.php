<?php
declare(strict_types=1);

namespace MichalHepner\Git\Repository;

use MichalHepner\Git\Infrastructure\Collection\AbstractCollection;

class BranchCollection extends AbstractCollection
{
    public function getFullNames(): array
    {
        return $this->map(fn (Branch $branch) => $branch->getFullName());
    }

    public function getNames(): array
    {
        return $this->map(fn (Branch $branch) => $branch->getName());
    }

    public function filterLocal(): self
    {
        return $this->filter(fn(Branch $branch) => !$branch->isRemote());
    }

    public function filterRemote(Remote|string|null $remote = null): self
    {
        if (is_string($remote)) {
            return $this->filter(fn(Branch $branch) => $branch->getRemote() && $branch->getRemote()->getName() === $remote);
        } elseif ($remote instanceof Remote) {
            return $this->filter(fn(Branch $branch) => $branch->getRemote() && $branch->getRemote()->getName() === $remote->getName());
        }

        return $this->filter(fn(Branch $branch) => $branch->getRemote() !== null);
    }

    public function filterOrigin(): self
    {
        return $this->filterRemote('origin');
    }

    public function hasWithName(string $name): bool
    {
        return !$this->filter(fn(Branch $branch) => $branch->getName() === $name)->isEmpty();
    }

    public function sort(): void
    {
        $this->usort(fn (Branch $a, Branch $b) => version_compare($a->getFullName(), $b->getFullName()));
    }

    public function rsort(): void
    {
        $this->usort(fn (Branch $a, Branch $b) => version_compare($b->getFullName(), $a->getFullName()));
    }

    public function asort(): void
    {
        $this->uasort(fn (Branch $a, Branch $b) => version_compare($a->getFullName(), $b->getFullName()));
    }

    public function arsort(): void
    {
        $this->uasort(fn (Branch $a, Branch $b) => version_compare($b->getFullName(), $a->getFullName()));
    }

    public function sorted(): self
    {
        $self = new self($this->getArrayCopy());
        $self->sort();

        return $self;
    }

    public function rsorted(): self
    {
        $self = new self($this->getArrayCopy());
        $self->rsort();

        return $self;
    }
}
