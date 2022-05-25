<?php
declare(strict_types=1);

namespace MichalHepner\Git;

class StringRef implements Ref
{
    public function __construct(protected string $value)
    {}

    public function getRefSpec(): string
    {
        return $this->value;
    }
}
