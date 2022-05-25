<?php
declare(strict_types=1);

namespace MichalHepner\Git\Infrastructure\ProcessFactory;

use Iterator;
use Symfony\Component\Process\Process;

class SymfonyProcessAdapter implements ProcessInterface
{
    public function __construct(protected Process $process)
    {}

    public function run(callable $callback = null, array $env = []): int
    {
        return $this->process->run($callback, $env);
    }

    public function isSuccessful(): bool
    {
        return $this->process->isSuccessful();
    }

    public function getExitCode(): int
    {
        return $this->process->getExitCode();
    }

    public function getOutput(): string
    {
        return $this->process->getOutput();
    }

    public function getErrorOutput(): string
    {
        return $this->process->getErrorOutput();
    }

    public function getCommandLine(): string
    {
        return $this->process->getCommandLine();
    }

    public function mustRun(callable $callback = null, array $env = []): self
    {
        $this->process->mustRun($callback, $env);

        return $this;
    }

    public function start(callable $callback = null, array $env = []): void
    {
        $this->process->start($callback, $env);
    }

    public function wait(callable $callback = null): int
    {
        return $this->process->wait($callback);
    }

    public function waitUntil(callable $callback): bool
    {
        return $this->process->waitUntil($callback);
    }

    public function getIncrementalOutput(): string
    {
        return $this->process->getIncrementalOutput();
    }

    public function getIterator(int $flags = 0): Iterator
    {
        return $this->process->getIterator($flags);
    }

    public function clearOutput(): self
    {
        $this->process->clearOutput();

        return $this;
    }

    public function getIncrementalErrorOutput(): string
    {
        return $this->process->getIncrementalErrorOutput();
    }

    public function clearErrorOutput(): self
    {
        $this->process->clearErrorOutput();

        return $this;
    }

    public function hasBeenStopped(): bool
    {
        return $this->process->hasBeenStopped();
    }

    public function isRunning(): bool
    {
        return $this->process->isRunning();
    }

    public function isStarted(): bool
    {
        return $this->process->isStarted();
    }

    public function isTerminated(): bool
    {
        return $this->process->isTerminated();
    }

    public function getStatus(): string
    {
        return $this->process->getStatus();
    }

    public function stop(float $timeout = 10, int $signal = null): ?int
    {
        return $this->process->stop($timeout, $signal);
    }

    public function getTimeout(): ?float
    {
        return $this->process->getTimeout();
    }

    public function getIdleTimeout(): ?float
    {
        return $this->process->getIdleTimeout();
    }

    public function setTimeout(?float $timeout): void
    {
        $this->process->setTimeout($timeout);
    }

    public function setIdleTimeout(?float $timeout): void
    {
        $this->process->setIdleTimeout($timeout);
    }

    public function getEnv(): array
    {
        return $this->process->getEnv();
    }

    public function checkTimeout(): void
    {
        $this->process->checkTimeout();
    }

    public function getStartTime(): float
    {
        return $this->process->getStartTime();
    }
}
