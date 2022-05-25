<?php
declare(strict_types=1);

namespace MichalHepner\Git\Repository\Remote;

use Stringable;

class Uri implements Stringable
{
    public function __construct(protected string $value)
    {}

    public function __toString(): string
    {
        return $this->value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
