<?php
declare(strict_types=1);

namespace MichalHepner\Git\Infrastructure\ProcessFactory;

use Iterator;

interface ProcessInterface
{
    public function run(callable $callback = null, array $env = []): int;
    public function isSuccessful(): bool;
    public function getExitCode(): int;
    public function getOutput(): string;
    public function getErrorOutput(): string;
    public function getCommandLine(): string;
    public function mustRun(callable $callback = null, array $env = []): self;
    public function start(callable $callback = null, array $env = []): void;
    public function stop(float $timeout = 10, int $signal = null): ?int;
    public function wait(callable $callback = null): int;
    public function waitUntil(callable $callback): bool;
    public function getIncrementalOutput(): string;
    public function getIterator(int $flags = 0): Iterator;
    public function clearOutput(): self;
    public function getIncrementalErrorOutput(): string;
    public function clearErrorOutput(): self;
    public function hasBeenStopped(): bool;
    public function isRunning(): bool;
    public function isStarted(): bool;
    public function isTerminated(): bool;
    public function getStatus(): string;
    public function getTimeout(): ?float;
    public function getIdleTimeout(): ?float;
    public function setTimeout(?float $timeout): void;
    public function setIdleTimeout(?float $timeout): void;
    public function getEnv(): array;
    public function checkTimeout(): void;
    public function getStartTime(): float;
}
