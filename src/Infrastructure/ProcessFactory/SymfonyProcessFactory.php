<?php
declare(strict_types=1);

namespace MichalHepner\Git\Infrastructure\ProcessFactory;

use Symfony\Component\Process\Process;

class SymfonyProcessFactory implements ProcessFactoryInterface
{
    public function create(array $command, string $cwd, ?int $timeout = null, ?array $env = null): ProcessInterface
    {
        return new SymfonyProcessAdapter(new Process($command, $cwd, env: $env, timeout: $timeout));
    }

    public function createFromString(string $command, string $cwd, ?int $timeout = null, ?array $env = null): ProcessInterface
    {
        return new SymfonyProcessAdapter(Process::fromShellCommandline($command, $cwd, env: $env, timeout: $timeout));
    }
}
