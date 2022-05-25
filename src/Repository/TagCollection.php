<?php
declare(strict_types=1);

namespace MichalHepner\Git\Repository;

use MichalHepner\Git\Infrastructure\Collection\AbstractCollection;

class TagCollection extends AbstractCollection
{
    /**
     * @param Tag|string|Tag[]|string[]|TagCollection $tag
     *
     * @return $this
     */
    public function not(Tag|string|array|TagCollection $tag): self
    {
        if ($tag instanceof TagCollection) {
            $tags = $tag->getNames();
        } else {
            $tags = is_array($tag) ? $tag : [$tag];
            $tags = array_map(
                fn(string|Tag $item) => $item instanceof Tag ? $item->getName() : $item,
                $tags
            );
        }

        return $this->filter(fn (Tag $item) => in_array($item->getName(), $tags));
    }

    public function getNames(): array
    {
        return $this->map(fn (Tag $tag) => $tag->getName());
    }

    public function hasWithName(string $name): bool
    {
        return !$this->filter(fn(Tag $tag) => $tag->getName() === $name)->isEmpty();
    }

    public function sort(): void
    {
        $this->usort(fn (Tag $a, Tag $b) => version_compare($a->getName(), $b->getName()));
    }

    public function sorted(): self
    {
        $self = new self($this->getArrayCopy());
        $self->sort();

        return $self;
    }

    public function rsort(): void
    {
        $this->usort(fn (Tag $a, Tag $b) => version_compare($b->getName(), $a->getName()));
    }

    public function rsorted(): self
    {
        $self = new self($this->getArrayCopy());
        $self->rsort();

        return $self;
    }
}
