<?php
declare(strict_types=1);

namespace MichalHepner\Git\Infrastructure\ProcessFactory;

interface ProcessFactoryInterface
{
    public function create(array $command, string $cwd, ?int $timeout = null, ?array $env = null): ProcessInterface;
    public function createFromString(string $command, string $cwd, ?int $timeout = null, ?array $env = null): ProcessInterface;
}
